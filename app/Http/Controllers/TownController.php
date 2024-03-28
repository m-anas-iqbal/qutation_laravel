<?php

namespace App\Http\Controllers;

use App\City;
use App\Country;
use App\Town;
use App\County;
use App\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TownController extends Controller
{
    public function index()
    {
        $countries = Country::all();
        $states = State::all();
        return view('admin.towns.index', compact('countries', 'states'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(
            $request, [
                'name' => 'required|unique:towns,name'
            ]
        );

        $slug =  env('APP_URL').'/traders/'.$request->name;
        Town::create([
            'country' => $request->country,
            'state' => $request->state,
            'county' => $request->county,
            'city' => $request->city,
            'name' => $request->name,
            'postcode' => $request->postcode,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'wik_url' => $request->wik_url,
            'slug' => $slug
        ]);

        return back()->with('success', 'Town added successfully');
    }

    public function townEdit($id)
    {
        $countries = Country::all();
        $states = State::all();
        $counties = County::all();
        $cities = City::all();
        $town = Town::find($id);
        return view('admin.towns.edit', compact('countries','states', 'counties', 'cities', 'town'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate(
            $request, [
                'name' => 'required|unique:towns,name,' . $id
            ]
        );

        $slug =  env('APP_URL').'/traders/'.$request->name;
        Town::where('id', $id)->update([
            'country' => $request->country,
            'state' => $request->state,
            'county' => $request->county,
            'city' => $request->city,
            'name' => $request->name,
            'postcode' => $request->postcode,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'wik_url' => $request->wik_url,
            'slug' => $slug
        ]);

        return back()->with('success', 'Town updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Town::where('id', $id)->delete();

        return back()->with('success', 'Town deleted successfully');
    }

    public function townsList(Request $request)
    {
        $columns = array('id', 'town');

        $totalTowns = DB::table('towns')->count();
        $totalFiltered = $totalTowns;
        if ($request->input('length') == -1) {
            $limit =  $totalTowns;
        } else {
            $limit = $request->input('length');
        }
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $towns = DB::table('towns')
                ->select('*')
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
        } else {
            $search = $request->input('search.value');
            $towns = DB::table('towns')
                ->select('*')
                ->where('name', 'LIKE', "%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();

            $totalFiltered = $towns->count();
        }

        $data = array();
        if (!empty($towns)) {
            foreach ($towns as $town) {
                $nestedData['id']       = $town->id;
                $nestedData['country']     = $town->country;
                $nestedData['state']     = $town->state;
                $nestedData['county']     = $town->county;
                $nestedData['city']     = $town->city;
                $nestedData['town']     = $town->name;
                $nestedData['postcode']     = $town->postcode;
                $nestedData['latitude']     = $town->latitude;
                $nestedData['longitude']     = $town->longitude;
                $nestedData['wik_url']     = $town->wik_url;
                $nestedData['action']   = '<a href="'.url("town-edit", $town->id).'" class="mr-2"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 14" height="18" width="18"><path d="M5,12.24.5,13.5,1.76,9,10,.8a1,1,0,0,1,1.43,0L13.2,2.58A1,1,0,0,1,13.2,4Z" fill="none" stroke="#1b55e2" stroke-linecap="round" stroke-linejoin="round"></path></svg></a>
                <a href="" class="delete-town" data-toggle="modal" data-action="' . route('towns.destroy', $town->id) . '" data-target="#delete-town"><svg class="mb-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 14" height="18" width="18"><g><polyline points="11.5 5.5 10.5 13.5 3.5 13.5 2.5 5.5" fill="none" stroke="#1b55e2" stroke-linecap="round" stroke-linejoin="round"></polyline><line x1="1" y1="3.5" x2="13" y2="3.5" fill="none" stroke="#1b55e2" stroke-linecap="round" stroke-linejoin="round"></line><path d="M4.46,3.21l0-1.73a1,1,0,0,1,1-1h3a1,1,0,0,1,1,1v2" fill="none" stroke="#1b55e2" stroke-linecap="round" stroke-linejoin="round"></path></g></svg></a>';
                $data[] = $nestedData;
            }
        }

        $json_data = array(
            "draw" => intval($request->input('draw')),
            "recordsTotal" => intval($totalTowns),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data,
        );

        echo json_encode($json_data);
    }

    public function getCounty(Request $request)
    {
        $counties = County::where('state', $request->state)->get();
        return view('admin.towns.counties', compact('counties'));
    }

    public function getCounties(Request $request)
    {
        $cities = City::where('county', $request->county)->get();
        return view('admin.towns.cities', compact('cities'));
    }
}
