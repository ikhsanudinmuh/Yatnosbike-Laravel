<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index() {
        return view('register');
    }

    public function register(Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'confirm_password' => 'required|same:password',
        ]);

        $hashedPassword = Hash::make($request->password);
        $request->merge(['password' => $hashedPassword]);

        $user = User::create($request->all());

        if ($user) {
            return redirect(route('loginUser'))
                ->with('registerSuccess', 'Pendaftaran berhasil, silahkan masuk');
        } else {
            return back()
                ->with('registerFailed', 'Pendaftaran gagal');
        }
    }
}
