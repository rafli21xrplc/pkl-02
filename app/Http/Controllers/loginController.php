<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class loginController extends Controller
{
    use Authenticatable;

    protected function viewSignIn(Request $request): Response
    {
        return response()->view('signIn', ['title' => 'SignIn']);
    }
    protected function validationSignIn(Request $request)
    {

        $validate = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($validate)) {
            $request->session()->regenerate();
            return redirect()->intended('admin/dashboard');
        }

        return back()->with("error", "SignIn failed");
    }

    protected function viewSignUp(Request $request): Response
    {
        return response()->view('signUp', ['title' => 'SignUp']);
    }

    protected function validationSignUp(Request $request)
    {
        $validate = $request->validate([
            'email' => 'required',
            'name' => 'required',
            'password' => 'required',
        ]);

        $validate['password'] = Hash::make($validate['password']);
        User::create($validate);
        return redirect()->route('viewSignIn')->with('success', 'Registration successful. You can now log in.');
    }

    protected function signOut(Request $request)
    {
        Auth::logout();
        return redirect()->route('viewSignIn');
    }
}
