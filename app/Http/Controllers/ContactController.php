<?php
// app/Http/Controllers/ContactController.php

namespace App\Http\Controllers;

use App\Models\ContactRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\RateLimiter;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        // Валидация
        $request->validate([
            'name' => 'required|string|max:255',
            'company' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'message' => 'nullable|string|max:5000',
        ]);

        $ip = $request->ip();
        $email = $request->email;
        
        // Проверка лимита: 1 запрос в минуту с одного IP
        $rateLimitKey = 'contact_request_ip:' . $ip;
        if (RateLimiter::tooManyAttempts($rateLimitKey, 1)) {
            $seconds = RateLimiter::availableIn($rateLimitKey);
            return response()->json([
                'success' => false,
                'message' => "Слишком много запросов. Пожалуйста, подождите {$seconds} сек."
            ], 429);
        }
        
        // Увеличиваем счетчик для IP
        RateLimiter::hit($rateLimitKey, 60);

        // Проверка по email: максимум 3 заявки с одного email
        if ($email) {
            $emailRequestCount = ContactRequest::where('email', $email)->count();
            
            if ($emailRequestCount >= 3) {
                return response()->json([
                    'success' => false,
                    'message' => 'Достигнут лимит заявок для этого email. Пожалуйста, свяжитесь с нами по телефону.'
                ], 429);
            }
        }

        // Сохраняем заявку в БД
        try {
            $contactRequest = ContactRequest::create([
                'name' => $request->name,
                'company' => $request->company,
                'email' => $email,
                'message' => $request->message,
                'ip_address' => $ip,
                'status' => ContactRequest::STATUS_PENDING,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Ошибка при сохранении заявки.'
            ], 500);
        }

        // Отправка email (если настроен SMTP)
        try {
            $this->sendEmail($request, $contactRequest);
        } catch (\Exception $e) {
            // Логируем ошибку, но не показываем пользователю
            \Log::error('Ошибка отправки email: ' . $e->getMessage(), [
                'contact_request_id' => $contactRequest->id
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Заявка отправлена! Мы свяжемся с вами в ближайшее время.'
        ]);
    }

    /**
     * Отправка email уведомления
     */
    private function sendEmail(Request $request, ContactRequest $contactRequest)
    {
        // Проверяем, что есть настройки SMTP
        if (!env('MAIL_HOST') || !env('MAIL_USERNAME') || !env('MAIL_PASSWORD')) {
            return; // Пропускаем отправку если нет настроек
        }

        $mail = new PHPMailer(true);

        $mail->isSMTP();
        $mail->Host = env('MAIL_HOST', 'smtp.mail.ru');
        $mail->SMTPAuth = true;
        $mail->Username = env('MAIL_USERNAME');
        $mail->Password = env('MAIL_PASSWORD');
        $mail->SMTPSecure = env('MAIL_ENCRYPTION', 'ssl');
        $mail->Port = env('MAIL_PORT', 465);
        $mail->CharSet = 'UTF-8';

        $mail->setFrom(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME', 'ServiceName'));
        
        // Основной получатель
        $mail->addAddress(env('MAIL_TO_ADDRESS', 'info@servicename-group.ru'));
        
        // Отправляем копию заявителю, если указан email
        if ($request->email) {
            $mail->addReplyTo($request->email, $request->name);
        }

        $mail->isHTML(true);
        $mail->Subject = 'Новая заявка №' . $contactRequest->id . ' с сайта ServiceName';

        $body = $this->buildEmailBody($request, $contactRequest);

        $mail->Body = $body;
        $mail->AltBody = strip_tags(str_replace(['<br>', '</p>'], ["\n", "\n\n"], $body));

        $mail->send();
    }

    /**
     * Формирование тела письма
     */
    private function buildEmailBody(Request $request, ContactRequest $contactRequest): string
    {
        $statusLabel = $contactRequest->getStatusLabel();
        
        return "
            <div style='font-family: Arial, sans-serif; max-width: 600px;'>
                <h2 style='color: #1b2d42;'>Новая заявка с сайта</h2>
                <div style='background: #f0f4f8; padding: 20px; border-radius: 4px;'>
                    <p><strong>Номер заявки:</strong> #{$contactRequest->id}</p>
                    <p><strong>Статус:</strong> {$statusLabel}</p>
                    <p><strong>Имя:</strong> " . htmlspecialchars($request->name) . "</p>
                    <p><strong>Компания:</strong> " . htmlspecialchars($request->company ?: 'Не указана') . "</p>
                    <p><strong>E-mail:</strong> " . htmlspecialchars($request->email ?: 'Не указан') . "</p>
                    <p><strong>Сообщение:</strong><br>" . nl2br(htmlspecialchars($request->message ?: 'Не указано')) . "</p>
                    <hr>
                    <p style='color: #94a3b8; font-size: 12px;'>
                        <small>IP: " . htmlspecialchars($contactRequest->ip_address) . "</small><br>
                        <small>Заявка отправлена " . $contactRequest->created_at->format('d.m.Y H:i') . "</small>
                    </p>
                </div>
            </div>
        ";
    }
}