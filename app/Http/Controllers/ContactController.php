<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use App\Models\Message;
use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function index(): View
    {
        return view('contact');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:5000',
        ]);

        Message::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'subject' => $validated['subject'],
            'body' => $validated['message'],
        ]);

        $adminEmail = Setting::get('email', config('mail.from.address'));

        Mail::to($adminEmail)->send(new ContactMail($validated));

        return back()->with('success', __('portfolio.messages.contact_success'));
    }
}
