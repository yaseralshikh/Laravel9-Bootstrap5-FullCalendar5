<?php

namespace App\Http\Controllers;

use App\Rules\ReCaptcha;
use Illuminate\Http\Request;
use App\Mail\ContactFormMail;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function sendEmail(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
            'g-recaptcha-response'  => ['required', new ReCaptcha],
        ]);

        Mail::to('admin@sweeklyplan.com')->send(new ContactFormMail($validatedData));

        return redirect()->back()->with('success', 'شكراً ،، لقد استلمنا الرسالة وسنرد عليك في اقرب وقت ممكن .');
    }
}
