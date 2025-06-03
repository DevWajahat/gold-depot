<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreContactRequest;
use App\Models\Contact;
use Illuminate\Http\Request;
use Mockery\Matcher\Contains;

class ContactController extends Controller
{
    public function index()
    {
        return view('screens.web.contact.index');
    }

    public function store(StoreContactRequest $request)
    {

        Contact::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'message' => $request->message
        ]);

        return back()->with('message','Your Form Has been Submitted Successfully');
    }
}
