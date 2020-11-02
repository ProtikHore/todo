<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationRequest;
use App\User;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function index()
    {
        $title = 'Todo Registration';
        return view('registration.index', compact('title'));
    }

    public function save(RegistrationRequest  $request)
    {
        return response()->json('hello');
        $data = new User();
        $data->name = $request->get('name');
        $data->contact_no = $request->get('contact_no');
        $data->email = $request->get('email');
        $data->password = sha1($request->get('password'));
        $data->save();
        return response()->json($request);
    }
}
