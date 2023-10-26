<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;


class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        $contacts = Contact::paginate(10);

        return view('admin.index', compact('contacts'));
    }

    public function search(Request $request)
    {
        $name = $request->input('name');
        $gender = $request->input('gender');
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $email = $request->input('email');

        $query = Contact::query();
        if ($name) {
            $query->where('name', 'LIKE', '%' . $name . '%');
        }

        if ($gender && $gender !== '0') {
            $query->where('gender', $gender);
        }

        if ($start_date && $end_date) {
            $query->whereBetween('created_at', [$start_date, $end_date]);
        }

        if ($email) {
            $query->where('email', 'LIKE', '%' . $email . '%');
        }

        $contacts = $query->paginate(10);
        $searching = true;
        return view('admin.index', compact('contacts', 'searching'));
    }
    public function destroy()
    {
        Contact::find(request('id'))->delete();
        return redirect()->route('admin.index');
    }

    public function reset()
    {
        return redirect()->route('admin.index');
    }
}
