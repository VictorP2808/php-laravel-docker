<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        // Validate the request data
        $formFields = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email'],
            'ticker' => 'required',
            'subject' => 'required',
            'message' => 'required',
        ]);
    
        // Create a new Contact model instance and save it to the database
        $contact = new Contact($formFields);
        $contact->save();
    
        // Send the contact email
        $name = $formFields['name'];
        $email = $formFields['email'];
        $ticker = $formFields['ticker'];
        $subject = $formFields['subject'];
        $message = $formFields['message'];
    
        // Mail::to('renckrm92@gmail.com')->send(new ContactMail($name, $email, $ticker, $subject, $message));
    
        return redirect('/')->with(['message' => 'Thank you for contacting us. Our advisers will review your message and get back to you ASAP.']);
    }
}