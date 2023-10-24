<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Http\Requests\ContactFormRequest;

class ContactController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function confirm(ContactFormRequest $request)
    {
        $contact = $request->only(['name', 'gender', 'email', 'postcode', 'address', 'building_name', 'opinion']);
        session(['contactData' => $contact]);
        return view('confirm', compact('contact'));
    }

    public function store(ContactFormRequest $request)
    {
        $contact = $request->only(['name', 'gender', 'email', 'postcode', 'address', 'building_name', 'opinion']);
        $gender = $request->input('gender') == '男性' ? 1 : 2;
        $contact['gender'] = $gender;

        Contact::create($contact);
        return view('thanks');
    }
}
