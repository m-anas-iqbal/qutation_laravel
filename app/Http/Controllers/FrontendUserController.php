<?php

namespace App\Http\Controllers;

use App\BusinessCategory;
use App\City;
use App\Country;
use App\County;
use App\State;
use App\Town;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class FrontendUserController extends Controller
{
    public function create()
    {
        $countries = Country::all();
        $states = State::all();
        $counties = County::all();
        $cities = City::all();
        $towns = Town::all();
        $trades = BusinessCategory::all();
        $signup_status = 1;
        return view('front.signup', compact('countries', 'states', 'counties', 'cities', 'towns', 'trades', 'signup_status'));
    }

    public function login()
    {
        return view('front.login');
    }

    public function save(Request $request)
    {
        $user  = User::where('email', $request->email)->first();
        if (isset($user)){
            return redirect()->back()->with('error', 'Email Already Exist!');
        }
        else {
        User::create([
            'role_id' => 3,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
            return redirect()->back()->with('success', 'Account Created.');
        }
    }

    public function userLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {

            if (Auth::user()->role_id != 3) {
                Auth::logout();
                return redirect()->back()->withError('You have entered invalid credentials');
            } else {
                if (Auth::user()->status == 1) {
                    return redirect()->intended('/user-profile')
                        ->withSuccess('You have Successfully logged in');
                } else {
                    Auth::logout();
                    return redirect()->back()->withError('Your account is under verification');
                }
            }
        }

        return redirect()->back()->withError('You have entered invalid credentials');
    }

    public function traderLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            if (Auth::user()->role_id != 2) {
                Auth::logout();
                return redirect()->back()->withError('You have entered invalid credentials');
            } else {
                if (Auth::user()->status == 1) {
                    return redirect()->intended('/user-profile')
                        ->withSuccess('You have Successfully logged in');
                } else {
                    Auth::logout();
                    return redirect()->back()->withError('Your account is under verification');
                }
            }
        }

        return redirect()->back()->withError('You have entered invalid credentials');
    }

}
