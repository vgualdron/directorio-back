<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Exceptions\AuthenticateException;

class LoginController extends Controller
{
    public function login(Request $request) {
        $this->validateLogin($request);

        if (Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'token' => $request->user()->createToken($request->name),
                'message' => $request->user()
            ]);
        }

        throw new AuthenticateException;
    }

    public function validateLogin(Request $request) {
        return $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'name' => 'required',
        ]);
    }
}
