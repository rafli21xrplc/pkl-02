<?php

namespace App\Http\Controllers;


class auth extends Controller
{
    


    // protected function validationRegister(Request $request): RedirectResponse
    // {
    // $request->validate([
    //     'name' => ['required'],
    //     'email' => ['required'],
    //     'password' => ['required'],
    // ]);

    // User::create([
    //     'name' => $request->name,
    //     'email' => $request->email,
    //     'password' => Hash::make($request->password),
    // ]);

    // $validate = $request->validate([
    //     'email' => 'required|unique:users|max:100|email:rfc,dns',
    //     'name' => 'required|max:255',
    //     'password' => 'required|min:5|max:100',
    // ]);

    // $validate["password"] = Hash::make($validate["password"]);
    // User::create($validate);
    // return redirect("/SignIn")->with("message", "user data was successful!");
    // return redirect()->route('viewSignIn')->with('success', 'Registration successful. You can now log in.');
    // }
}
