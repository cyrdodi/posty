<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
  public function __construct()
  {
    $this->middleware('guest');
  }
  public function index()
  {
    return view('auth.register');
  }

  public function store(Request $request)
  {
    $this->validate($request, [
      'name' => 'required|string|max:255',
      'username' => 'required|max:255',
      'email' => 'required|email|max:255|unique:users',
      'password' => 'required|confirmed' // it's validate the password and the password_confirmation automatically by laravel
    ]);
    // below this line will not execute and will redirect, if validation fails

    // store to users table
    User::create([
      'name' => $request->name,
      'username' => $request->username,
      'email' => $request->email,
      'password' => Hash::make($request->password)
    ]);

    // sign in
    auth()->attempt($request->only('email', 'password'));

    // redirect to dashboard
    return redirect()->route('dashboard');
  }
}
