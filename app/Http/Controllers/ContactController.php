<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ContactMail;
use App\Models\WebSetting;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    /**
     * Show the contact form
     */
    public function index()
    {
        $settings = WebSetting::first();
        return view('frontend.contact-us', compact('settings'));
    }

    /**
     * Send contact email
     */
    public function send(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        try {
            // Prepare email details
            $details = [
                'name' => $request->name,
                'email' => $request->email,
                'subject' => $request->subject,
                'message' => $request->message,
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ];

            // Send email to admin
            $adminEmail = config('mail.from.address');

            if (empty($adminEmail)) {
                throw new \Exception('Admin email not configured. Please check your mail settings.');
            }

            Mail::to($adminEmail)->send(new ContactMail($details));

            // Optional: Save to database for record
            // You can create a ContactMessage model to save messages

            return redirect()->back()->with('success', 'Your message has been sent successfully! We will get back to you within 24 hours.');

        } catch (\Exception $e) {
            Log::error('Contact form error: ' . $e->getMessage());

            return redirect()->back()
                ->withInput()
                ->with('error', 'Sorry, we could not send your message. Please try again later or contact us directly at support@medical.pk');
        }
    }
}
