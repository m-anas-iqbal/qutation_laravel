<?php

namespace App\Http\Controllers;

use App\Quote;
use App\User;
use App\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RequestQuoteController extends Controller
{
    public function requestQuote($user_id)
    {
        return view('front.request_quote', compact('user_id'));
    }

    public function sendQuote()
    {
        $traders = User::where('role_id', 2)->get();
        return view('front.send_quote', compact('traders'));
    }

    public function saveQuote(Request $request)
    {
        $this->validate($request, [
//            'email' => 'required|email|unique:users,email',
        ]);
        $settings = Setting::first();
$pushover = $settings->pushover;
$yours = env('MAIL_USERNAME');
$datetime = date("y-m-d h:i:s");
$company = User::where('id', $request->user_business_id)->first();
        if (Auth::user()){
            // Quote::create([
            //     'user_business_id' => $request->user_business_id,
            //     'user_id' => Auth::id(),
            //     'description' => $request->description,
            //     'job_status' => $request->job_status,
            //     'name' => Auth::user()->name,
            //     'email' => Auth::user()->email,
            //     'phone' => Auth::user()->phone,
            //     'postcode' => Auth::user()->postcode
            // ]);
            $qoutes = [
                    'user_business_id' => $request->user_business_id,
                    'user_id' => Auth::id(),
                    'description' => $request->description,
                    'job_status' => $request->job_status,
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'postcode' => $request->postcode
                ];
            Quote::create($qoutes);
            $details = [
                'name' => Auth::user()->name,
                'company' => $company->name,
                'v_phone' => $company->phone,
                'phone' => $request->phone,
                'datetime' => $datetime,
                'subtitle' => 'We verified an account for You',
                'email' => $request->email,
                'description' => $request->description,
                'job_status' => $request->job_status,
                'postcode' => $request->postcode
            ];

            \Mail::to($pushover)->send(new \App\Mail\QuoteMail($details));
            \Mail::to($pushover)->send(new \App\Mail\QuoteAcceptMail($details));
            \Mail::to($yours)->send(new \App\Mail\QuoteAcceptMail($details));
            \Mail::to($yours)->send(new \App\Mail\QuoteMail($details));
            \Mail::to($request->email)->send(new \App\Mail\QuoteMail($details));
            \Mail::to($company->email)->send(new \App\Mail\QuoteAcceptMail($details));
        }
        else {
            if ($request->password == '') {
$qoutes = [
    'user_business_id' => $request->user_business_id,
    'description' => $request->description,
    'job_status' => $request->job_status,
    'name' => $request->name,
    'email' => $request->email,
    'phone' => $request->phone,
    'postcode' => $request->postcode
];
Quote::create($qoutes);
//                 Quote::create([
//                     'user_business_id' => $request->user_business_id,
// //                    'user_id' => $user->id,
//                     'description' => $request->description,
//                     'job_status' => $request->job_status,
//                     'name' => $request->name,
//                     'email' => $request->email,
//                     'phone' => $request->phone,
//                     'postcode' => $request->postcode
//                 ]);
                $details = [
                    'name' => $request->name,
                    'company' => $company->name,
                    'v_phone' => $company->phone,
                    'phone' => $request->phone,
                    'datetime' => $datetime,
                    'subtitle' => 'We verified an account for You',
                    'email' => $request->email,
                    'description' => $request->description,
                    'job_status' => $request->job_status,
                    'postcode' => $request->postcode
                ];

                \Mail::to($pushover)->send(new \App\Mail\QuoteMail($details));
                \Mail::to($pushover)->send(new \App\Mail\QuoteAcceptMail($details));
                \Mail::to($yours)->send(new \App\Mail\QuoteAcceptMail($details));
                \Mail::to($yours)->send(new \App\Mail\QuoteMail($details));
                \Mail::to($request->email)->send(new \App\Mail\QuoteMail($details));
                \Mail::to($company->email)->send(new \App\Mail\QuoteAcceptMail($details));

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
                $qoutes = [
                    'user_business_id' => $request->user_business_id,
                    'user_id' => $user->id,
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'description' => $request->description,
                    'job_status' => $request->job_status,
                    'postcode' => $request->postcode
                ];
                Quote::create($qoutes);
                // Quote::create([
                //     'user_business_id' => $request->user_business_id,
                //     'user_id' => $user->id,
                //     'description' => $request->description,
                //     'job_status' => $request->job_status,
                //     'name' => $request->name,
                //     'email' => $request->email,
                //     'phone' => $request->phone,
                //     'postcode' => $request->postcode
                // ]);
                $details = [
                    'name' => $request->name,
                    'company' => $company->name,
                    'v_phone' => $company->phone,
                    'phone' => $request->phone,
                    'datetime' => $datetime,
                    'subtitle' => 'We verified an account for You',
                    'email' => $request->email,
                    'description' => $request->description,
                    'job_status' => $request->job_status,
                    'postcode' => $request->postcode
                ];



                \Mail::to($pushover)->send(new \App\Mail\QuoteMail($details));
                \Mail::to($pushover)->send(new \App\Mail\QuoteAcceptMail($details));
                \Mail::to($yours)->send(new \App\Mail\QuoteAcceptMail($details));
                \Mail::to($yours)->send(new \App\Mail\QuoteMail($details));
                \Mail::to($request->email)->send(new \App\Mail\QuoteMail($details));
                \Mail::to($company->email)->send(new \App\Mail\QuoteAcceptMail($details));
            }
        }

        return redirect()->back()->with('success', 'Quote Send Successfully!');
    }

    public function userAppointments()
    {
        $user_appointments = Quote::where('user_id', Auth::id())->get();
        return view('front.user_appointments', compact('user_appointments'));
    }

    public function userContacts()
    {
        $user_contacts = Quote::where('user_business_id', Auth::id())->orderby('created_at','desc')->get();
        return view('front.user_contacts', compact('user_contacts'));
    }
    public function delete_record_qoute(Request $request)
    {
        $id = $request->id;
        $state = Quote::where('id',$id)->delete();
        if ($state){
             echo true;
        }

    }

}
