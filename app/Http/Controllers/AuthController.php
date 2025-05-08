<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //
    public function indexLogin()
    {
        return view("auth.login");
    }

    public function indexRegister()
    {
        return view("auth.register");
    }

    public function login(LoginRequest $request)
    {
        $credential = $request->validated();

        if (
            Auth::guard("user")->attempt($credential) ||
            Auth::guard("admin")->attempt($credential)
        ) {
            $request->session()->regenerate();
            if (
                Auth::guard("user")->user() ||
                Auth::guard("admin")->user()
            ) {
                if (Auth::guard("admin")->check()) {
                    return redirect()
                        ->route("admin.dashboard")
                        ->with("success", "Berhasil Login");
                }

                return redirect()
                    ->route("home")
                    ->with("success", "Selamat datang " . Auth::guard("user")->user()->name);
            }
        } else {
            return redirect()
                ->route("login")
                ->with("error", "Tidak Berhasil Login");
        }
    }

    public function showRegister()
    {
        return view("auth.register");
    }

    // create register function
    public function register(RegisterRequest $request)
    {
        $credential = $request->validated();

        $user = User::create($credential);

        if ($user) {
            return redirect()
                ->route("login")
                ->with("success", "Berhasil Registrasi");
        }

        return redirect()
            ->back()
            ->with("error", "Gagal Registrasi");
    }


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route("login")
            ->with("success", "Berhasil Logout");
    }
}
