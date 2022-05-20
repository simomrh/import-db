<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
public function home(){
    return view('home');
}
    public function create(Request $request)
    {
        return view('contacts.create');
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
        ]);

        Contact::create($request->all());

        return back()->with('success', 'contact added successfully.');
    }
}
