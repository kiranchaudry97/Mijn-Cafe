<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ContactMessage;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    /** Toon het formulier */
    public function show()
    {
        return view('contact');
    }

    /** Verwerk en verstuur de email */
    public function send(Request $request)
    {
        $data = $request->validate([
            'name'    => 'required|string|max:100',
            'email'   => 'required|email|max:255',
            'subject' => 'required|string|max:150',
            'message' => 'required|string',
        ]);

        // Stuur de Mailable
        Mail::to(config('mail.admin_address'))
            ->send(new ContactMessage($data));

        return back()->with('success', 'Bedankt voor je bericht! We nemen zo spoedig mogelijk contact op.');
    }
}
