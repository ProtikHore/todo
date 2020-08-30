<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        $title = 'Todo Login';
        return view('login.index', compact('title'));
    }

    public function logout()
    {
        session()->flush();
        return redirect('/');
    }


    public function login(Request $request)
    {
        $request->validate([
            'email' => [
                'required',
                'email'
            ],
            'password' => 'required|string',
        ]);

        $loginData = $request->except('_token', 'confirmed');
        $loginData['password'] = sha1($loginData['password']);
        $user = User::where($loginData)->first();
        if ($user) {
            session([
                'login_success_status' => true,
                'id' => $user->id,
                'email' => $user->email,
                'name' => $user->name
            ]);
            return response()->json(['message' => 'Authorized User', 'id' => $user->id]);
        } else {
            return response()->json('Unauthorized Access!');
        }
    }
}
