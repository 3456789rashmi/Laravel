<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\DemoEmail;

class EmailController extends Controller
{
    /**
     * TOPIC: SENDING EMAILS
     * Using Laravel's Mail facade to send emails
     */

    // Show email form
    public function showEmailForm()
    {
        return view('emails.email-form');
    }

    // Send a simple email
    public function sendSimpleEmail(Request $request)
    {
        $request->validate([
            'recipient_email' => 'required|email',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $data = [
            'email' => $request->input('recipient_email'),
            'subject' => $request->input('subject'),
            'message_body' => $request->input('message'),
        ];

        try {
            // Send email using Mail facade
            Mail::send('emails.simple-email-template', $data, function ($message) use ($data) {
                $message->to($data['email'])
                        ->subject($data['subject']);
            });

            return view('emails.email-result', [
                'status' => 'success',
                'message' => 'Email sent successfully to ' . $data['email'],
            ]);
        } catch (\Exception $e) {
            return view('emails.email-result', [
                'status' => 'error',
                'message' => 'Failed to send email: ' . $e->getMessage(),
            ]);
        }
    }

    // Send email using Mailable class
    public function sendMailableEmail(Request $request)
    {
        $request->validate([
            'recipient_email' => 'required|email',
            'user_name' => 'required|string',
        ]);

        try {
            Mail::to($request->input('recipient_email'))
                ->send(new DemoEmail($request->input('user_name')));

            return view('emails.email-result', [
                'status' => 'success',
                'message' => 'Welcome email sent successfully!',
            ]);
        } catch (\Exception $e) {
            return view('emails.email-result', [
                'status' => 'error',
                'message' => 'Failed to send email: ' . $e->getMessage(),
            ]);
        }
    }

    // Send email with attachments
    public function sendEmailWithAttachment(Request $request)
    {
        $request->validate([
            'recipient_email' => 'required|email',
            'file_path' => 'nullable|string',
        ]);

        try {
            Mail::send('emails.attachment-email-template', [], function ($message) use ($request) {
                $message->to($request->input('recipient_email'))
                        ->subject('Email with Attachment')
                        ->attach(storage_path('app/files/document.pdf')); // Attach a file
            });

            return view('emails.email-result', [
                'status' => 'success',
                'message' => 'Email with attachment sent successfully!',
            ]);
        } catch (\Exception $e) {
            return view('emails.email-result', [
                'status' => 'error',
                'message' => 'Failed to send email: ' . $e->getMessage(),
            ]);
        }
    }

    // Send bulk/multiple emails
    public function sendBulkEmails(Request $request)
    {
        $request->validate([
            'recipients' => 'required|string', // Comma-separated emails
            'subject' => 'required|string',
            'message' => 'required|string',
        ]);

        $recipients = array_map('trim', explode(',', $request->input('recipients')));
        
        try {
            foreach ($recipients as $email) {
                Mail::send('emails.simple-email-template', [
                    'email' => $email,
                    'subject' => $request->input('subject'),
                    'message_body' => $request->input('message'),
                ], function ($message) use ($email, $request) {
                    $message->to($email)
                            ->subject($request->input('subject'));
                });
            }

            return view('emails.email-result', [
                'status' => 'success',
                'message' => 'Emails sent successfully to ' . count($recipients) . ' recipients!',
            ]);
        } catch (\Exception $e) {
            return view('emails.email-result', [
                'status' => 'error',
                'message' => 'Failed to send emails: ' . $e->getMessage(),
            ]);
        }
    }

    // Send email with HTML content
    public function sendHtmlEmail(Request $request)
    {
        $request->validate([
            'recipient_email' => 'required|email',
            'html_content' => 'required|string',
        ]);

        try {
            Mail::send([], [], function ($message) use ($request) {
                $message->to($request->input('recipient_email'))
                        ->subject('HTML Email')
                        ->html($request->input('html_content'));
            });

            return view('emails.email-result', [
                'status' => 'success',
                'message' => 'HTML email sent successfully!',
            ]);
        } catch (\Exception $e) {
            return view('emails.email-result', [
                'status' => 'error',
                'message' => 'Failed to send email: ' . $e->getMessage(),
            ]);
        }
    }
}
