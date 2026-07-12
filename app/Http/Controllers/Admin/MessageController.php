<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\MessageReplyMail;
use App\Models\Message;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class MessageController extends Controller
{
    public function index(): View
    {
        return view('admin.messages.index', [
            'messages' => Message::latest()->get(),
        ]);
    }

    public function show(Message $message): View
    {
        $message->update(['is_read' => true]);

        return view('admin.messages.show', compact('message'));
    }

    public function reply(Request $request, Message $message): RedirectResponse
    {
        $validated = $request->validate([
            'subject' => 'required|string|max:255',
            'body' => 'required|string|max:5000',
        ]);

        try {
            Mail::to($message->email)->send(new MessageReplyMail($message, $validated));
        } catch (\Throwable) {
            return back()
                ->withInput()
                ->with('error', 'Impossible d\'envoyer la réponse. Vérifiez la configuration e-mail (.env).');
        }

        return back()->with('success', 'Réponse envoyée à '.$message->email.'.');
    }

    public function destroy(Message $message): RedirectResponse
    {
        $message->delete();

        return redirect()->route('admin.messages.index')->with('success', 'Message supprimé.');
    }
}
