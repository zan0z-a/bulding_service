<?php

namespace App\Http\Controllers;

use App\Models\ContactRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class AdminController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            'auth',
            new Middleware('admin'),
        ];
    }

    public function index(Request $request)
    {
        $status = $request->get('status');
        
        $requestsQuery = ContactRequest::orderBy('created_at', 'desc');
        
        if ($status && in_array($status, ['new', 'in_progress', 'waiting', 'completed'])) {
            $requestsQuery->where('status', $status);
        }
        
        $requests = $requestsQuery->get();
        $users = User::orderBy('created_at', 'desc')->get();
        
        $stats = [
            'total' => ContactRequest::count(),
            'new' => ContactRequest::where('status', 'new')->count(),
            'in_progress' => ContactRequest::where('status', 'in_progress')->count(),
            'waiting' => ContactRequest::where('status', 'waiting')->count(),
            'completed' => ContactRequest::where('status', 'completed')->count(),
            'users' => User::count(),
        ];
        
        return view('admin.index', compact('requests', 'users', 'stats', 'status'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:new,in_progress,waiting,completed',
        ]);

        $contactRequest = ContactRequest::findOrFail($id);
        $contactRequest->status = $request->status;
        $contactRequest->save();

        return response()->json([
            'success' => true,
            'status' => $contactRequest->status,
            'status_label' => $contactRequest->getStatusLabel(),
        ]);
    }

    public function showRequest($id)
    {
        $contactRequest = ContactRequest::findOrFail($id);
        return view('admin.request-detail', compact('contactRequest'));
    }

    public function deleteRequest($id)
    {
        ContactRequest::findOrFail($id)->delete();
        return redirect()->route('admin.index');
    }
}