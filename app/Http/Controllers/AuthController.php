<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    
    public function create()
    {
        return view('auth.create');
    }

   
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');
        // Checking for remember checkbox
        $remember = $request->filled('remember');

        if(Auth::attempt($credentials, $remember)) {
            // If you are logged in, you will be redirected to the last viewed page
            return redirect()->intended('/');
        } else {
            return redirect()->back()->with('error', 'Invalid credentials');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        Auth::logout();

        request()->session()->invalidate();

        //This would regenerate the csrf token for this session
        request()->session()->regenerateToken();

        return redirect('/');

    }
}
