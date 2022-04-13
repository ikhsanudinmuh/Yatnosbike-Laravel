<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function loginUser() {
        return view('login');
    }

    public function loginUserPost(Request $request) {
        $request->session()->regenerate();

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
                'userId' => $user->id
            ]);

            return redirect('/');
        }
    }

    public function logout(Request $request) {
        $request->session()->flush();

        return redirect('/');
    }
}
