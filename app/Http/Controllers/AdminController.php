<?php
// app/Http/Controllers/AdminController.php

namespace App\Http\Controllers;

use App\Models\ContactRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class AdminController extends Controller implements HasMiddleware
{
    /**
     * Middleware для контроллера
     */
    public static function middleware(): array
    {
        return [
            'auth',
            new Middleware('admin'),
        ];
    }

    /**
     * Главная админ-панели
     */
    public function index()
    {
        $requests = ContactRequest::orderBy('created_at', 'desc')->get();
        $users = User::orderBy('created_at', 'desc')->get();
        
        $stats = [
            'total_requests' => ContactRequest::count(),
            'pending_requests' => ContactRequest::where('status', 'pending')->count(),
            'in_progress_requests' => ContactRequest::where('status', 'in_progress')->count(),
            'completed_requests' => ContactRequest::where('status', 'completed')->count(),
            'total_users' => User::count(),
            'admin_users' => User::where('role', 'admin')->count(),
        ];
        
        return view('admin.index', compact('requests', 'users', 'stats'));
    }

    /**
     * Обновление статуса заявки
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,in_progress,completed',
        ]);

        $contactRequest = ContactRequest::findOrFail($id);
        $contactRequest->status = $request->status;
        $contactRequest->save();

        return response()->json([
            'success' => true,
            'message' => 'Статус обновлен',
            'status' => $contactRequest->status,
            'status_label' => $contactRequest->getStatusLabel(),
        ]);
    }

    /**
     * Просмотр деталей заявки
     */
    public function showRequest($id)
    {
        $contactRequest = ContactRequest::findOrFail($id);
        return view('admin.request-detail', compact('contactRequest'));
    }

    /**
     * Удаление заявки
     */
    public function deleteRequest($id)
    {
        $contactRequest = ContactRequest::findOrFail($id);
        $contactRequest->delete();
        
        return redirect()->route('admin.index');
    }
}