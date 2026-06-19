<?php
// app/Http/Controllers/ContactController.php

namespace App\Http\Controllers;

use App\Models\ContactRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        $messages = [
            'name.required' => 'Пожалуйста, укажите ваше имя.',
            'name.max' => 'Имя не должно превышать 255 символов.',
            'company.max' => 'Название компании не должно превышать 255 символов.',
            'email.required' => 'Пожалуйста, укажите email.',
            'email.email' => 'Введите корректный email адрес.',
            'email.max' => 'Email не должен превышать 255 символов.',
            'message.max' => 'Сообщение не должно превышать 5000 символов.',
            'g-recaptcha-response.required' => 'Подтвердите, что вы не робот.',
            'g-recaptcha-response.captcha' => 'Проверка reCAPTCHA не пройдена.',
        ];

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'company' => 'nullable|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'nullable|string|max:5000',
            'g-recaptcha-response' => 'required|captcha',
            'no_company' => 'nullable|in:1',
        ], $messages);

        // Если стоит галочка "нет компании", обнуляем компанию
        $company = $request->has('no_company') ? null : $request->company;

        $ip = $request->ip();
        $email = $request->email;
        
        $rateLimitKey = 'contact_request_ip:' . $ip;
        if (RateLimiter::tooManyAttempts($rateLimitKey, 1)) {
            $seconds = RateLimiter::availableIn($rateLimitKey);
            return response()->json([
                'success' => false,
                'message' => "Слишком много запросов. Подождите {$seconds} сек."
            ], 429);
        }
        
        RateLimiter::hit($rateLimitKey, 60);

        if ($email) {
            $emailRequestCount = ContactRequest::where('email', $email)->count();
            
            if ($emailRequestCount >= 3) {
                return response()->json([
                    'success' => false,
                    'message' => 'Достигнут лимит заявок для этого email.'
                ], 429);
            }
        }

        try {
            $contactRequest = ContactRequest::create([
                'name' => $request->name,
                'company' => $company,
                'email' => $email,
                'message' => $request->message,
                'ip_address' => $ip,
                'status' => ContactRequest::STATUS_NEW,
            ]);
        } catch (\Exception $e) {
            \Log::error('Ошибка сохранения: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Ошибка при сохранении заявки.'
            ], 500);
        }

        try {
            $this->sendEmail($request, $contactRequest, $company);
        } catch (\Exception $e) {
            \Log::error('Ошибка отправки email: ' . $e->getMessage());
        }

        return response()->json([
            'success' => true,
            'message' => 'Заявка отправлена! Мы свяжемся с вами в ближайшее время.'
        ]);
    }

    private function sendEmail(Request $request, ContactRequest $contactRequest, $company)
    {
        if (!env('MAIL_HOST') || !env('MAIL_USERNAME') || !env('MAIL_PASSWORD')) {
            return;
        }

        $mail = new PHPMailer(true);
        $mail->CharSet = 'UTF-8';
        $mail->isSMTP();
        $mail->Host = env('MAIL_HOST');
        $mail->SMTPAuth = true;
        $mail->Username = env('MAIL_USERNAME');
        $mail->Password = env('MAIL_PASSWORD');
        $mail->SMTPSecure = env('MAIL_ENCRYPTION');
        $mail->Port = env('MAIL_PORT');

        $mail->setFrom(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME', 'ServiceName'));
        $mail->addAddress(env('MAIL_TO_ADDRESS'));
        
        if ($request->email) {
            $mail->addReplyTo($request->email, $request->name);
        }

        $mail->isHTML(true);
        $mail->Subject = 'Новая заявка №' . $contactRequest->id;

        $companyName = $company ?: 'Не указана';
        $messageText = $request->message ?: 'Не указано';
        
        $mail->Body = "
            <div style='font-family: Arial, sans-serif; max-width: 600px;'>
                <h2 style='color: #1b2d42;'>Новая заявка с сайта</h2>
                <div style='background: #f0f4f8; padding: 20px; border-radius: 4px;'>
                    <p><strong>Номер заявки:</strong> #{$contactRequest->id}</p>
                    <p><strong>Имя:</strong> {$request->name}</p>
                    <p><strong>Компания:</strong> {$companyName}</p>
                    <p><strong>E-mail:</strong> {$request->email}</p>
                    <p><strong>Сообщение:</strong><br>{$messageText}</p>
                    <hr>
                    <p style='color: #94a3b8; font-size: 12px;'>Заявка от {$contactRequest->created_at->format('d.m.Y H:i')}</p>
                </div>
            </div>
        ";

        $mail->send();
    }
}
