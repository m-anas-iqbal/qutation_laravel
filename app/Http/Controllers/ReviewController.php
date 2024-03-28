<?php

namespace App\Http\Controllers;

use App\BusinessCategory;
use App\Review;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function index()
    {
        $traders = User::where('role_id', 2)->where('status',1)->get();
        return view('front.review', compact('traders'));
    }

    public function save(Request $request)
    {

        $this->validate($request, [
//            'email' => 'required|email|unique:users,email',
        ]);

        if (Auth::user()){
            Review::create([
                'user_id' => Auth::id(),
                'company_name' => $request->company_name,
                'title' => $request->title,
                'description' => $request->description,
                'name' => Auth::user()->name,
                'email' => Auth::user()->email,
                'phone' => Auth::user()->phone,
                'value' => $request->value,
                'recommend' => $request->recommend
            ]);
        }
        else {
            if ($request->password == '') {

                $random_password = substr(md5(mt_rand()), 0, 7);
                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => bcrypt($random_password),
                    'phone' => $request->phone
                ]);

                Review::create([
                    'user_id' => $user->id,
                    'company_name' => $request->company_name,
                    'title' => $request->title,
                    'description' => $request->description,
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'value' => $request->value,
                    'recommend' => $request->recommend
                ]);


                $details = [
                    'title' => 'Thanks to be part of our Service',
                    'subtitle' => 'We verified an account for You',
                    'body' => 'Your Password is: '. $random_password
                ];

                \Mail::to($request->email)->send(new \App\Mail\UserMail($details));

            } else {

                $this->validate($request, [
                    'email' => 'required|email|unique:users,email',
                ]);
                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => bcrypt($request->password),
                    'phone' => $request->phone
                ]);

                Review::create([
                    'user_id' => $user->id,
                    'company_name' => $request->company_name,
                    'title' => $request->title,
                    'description' => $request->description,
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'value' => $request->value,
                    'recommend' => $request->recommend
                ]);
            }
        }
        return redirect()->back()->with('success', 'Successfully Submitted Your Feedback!');
    }
}
