<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (Auth::user()->role_id == 1) {
            return view('admin.dashboard');
        } else {
            return redirect('/');
        }
    }
    public function email_settings()
    {

       $email =  DB::table('email_settings')->first();

        return view('admin.email.updatemail',compact(['email']));
    }
    public function email_settings_post(Request $req)
    {
        // print_r($req->all());
        // die();

        $email = [
            'user_subject' => $req->user_sub,
            'user_description' => $req->user_description,
            'trader_subject' => $req->trader_sub,
            'trader_description' => $req->trader_description,
            'updated_at' => date("y-m-d h:i:s")
    ];
        DB::table('email_settings')->where("id",1)->update($email);

        return redirect('email_settings');
    }
}
