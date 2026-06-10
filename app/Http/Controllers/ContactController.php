<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'company' => 'nullable|string|max:255',
            'phone' => 'required|string|max:50',
            'email' => 'nullable|email|max:255',
            'message' => 'nullable|string|max:5000',
        ]);

        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host       = env('MAIL_HOST', 'smtp.mail.ru');
            $mail->SMTPAuth   = true;
            $mail->Username   = env('MAIL_USERNAME');
            $mail->Password   = env('MAIL_PASSWORD');
            $mail->SMTPSecure = env('MAIL_ENCRYPTION', 'ssl');
            $mail->Port       = env('MAIL_PORT', 465);
            $mail->CharSet    = 'UTF-8';

            $mail->setFrom(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME', 'ServiceName'));
            $mail->addAddress(env('MAIL_TO_ADDRESS', 'info@servicename-group.ru'));

            $mail->isHTML(true);
            $mail->Subject = 'Новая заявка с сайта ServiceName';

            $body = "
                <h2>Новая заявка с сайта</h2>
                <p><strong>Имя:</strong> " . htmlspecialchars($request->name) . "</p>
                <p><strong>Компания:</strong> " . htmlspecialchars($request->company ?: 'Не указана') . "</p>
                <p><strong>Телефон:</strong> " . htmlspecialchars($request->phone) . "</p>
                <p><strong>E-mail:</strong> " . htmlspecialchars($request->email ?: 'Не указан') . "</p>
                <p><strong>Сообщение:</strong><br>" . nl2br(htmlspecialchars($request->message ?: 'Не указано')) . "</p>
                <hr>
                <p><small>Заявка отправлена " . now()->format('d.m.Y H:i') . "</small></p>
            ";

            $mail->Body = $body;
            $mail->AltBody = strip_tags(str_replace(['<br>', '</p>'], ["\n", "\n\n"], $body));

            $mail->send();

            return response()->json([
                'success' => true,
                'message' => 'Заявка отправлена! Мы свяжемся с вами в течение 24 часов.'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Ошибка отправки. Пожалуйста, свяжитесь с нами по телефону.'
            ], 500);
        }
    }
}