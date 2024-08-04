<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Session;
use Hash;

class AuthenticationController extends Controller
{
    public function view() {
        return view('login');
    }

    public function login (Request $request) {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);
        if(Auth::attempt($credentials))
        {
            $request->session()->regenerate();
            if(Auth::user()->role_id == 1) {
                return redirect('admin/dashboard')
                ->withSuccess('You have successfully logged in!');
            }
            else if(Auth::user()->role_id == 2) {
                return redirect('branch-user/dashboard')
                ->withSuccess('You have successfully logged in!');
            }
            else if(Auth::user()->role_id == 3) {
                return redirect('/home')
                ->withSuccess('You have successfully logged in!');
            }
            else {
                return back()->withErrors([
                    'email' => 'Your provided credentials do not match in our records.',
                ]);
            }
        }
        return back()->withErrors([
            'email' => 'Your provided credentials do not match in our records.',
        ]);
    }

    public function registerView() {
        return view('register');
    }

    public function register(Request $request) {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ]);

        $user = User::select('username')->where('phone', $request->phone)->first();
        
        if($user != null) {
            return back()->withErrors([
                'error' => 'Phone number already exist.',
            ]);
        }
        
        $user = User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'address' => $request->address,
            'city_id' => 1,
            'township_id' => 1,
            'role_id' => 3,
            'status' => 1
        ]);
        //dd($user);
        return redirect()->route('/login')->with('success','You has been registered successfully.');
    }

    public function profile() {
        return view('profile');
    }

    public function logout() {
        Session::flush();
        Auth::logout();
        return Redirect('login');
    }
}