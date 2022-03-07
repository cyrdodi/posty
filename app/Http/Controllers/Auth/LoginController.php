<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PDO;

class LoginController extends Controller
{

  public function __construct()
  {
    $this->middleware('guest');
  }

  public function index()
  {
    return view('auth.login');
  }

  public function store(Request $request)
  {
    $this->validate($request, [
      'email' => 'required|email',
      'password' => 'required' // it's validate the password and the password_confirmation automatically by laravel
    ]);

    // sign in
    if (!auth()->attempt($request->only('email', 'password'), $request->has('remember'))) {
      return back()->with('status', 'Inavalid login details');
    }

    // redirect to dashboard
    return redirect()->route('dashboard');
  }
}
