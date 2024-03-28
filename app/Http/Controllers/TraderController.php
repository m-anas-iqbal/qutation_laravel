<?php

namespace App\Http\Controllers;

use App\City;
use App\Country;
use App\County;
use App\Image;
use App\Review;
use App\State;
use App\Town;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TraderController extends Controller
{
    public function create()
    {
        $countries = Country::all();
        $states = State::all();
        $counties = County::all();
        $cities = City::all();
        $towns = Town::all();
        return view('front.trader_signup', compact('countries', 'states', 'counties', 'cities', 'towns'));
    }

    public function save(Request $request)
    {
        $user  = User::where('email', $request->email)->first();
        if (isset($user)){
            return redirect()->back()->with('error', 'Email Already Exist!');
        }
        else {
            $service_area_arr = $request->service_area;
            $service_area_arr_values = implode(',', $service_area_arr);


            $short_service_area = $request->short_service_area;
            $short_arr_values = implode(',', $short_service_area);


            $business_subcat_name = $request->business_subcat_name;
            if (isset($business_subcat_name)) {
                $business_subcat_arr_values = implode(',', $business_subcat_name);
            }
            else{
                $business_subcat_arr_values = "";
            }

            if (isset($request->postcode)){
                $half_postcode = explode(" ", $request->postcode);
                $half_postcode[0]; // piece1
            }


            User::create([
                'role_id' => $request->role_id,
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'service_area' => $service_area_arr_values,
                'service_area_values' => $short_arr_values,
                'business_name' => $request->business_name,
                'business_subcat_name' => $business_subcat_arr_values,
                'phone' => $request->phone,
                'half_postcode' => $half_postcode[0],
                'postcode' => $request->postcode,
                'business_type' => $request->business_type,
                'opening_time' => $request->opening,
                'closing_time' => $request->closing,
                'business_description' => $request->business_description,
                'no_of_employee' => $request->no_of_employee,
                'website_url' => $request->website_url,
                'status' => 0,
            ]);
            
            return redirect()->back()->with('success', 'Account is Under Verification.');
        }
    }

    public function traderDetails($name)
    {

//        $name = str_replace( '-', ' ', $name );
        $trader = User::where('name', $name)->first();
        $images = Image::where('user_id', $trader->id)->get();
        $reviews = Review::where('user_id', $trader->id)->get();
        return view('front.trader_details', compact('trader', 'images', 'reviews'));
    }

}
