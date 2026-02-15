<?php

namespace App\Http\Controllers\Auth;

use App\Models\AuthUser;
use Auth;
use Hash;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginAuthRequest;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(LoginAuthRequest $request)
    {
        // \auth()->attempt();
        if (Auth::attempt($request->only('email','password'))) {

            return redirect()->route('auth.showProfile');
        }
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('auth.showLogin');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $data = $request->validate(rules: [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:auth_users',
            'password' => 'min:2|required|string|confirmed',
            // 'password_confirmation' => 'required_with:password|same:password',
        ]);

        $data['password'] = Hash::make($data['password']);
        $user = AuthUser::create($data);

        Auth::login($user);

        return redirect()-route('auth.showProfile');
    }

    public function showProfile()
    {
        $user = Auth::user();

        return view('auth.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:auth_users,email,' . Auth::id(),
        ]);

        $user = Auth::user();
        $user->update($data);

        return redirect()->route('auth.showProfile')->with('status', 'User is updated successfuli!');
    }

    public function showPassword()
    {
        return view('auth.password');
    }

    public function updatePassword(Request $request)
    {
        $data = $request->validate([
            'current_password' => 'min:2|required|string',
            'new_password' => 'min:2|required|string|confirmed'
        ]);

        $user = Auth::user();

        if(!Hash::check($data['current_password'], $user->password)) {

            return back()->withErrors(['current_password' => 'Current password is invalid.']);
        }

        $user->password = Hash::make($data['new_password']);
        $user->save();

        return redirect()->route('auth.showProfile')->with('newPass', 'The passward is changed successfuly!');
    }
}
