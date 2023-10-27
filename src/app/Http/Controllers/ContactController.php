<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Http\Requests\ContactFormRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function confirm(ContactFormRequest $request)
    {
        $contact = [
            'last_name' => $request->input('last_name'),
            'first_name' => $request->input('first_name'),
            'gender' => $request->input('gender'),
            'email' => $request->input('email'),
            'postcode' => $request->input('postcode'),
            'address' => $request->input('address'),
            'building_name' => $request->input('building_name'),
            'opinion' => $request->input('opinion'),
        ];
        session(['contactData' => $contact]);
        return view('confirm', compact('contact'));
    }
    public function store(ContactFormRequest $request)
    {
        $contact = [
            'last_name' => $request->input('last_name'),
            'first_name' => $request->input('first_name'),
            'gender' => $request->input('gender'),
            'email' => $request->input('email'),
            'postcode' => $request->input('postcode'),
            'address' => $request->input('address'),
            'building_name' => $request->input('building_name'),
            'opinion' => $request->input('opinion'),
        ];
        $fullName = $contact['last_name'] . ' ' . $contact['first_name'];
        $limitedFullName = Str::limit($fullName, 255);
        $contact['name'] = $limitedFullName;

        unset($contact['last_name']);
        unset($contact['first_name']);

        $gender = $contact['gender'] == '1' ? 1 : 2;
        $contact['gender'] = $gender;

        Contact::create($contact);
        return view('thanks');
    }
}
