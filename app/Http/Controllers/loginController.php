<?php

namespace App\Http\Controllers;

use App\Models\admin;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
            'email' => 'required|string|email|max:50',
            'password' => 'required|string|min:6',
        ]);

        if (Auth::attempt($validate)) {
            if (auth()->user()->role == "admin") {
                $request->session()->regenerate();
                return redirect()->intended('admin/jadwal');
            } else if (auth()->user()->role == "user")
                $request->session()->regenerate();
            return redirect()->intended('/dashboard');
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
            'name' => 'required|string|max:50',
            'email' => 'required|string|email|max:50|unique:users',
            'password' => 'required|string|min:6',
        ]);

        $code = Str::uuid();

        User::create([
            'code' => $code,
            'email' => $validate['email'],
            'name' => $validate['name'],
            'password' => Hash::make($validate['password']),
        ]);

        admin::create([
            'users_id' => $code,
            'role' => 'admin',
        ]);

        return redirect()->route('viewSignIn')->with('success', 'Registration successful. You can now log in.');
    }

    protected function signOut(Request $request)
    {
        Auth::logout();
        return redirect()->route('viewSignIn');
    }
}
