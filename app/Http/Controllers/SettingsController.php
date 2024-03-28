<?php

namespace App\Http\Controllers;

use App\Setting;
use App\User;
use App\UserSchema;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingsController extends Controller
{
    public function index()
    {

        $setting = Setting::first();
        return view('admin.settings.edit', compact('setting'));
//        return view('admin.settings.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     * @return \Illuminate\Http\Response
     */

    public function settingsEdit($id)
    {
        $setting = Setting::find($id);
        return view('admin.settings.edit', compact('setting'));
    }

    public function update(Request $request, $id)
    {

        $settings = Setting::first();
        $this->validate(
            $request, [
                'site_name' => 'required|unique:settings,site_name,' . $id
            ]
        );

        if ($request->logo) {
            $logo_name = time() . '.' . $request->logo->getClientOriginalExtension();
            $logo_path = $request->logo->move(public_path('upload/settings'), $logo_name);
        }
        else{
            $logo_name = $settings->logo;
        }

        if ($request->favicon) {
            $favicon_name = time() . '.' . $request->favicon->getClientOriginalExtension();
            $favicon_path = $request->favicon->move(public_path('upload/settings'), $favicon_name);
        }
        else{
            $favicon_name = $settings->favicon;
        }


        /////

        $traders = User::where('role_id', 2)->get();

        if (count($traders) > 0) {
            foreach ($traders as $trader) {
                $tag_user = $request->user_schema;
                $tag_user = str_replace('{trader_name}', $trader->name, $tag_user);
                $tag_user = str_replace('{trader_phone}', $trader->phone, $tag_user);
                // $tag_user = str_replace('{area_name}', $trader->service_area_values, $tag_user);
                $tag_user = str_replace('{opening}', $trader->opening_time, $tag_user);
                $tag_user = str_replace('{closing}', $trader->closing_time, $tag_user);
                $tag_user = str_replace('{web_url}', $trader->website_url, $tag_user);
               $exist = UserSchema::where('user_id', $trader->id)->first();
               if ($exist){
                   $exist->update([
                       'text' => $tag_user
                   ]);
               }
               else{
                   UserSchema::create([
                       'user_id' => $trader->id,
                       'text' => $tag_user
                   ]);
               }
            }
        }

///meta variables


        $area_url = implode(",", $request->area_url);

        $settings->update([
            'site_name' => $request->site_name,
            'site_description' => $request->site_description,
            'email' => $request->email,
            'phone' => $request->phone,
            'logo' => $logo_name,
            'favicon' => $favicon_name,
            'site_meta_tags' => $request->site_meta_tags,
            'site_meta_description' => $request->site_meta_description,
            'user_schema' => $request->user_schema,
            'single_schema' => $request->single_schema,
            'home_h1' => $request->home_h1,
            'home_h2' => $request->home_h2,
            'home_h3' => $request->home_h3,

            'country_meta' => $request->country_meta,
            'state_meta' => $request->state_meta,
            'county_meta' => $request->county_meta,
            'city_meta' => $request->city_meta,
            'town_meta' => $request->town_meta,
            'h1_variable' => $request->h1_variable,
            'mail_subject' => $request->mail_subject,

            'country_meta_title' => $request->country_meta_title,
            'state_meta_title' => $request->state_meta_title,
            'county_meta_title' => $request->county_meta_title,
            'city_meta_title' => $request->city_meta_title,
            'town_meta_title' => $request->town_meta_title,
            'google_ads_tag' => $request->google_ads_tag,

            'pushover' => $request->pushover,
            'copyright' => $request->copyright,
            'permissions_area' => $area_url
        ]);

        return back()->with('success', 'Data updated successfully');
    }

    public function settingsList(Request $request)
    {
        $columns = array('id', 'setting');

        $totalCountrys = DB::table('settings')->count();
        $totalFiltered = $totalCountrys;
        if ($request->input('length') == -1) {
            $limit =  $totalCountrys;
        } else {
            $limit = $request->input('length');
        }
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $settings = DB::table('settings')
                ->select('id', 'site_name', 'site_description')
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
        } else {
            $search = $request->input('search.value');
            $settings = DB::table('settings')
                ->select('id', 'site_name')
                ->where('name', 'LIKE', "%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();

            $totalFiltered = $settings->count();
        }

        $data = array();
        if (!empty($settings)) {
            foreach ($settings as $setting) {
                $nestedData['id']       = $setting->id;
                $nestedData['site_name']     = $setting->site_name;
                $nestedData['site_description']     = $setting->site_description;
                $nestedData['action']   = '<a href="'.url("settings-edit", $setting->id).'" class="mr-2"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 14" height="18" width="18"><path d="M5,12.24.5,13.5,1.76,9,10,.8a1,1,0,0,1,1.43,0L13.2,2.58A1,1,0,0,1,13.2,4Z" fill="none" stroke="#1b55e2" stroke-linecap="round" stroke-linejoin="round"></path></svg></a>';
                $data[] = $nestedData;
            }
        }

        $json_data = array(
            "draw" => intval($request->input('draw')),
            "recordsTotal" => intval($totalCountrys),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data,
        );

        echo json_encode($json_data);
    }
}
