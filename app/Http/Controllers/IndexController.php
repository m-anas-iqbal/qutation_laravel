<?php

namespace App\Http\Controllers;

use App\AboutUs;
use App\BusinessCategory;
use App\BusinessSubCategory;
use App\CategoryDescription;
use App\City;
use App\Country;
use App\County;
use App\Faq;
use App\Group;
use App\GroupTagDescription;
use App\Setting;
use App\State;
use App\Town;
use App\User;
use Illuminate\Http\Request;
use App\Traits\AttachmentTrait;
use App\Applicant;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    use AttachmentTrait;

    public function index()
    {

        $data['setting'] = Setting::first();
        $data['categories'] = BusinessCategory::all();
        $data['countries'] = Country::select('name')->groupBy('name')->get();
        $data['about_us'] = AboutUs::first();
        $data['trader'] = User::inRandomOrder()->where('role_id', 2)->where('status',1)->first();



        $setting = Setting::first();
        if (in_array('state', explode(",", $setting->permissions_area)) && in_array('county', explode(",", $setting->permissions_area)) && in_array('city', explode(",", $setting->permissions_area)) && in_array('town', explode(",", $setting->permissions_area))){
            $area_url[] = State::inRandomOrder()->first();
            $area_url[] = County::inRandomOrder()->first();
            $area_url[] = City::inRandomOrder()->first();
            $area_url[] = Town::inRandomOrder()->first();
        }
        else if (in_array('state', explode(",", $setting->permissions_area)) && in_array('county', explode(",", $setting->permissions_area)) && in_array('city', explode(",", $setting->permissions_area))){
            $area_url[] = State::inRandomOrder()->first();
            $area_url[] = County::inRandomOrder()->first();
            $area_url[] = City::inRandomOrder()->first();
        }
        else if (in_array('state', explode(",", $setting->permissions_area)) && in_array('county', explode(",", $setting->permissions_area))){
            $area_url[] = State::inRandomOrder()->first();
            $area_url[] = County::inRandomOrder()->first();
        }


        else if (in_array('county', explode(",", $setting->permissions_area)) && in_array('city', explode(",", $setting->permissions_area)) && in_array('town', explode(",", $setting->permissions_area))){
            $area_url[] = County::inRandomOrder()->first();
            $area_url[] = City::inRandomOrder()->first();
            $area_url[] = Town::inRandomOrder()->first();
        }


        else if (in_array('county', explode(",", $setting->permissions_area)) && in_array('city', explode(",", $setting->permissions_area))){
            $area_url[] = County::inRandomOrder()->first();
            $area_url[] = City::inRandomOrder()->first();
        }


        else if (in_array('county', explode(",", $setting->permissions_area)) && in_array('town', explode(",", $setting->permissions_area))){
            $area_url[] = County::inRandomOrder()->first();
            $area_url[] = Town::inRandomOrder()->first();
        }

        else if (in_array('city', explode(",", $setting->permissions_area)) && in_array('town', explode(",", $setting->permissions_area))){
            $area_url[] = City::inRandomOrder()->first();
            $area_url[] = Town::inRandomOrder()->first();
        }



        else if (in_array('state', explode(",", $setting->permissions_area))){
            $area_url[] = State::inRandomOrder()->first();
        }
        else if (in_array('county', explode(",", $setting->permissions_area))){
            $area_url[] = County::inRandomOrder()->first();
        }
        else if (in_array('city', explode(",", $setting->permissions_area))){
            $area_url[] = City::inRandomOrder()->first();
        }
        else if (in_array('town', explode(",", $setting->permissions_area))){
            $area_url[] = Town::inRandomOrder()->first();
        }
        $data['area_url'] = $area_url;
        return view('front.career', $data);
    }

    public function indexCategory()
    {
        $cats = BusinessCategory::all();
        return view('front.index_cats', compact('cats'));
    }
    public function indexSubcat(Request $request)
    {
        $subcats = BusinessSubCategory::where('category_id', $request->category_id)->get();
        if (count($subcats) > 0) {
            return view('front.index_subcats', compact('subcats'));
        }
        else{
            return view('front.index_area_postcode');
        }
    }

    public function postcodeAreaInput()
    {
        $postcodes = Town::get(['half_postcode']);
        foreach ($postcodes as $key=>$postcode){
            $arr_postcodes[] = $postcode->half_postcode;
        }
        $arr_postcodes = array_unique($arr_postcodes);

        $postcodes = Town::get(['half_postcode']);
        foreach ($postcodes as $key=>$postcode){
            $arr_postcodes[] = $postcode->half_postcode;
        }
        $arr_postcodes = array_unique($arr_postcodes);

        $countries = Country::all();
        $states = State::all();
        $counties = County::all();
        $cities = City::all();
        $towns = Town::all();


        return view('front.index_area_postcode', compact('arr_postcodes' ,'countries', 'states', 'counties', 'cities', 'towns'));
    }

    public function searchByCategory($bname, $area)
    {
        $trade = User::where('business_name', $bname)->first();
        $name = $trade->service_area_values;
        $users = User::where('business_name', $bname)->whereRaw('Find_IN_SET(?, service_area)', [$area])->orWhere('postcode', $area)->get();
        return view('front.search_bc', compact('users', 'bname', 'name', 'area'));
    }

    public function search(Request $request)
    {
//        return $request->search_category_id;
        $b_cat = BusinessCategory::where('id', $request->search_category_id)->first();
        $b_subcat = BusinessCategory::where('id', $request->search_subcategory_id)->first();
       $users = $service_area_description = User::where('business_name', $b_cat->name)->where('half_postcode', $request->postcode)->orWhereRaw('Find_IN_SET(?, service_area)', [$request->area])->orWhere('business_name', $b_cat->name)->whereRaw('Find_IN_SET(?, business_subcat_name)', [isset($b_subcat->name)?$b_subcat->name:''])->where('half_postcode', $request->postcode)->orWhereRaw('Find_IN_SET(?, service_area)', [$request->area])->orderBy('rank_order_no', 'asc')->get();
       $name = $b_cat->name;
       $search_area_name = $request->area_postcode;
        $area_name = $request->area_postcode;
        return view('front.search', compact('users', 'name', 'area_name', 'search_area_name'));
    }


    public function countryStates($name)
    {
        $group_tags = [];
        $states = State::where('country', $name)->get();
       $users = User::whereRaw('Find_IN_SET(?, service_area)', [$name])->orderBy('rank_order_no', 'asc')->where('status', 1)->get();
        $service_area_description = CategoryDescription::where('service_area_values', $name)->orderBy('id', 'asc')->first();
        if (!isset($service_area_description)) {
            $service_area_description = CategoryDescription::whereRaw('Find_IN_SET(?, service_area)', [$name])->orderBy('id', 'asc')->first();
        }
//        $group = Group::where('status', 1)->first();
        $group = Group::where('service_category_id', isset($service_area_description) ? $service_area_description->id : '')->where('status', 1)->first();
        if (isset($group)) {
            $group_tags[] = GroupTagDescription::where('group_id', $group->id)->inRandomOrder()->first();
        }
        $faqs = Faq::where('service_category_id', isset($service_area_description) ? $service_area_description->id : '')->get();
        return view('front.states', compact('states', 'name', 'users', 'service_area_description', 'group', 'group_tags', 'faqs'));
    }

    public function stateCounties($country, $name)
    {
        $group_tags = [];
        $counties = County::where('state', $name)->get();
       $users = User::whereRaw('Find_IN_SET(?, service_area)', [$name])->orderBy('rank_order_no', 'asc')->where('status', 1)->get();
        $service_area_description = CategoryDescription::where('service_area_values', $name)->orderBy('id', 'asc')->first();
        if (!isset($service_area_description)) {
              $service_area_description = CategoryDescription::whereRaw('Find_IN_SET(?, service_area)', [$name])->orderBy('id', 'asc')->first();
        }
//        $group = Group::where('status', 1)->first();
        $group = Group::where('service_category_id', isset($service_area_description) ? $service_area_description->id: '')->where('status', 1)->first();
        if (isset($group)) {
            $group_tags[] = GroupTagDescription::where('group_id', $group->id)->inRandomOrder()->first();
        }
        $faqs = Faq::where('service_category_id', isset($service_area_description) ? $service_area_description->id : '')->get();
        return view('front.counties', compact('counties','country' , 'name', 'users', 'service_area_description', 'group', 'group_tags', 'faqs'));
    }

    public function countyCities($country, $state, $name)
    {
        $group_tags = [];
        $cities = City::where('county', $name)->get();
        // $users = User::whereRaw('Find_IN_SET(?, service_area)', [$name])->orderBy('rank_order_no', 'asc')->where('status', 1)->get();
        $users = User::whereRaw('Find_IN_SET(?, service_area)', [$name])->orderBy('rank_order_no', 'asc')->where('status', 1)->get();

          $service_area_description = CategoryDescription::where('service_area_values', $name)->orderBy('id', 'asc')->first();
        if (!isset($service_area_description)) {
            $service_area_description = CategoryDescription::whereRaw('Find_IN_SET(?, service_area)', [$name])->orderBy('id', 'asc')->first();
        }
        $group = Group::where('service_category_id', isset($service_area_description) ? $service_area_description->id : '')->where('status', 1)->first();
        if (isset($group)) {
            $group_tags[] = GroupTagDescription::where('group_id', $group->id)->inRandomOrder()->first();
        }
        $faqs = Faq::where('service_category_id', isset($service_area_description) ? $service_area_description->id : '')->get();
        return view('front.cities', compact('country', 'state', 'cities', 'name', 'users', 'service_area_description', 'group', 'group_tags', 'faqs'));
    }

    public function cityTowns($country, $state, $county, $name)
    {
        $group_tags = [];
        $town = Town::where('city', $name)->whereNotNull('postcode')->first();
        $towns = Town::where('city', $name)->get();
       $users = User::whereRaw('Find_IN_SET(?, service_area)', [$name])->orderBy('rank_order_no', 'asc')->where('status', 1)->get();
        $service_area_description = CategoryDescription::where('service_area_values', $name)->orderBy('id', 'asc')->first();
        if (!isset($service_area_description)) {
            $service_area_description = CategoryDescription::whereRaw('Find_IN_SET(?, service_area)', [$name])->orderBy('id', 'asc')->first();
        }
//        $group = Group::where('status', 1)->first();
        $group = Group::where('service_category_id', isset($service_area_description) ? $service_area_description->id : '')->where('status', 1)->first();
        if (isset($group)) {
            $group_tags[] = GroupTagDescription::where('group_id', $group->id)->inRandomOrder()->first();
        }
        $faqs = Faq::where('service_category_id', isset($service_area_description) ? $service_area_description->id : '')->get();
        return view('front.towns', compact('country', 'state', 'county', 'towns', 'name', 'town', 'users', 'service_area_description', 'group', 'group_tags', 'faqs'));
    }

    public function countryTraders($name)
    {
        $group_tags = [];
       $users = User::whereRaw('Find_IN_SET(?, service_area)', [$name])->orderBy('rank_order_no', 'asc')->where('status', 1)->get();
        $service_area_description = CategoryDescription::where('service_area_values', $name)->orderBy('id', 'asc')->first();
        if (!isset($service_area_description)) {
            $service_area_description = CategoryDescription::whereRaw('Find_IN_SET(?, service_area)', [$name])->orderBy('id', 'asc')->first();
        }
//        $group = Group::where('status', 1)->first();
        $group = Group::where('service_category_id', isset($service_area_description) ? $service_area_description->id : '')->where('status', 1)->first();
        if (isset($group)) {
            $group_tags[] = GroupTagDescription::where('group_id', $group->id)->inRandomOrder()->first();
        }
        $faqs = Faq::where('service_category_id', isset($service_area_description) ? $service_area_description->id : '')->get();
        return view('front.traders', compact('name', 'users', 'service_area_description', 'group', 'group_tags', 'faqs'));
    }
    public function stateTraders($country, $name)
    {
        $group_tags = [];
       $users = User::whereRaw('Find_IN_SET(?, service_area)', [$name])->orderBy('rank_order_no', 'asc')->where('status', 1)->get();
        $service_area_description = CategoryDescription::where('service_area_values', $name)->orderBy('id', 'asc')->first();
        if (!isset($service_area_description)) {
            $service_area_description = CategoryDescription::whereRaw('Find_IN_SET(?, service_area)', [$name])->orderBy('id', 'asc')->first();
        }
//        $group = Group::where('status', 1)->first();
        $group = Group::where('service_category_id', isset($service_area_description) ? $service_area_description->id : '')->where('status', 1)->first();
        if (isset($group)) {
            $group_tags[] = GroupTagDescription::where('group_id', $group->id)->inRandomOrder()->first();
        }
        $faqs = Faq::where('service_category_id', isset($service_area_description) ? $service_area_description->id : '')->get();
        return view('front.traders', compact('name', 'users', 'service_area_description', 'group', 'group_tags', 'faqs', 'country'));
    }

    public function cityTraders($country, $state, $name)
    {
        $group_tags = [];
       $users = User::whereRaw('Find_IN_SET(?, service_area)', [$name])->orderBy('rank_order_no', 'asc')->where('status', 1)->get();
        $service_area_description = CategoryDescription::where('service_area_values', $name)->orderBy('id', 'asc')->first();
        if (!isset($service_area_description)) {
            $service_area_description = CategoryDescription::whereRaw('Find_IN_SET(?, service_area)', [$name])->orderBy('id', 'asc')->first();
        }
//        $group = Group::where('status', 1)->first();
        $group = Group::where('service_category_id', isset($service_area_description) ? $service_area_description->id : '')->where('status', 1)->first();
        if (isset($group)) {
            $group_tags[] = GroupTagDescription::where('group_id', $group->id)->inRandomOrder()->first();
        }
        $faqs = Faq::where('service_category_id', isset($service_area_description) ? $service_area_description->id : '')->get();
        return view('front.traders', compact('name', 'users', 'service_area_description', 'group', 'group_tags', 'faqs', 'country', 'state'));
    }

    public function traders($country = null, $state = null, $county = null, $city = null, $name)
    {
        $group_tags = [];
       $users = User::whereRaw('Find_IN_SET(?, service_area)', [$name])->orderBy('rank_order_no', 'asc')->where('status', 1)->get();
        $service_area_description = CategoryDescription::where('service_area_values', $name)->orderBy('id', 'asc')->first();
        if (!isset($service_area_description)) {
            $service_area_description = CategoryDescription::whereRaw('Find_IN_SET(?, service_area)', [$name])->orderBy('id', 'asc')->first();
        }
//        $group = Group::where('status', 1)->first();
        $group = Group::where('service_category_id', isset($service_area_description) ? $service_area_description->id : '')->where('status', 1)->first();
        if (isset($group)) {
            $group_tags[] = GroupTagDescription::where('group_id', $group->id)->inRandomOrder()->first();
        }
        $faqs = Faq::where('service_category_id', isset($service_area_description) ? $service_area_description->id : '')->get();
        return view('front.traders', compact('name', 'users', 'service_area_description', 'group', 'group_tags', 'faqs', 'country', 'state', 'county', 'city'));
    }

    public function postcodeTradersM($country, $state, $postcode)
    {
        $county = null;
        $group_tags = [];
        $towns = Town::where('half_postcode', $postcode)->get();
        foreach ($towns as $town){
            $arr_towns[] = $town->name;

            $users[] = User::whereRaw('Find_IN_SET(?, service_area)', [$town->name])->orderBy('rank_order_no', 'asc')->where('status', 1)->get();
        }
        $array = Arr::collapse($users);
        $users  = array_unique($array);
//return $array1;
        $service_area_description = CategoryDescription::whereRaw('Find_IN_SET(?, service_area)', [$town->name])->orderBy('id', 'asc')->first();
//        $group = Group::where('status', 1)->first();
        $group = Group::where('service_category_id', isset($service_area_description) ? $service_area_description->id : '')->where('status', 1)->first();
        if (isset($group)) {
            $group_tags[] = GroupTagDescription::where('group_id', $group->id)->inRandomOrder()->first();
        }
        $name = $postcode;
        $postcode_status = 0;
        $faqs = Faq::where('service_category_id', isset($service_area_description) ? $service_area_description->id : '')->get();
        return view('front.traders', compact('name', 'users', 'service_area_description', 'group', 'group_tags', 'faqs', 'country', 'state', 'county', 'postcode_status', 'postcode'));
    }

    public function postcodeTraders($country, $state, $county, $postcode)
    {
        $group_tags = [];
        $towns = Town::where('half_postcode', $postcode)->get();
        if ($towns->count()>0) {
            foreach ($towns as $town){
                $arr_towns[] = $town->name;

                $users[] = User::whereRaw('Find_IN_SET(?, service_area)', [$town->name])->orderBy('rank_order_no', 'asc')->where('status', 1)->get();
            }
            $array = Arr::collapse($users);
            $users  = array_unique($array);
    //return $array1;
            $service_area_description = CategoryDescription::whereRaw('Find_IN_SET(?, service_area)', [$town->name])->orderBy('id', 'asc')->first();
    //        $group = Group::where('status', 1)->first();
            $group = Group::where('service_category_id', isset($service_area_description) ? $service_area_description->id : '')->where('status', 1)->first();
            if (isset($group)) {
                $group_tags[] = GroupTagDescription::where('group_id', $group->id)->inRandomOrder()->first();
            }
            $name = $postcode;
            $postcode_status = 0;
            $faqs = Faq::where('service_category_id', isset($service_area_description) ? $service_area_description->id : '')->get();
            return view('front.traders', compact('name', 'users', 'service_area_description', 'group', 'group_tags', 'faqs', 'country', 'state', 'county', 'postcode_status', 'postcode'));

        }else{
            abort(404);
        }
        }

    public function ajaxServiceArea(Request $request)
    {

        $areas = $request->service_area;
        $values = [];

//        country
        if (!empty($areas)) {
            foreach ($areas as $area) {
                $countries = Country::where('name', $area)->get();
                $states = State::where('country', $area)->get();
                $county = County::where('country', $area)->get();
                $cities = City::where('country', $area)->get();
                $towns = Town::where('country', $area)->get();
                foreach ($countries as $value) {
                    $values[] = $value->name;
                }
                foreach ($states as $value) {
                    $values[] = $value->name;
                }
                foreach ($county as $value) {
                    $values[] = $value->name;
                }
                foreach ($cities as $value) {
                    $values[] = $value->name;
                }
                foreach ($towns as $value) {
                    $values[] = $value->name;
                }


//        state
                $state_values = State::where('name', $area)->get();
                $county_states = County::where('state', $area)->get();
                $cities_states = City::where('state', $area)->get();
                $towns_states = Town::where('state', $area)->get();
                foreach ($state_values as $value) {
                    $values[] = $value->name;
                }
                foreach ($county_states as $value) {
                    $values[] = $value->name;
                }
                foreach ($cities_states as $value) {
                    $values[] = $value->name;
                }
                foreach ($towns_states as $value) {
                    $values[] = $value->name;
                }

                //county
                $county_values = County::where('name', $area)->get();
                $cities_counties = City::where('county', $area)->get();
                $towns_counties = Town::where('county', $area)->get();
                foreach ($county_values as $value) {
                    $values[] = $value->name;
                }
                foreach ($cities_counties as $value) {
                    $values[] = $value->name;
                }
                foreach ($towns_counties as $value) {
                    $values[] = $value->name;
                }

                //city
                $cities_values = City::where('name', $area)->get();
                $towns_cities = Town::where('city', $area)->get();
                foreach ($cities_values as $value) {
                    $values[] = $value->name;
                }
                foreach ($towns_cities as $value) {
                    $values[] = $value->name;
                }

                //town
                $towns = Town::where('name', $area)->get();
                foreach ($towns as $value) {
                    $values[] = $value->name;
                }

            }
            $values = array_unique($values);
            return implode(',',$values);
        }
        else{
          return  false;
        }
//        print_r($values);
//        die();

    }

    public function categorySearch($bname, $area, $param1=null, $param2=null, $param3=null, $param4=null)
    {
        $name = $area;
       $users = User::where('business_name', $bname)->whereRaw('Find_IN_SET(?, service_area)', [$area])->orWhere('postcode', $area)->get();
       return view('front.category_search', compact('users', 'name', 'bname', 'param1', 'param2', 'param3', 'param4'));
    }

    public function categorySearch1($bname, $country, $name)
    {
       $users = User::where('business_name', $bname)->whereRaw('Find_IN_SET(?, service_area)', [$name])->get();
       return view('front.category_search', compact('users', 'name', 'bname', 'country'));
    }



    public function categorySearch2($bname, $country, $state, $name)
    {
       $users = User::where('business_name', $bname)->whereRaw('Find_IN_SET(?, service_area)', [$name])->get();
       return view('front.category_search', compact('users', 'name', 'bname', 'country', 'state'));
    }



    public function categorySearch3($bname, $country, $state, $county, $name)
    {
       $users = User::where('business_name', $bname)->whereRaw('Find_IN_SET(?, service_area)', [$name])->get();
       return view('front.category_search', compact('users', 'name', 'bname', 'country', 'state', 'county'));
    }


    public function categorySearch4($bname, $country, $state, $county, $city, $name)
    {
       $users = User::where('business_name', $bname)->whereRaw('Find_IN_SET(?, service_area)', [$name])->get();
       return view('front.category_search', compact('users', 'name', 'bname', 'country', 'state', 'county', 'city'));
    }





    public function subCategorySearch($bname, $area, $param1=null, $param2=null, $param3=null, $param4=null)
    {
        $name = $area;
       $users = User::whereRaw('Find_IN_SET(?, business_subcat_name)', [$bname])->whereRaw('Find_IN_SET(?, service_area)', [$area])->orWhere('postcode', $area)->get();
        return view('front.category_search', compact('users', 'name', 'bname', 'param1', 'param2', 'param3', 'param4'));
    }

    public function subCategorySearch1($bname, $country, $name)
    {
       $users = User::whereRaw('Find_IN_SET(?, business_subcat_name)', [$bname])->whereRaw('Find_IN_SET(?, service_area)', [$name])->get();
        return view('front.category_search', compact('users', 'name', 'bname', 'country'));
    }

    public function subcategorySearch2($bname, $country, $state, $name)
    {
        $users = User::whereRaw('Find_IN_SET(?, business_subcat_name)', [$bname])->whereRaw('Find_IN_SET(?, service_area)', [$name])->get();
        return view('front.category_search', compact('users', 'name', 'bname', 'country', 'state'));
    }



    public function subcategorySearch3($bname, $country, $state, $county, $name)
    {
        $users = User::whereRaw('Find_IN_SET(?, business_subcat_name)', [$bname])->whereRaw('Find_IN_SET(?, service_area)', [$name])->get();
        return view('front.category_search', compact('users', 'name', 'bname', 'country', 'state', 'county'));
    }


    public function subcategorySearch4($bname, $country, $state, $county, $city, $name)
    {
        $users = User::whereRaw('Find_IN_SET(?, business_subcat_name)', [$bname])->whereRaw('Find_IN_SET(?, service_area)', [$name])->get();
        return view('front.category_search', compact('users', 'name', 'bname', 'country', 'state', 'county', 'city'));
    }

    public function subCategorySignup(Request $request)
    {
        $cat = BusinessCategory::where('name', $request->business_name)->first();
        $subs = BusinessSubCategory::where('category_id', $cat->id)->get();
        return view('front.get_sub_cats', compact('subs'));
    }

    //////////end

}
