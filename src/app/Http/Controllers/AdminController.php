<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;


class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // 認証が必要なアクションを保護
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
        $created_at = $request->input('created_at');
        $email = $request->input('email');

        $query = Contact::query();
        if ($name) {
            $query->where('name', 'LIKE', '%' . $name . '%');
        }

        if ($gender && $gender !== '0') {
            $query->where('gender', $gender);
        }

        if ($created_at) {
            $query->whereDate('created_at', $created_at);
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
