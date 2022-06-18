<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login() {
        return view('login');
    }

    public function loginPost(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->with('emailNotFound', 'Email tidak ditemukan');
        }

        if (!Hash::check($request->password, $user->password)) {
            return back()->with('passwordError', 'Password salah');
        } else {            
            session([
                'login' => TRUE,
                'name' => $user->name,
                'user_id' => $user->id
            ]);

            if ($user->role == 'user') {
                session(['role' => 'user']);
            } else if ($user->role == 'admin') {
                session(['role' => 'admin']);
            } else if ($user->role == 'seller') {
                session(['role' => 'seller']);
            }

            return redirect('/');
        }
    }

    public function logout(Request $request) {
        $request->session()->flush();

        return redirect('/');
    }
}
