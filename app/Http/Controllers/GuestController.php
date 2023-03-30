<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;


class GuestController extends Controller
{
    public function index(){
        return view('welcome');
    }

    public function contactView(){
        return view('contact');
    }


    public function contact(Request $request)
    {
        $request->validate([
            'email' => ['bail','required','email'],
            'message' => ['required', 'string', 'required']
        ]);

        $contact = Contact::create([
            'email' => $request->input('email'),
            'message' => $request->input('message')
        ]);

        $contact->save();

        return response([
            'message' => "message sended successfully"
        ],202);
    }
}
