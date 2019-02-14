<?php

namespace App\Http\Controllers\Frontend;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
    	return view('frontend.login');
    }

    public function register(Request $request)
    {
    	return view('frontend.register');
    }

    public function doLogin(Request $request)
    {
    	if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('home');
        } else {
            $query = User::where('email', $request->email);
            $find  = $query->first();
            $check = $query->count();
            if ($check) {
                return redirect()->back()->with('failed', 'Invalid password');
            } else {
                return redirect()->back()->with('failed', 'Invalid email');
            }
        }
    }

    public function doRegister(Request $request)
    {
    	$validator = Validator::make($request->all(), [
            'email'    => 'required|unique:users,email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

    	$index = new User;

    	$index->name     = $request->name;
    	$index->email    = $request->email;
    	$index->password = bcrypt($request->password);

    	$index->save();

    	return redirect()->route('login')->with('success', 'Data has been registerd!');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }
}
