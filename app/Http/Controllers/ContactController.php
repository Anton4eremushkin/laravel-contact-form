<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function store(Request $request) {

        $validated  = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
        ]);

        $contact = Contact::create($validated);

        Mail::to(env('MAIL_TO_ADRESS'))->send(new ContactMail($contact));

        return response()->json(['message' => 'Успешно отправлено']);
    }
}
