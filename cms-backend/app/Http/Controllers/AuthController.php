<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (session('user_id')) {
            return redirect('/admin/dashboard');
        }
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password) && $user->is_active) {
            session(['user_id' => $user->id, 'user_name' => $user->name, 'user_role' => $user->role]);
            return redirect('/admin/dashboard');
        }

        return back()->withErrors(['email' => 'Invalid credentials or account is inactive.']);
    }

    public function logout()
    {
        session()->flush();
        return redirect('/admin/login');
    }
}
