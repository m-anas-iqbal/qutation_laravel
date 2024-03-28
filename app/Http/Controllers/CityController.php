<?php

namespace App\Http\Controllers;

use App\Country;
use App\City;
use App\County;
use App\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CityController extends Controller
{
    public function index()
    {
        $countries = Country::all();
        $states = State::all();
        return view('admin.cities.index', compact('countries', 'states'));
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
                'name' => 'required|unique:cities,name'
            ]
        );

        $slug =  env('APP_URL').'/traders/'.$request->name;
        City::create(['country' => $request->country, 'county' => $request->county, 'state' => $request->state, 'name' => $request->name, 'slug' => $slug]);

        return back()->with('success', 'City added successfully');
    }

    public function cityEdit($id)
    {
        $countries = Country::all();
        $states = State::all();
        $counties = County::all();
        $city = City::find($id);
        return view('admin.cities.edit', compact('countries','states', 'counties' ,'city'));
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
                'name' => 'required|unique:cities,name,' . $id
            ]
        );

        $slug =  env('APP_URL').'/traders/'.$request->name;
        City::where('id', $id)->update(['country' => $request->country, 'state' => $request->state, 'county' => $request->county, 'name' => $request->name, 'slug' => $slug]);

        return back()->with('success', 'City updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        City::where('id', $id)->delete();

        return back()->with('success', 'City deleted successfully');
    }

    public function citiesList(Request $request)
    {
        $columns = array('id', 'city');

        $totalCitys = DB::table('cities')->count();
        $totalFiltered = $totalCitys;
        if ($request->input('length') == -1) {
            $limit =  $totalCitys;
        } else {
            $limit = $request->input('length');
        }
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $cities = DB::table('cities')
                ->select('id', 'country', 'state', 'county', 'name')
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
        } else {
            $search = $request->input('search.value');
            $cities = DB::table('cities')
                ->select('id', 'country',  'state',  'county', 'name')
                ->where('name', 'LIKE', "%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();

            $totalFiltered = $cities->count();
        }

        $data = array();
        if (!empty($cities)) {
            foreach ($cities as $city) {
                $nestedData['id']       = $city->id;
                $nestedData['country']     = $city->country;
                $nestedData['state']     = $city->state;
                $nestedData['county']     = $city->county;
                $nestedData['city']     = $city->name;
                $nestedData['action']   = '<a href="'.url("city-edit", $city->id).'" class="mr-2"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 14" height="18" width="18"><path d="M5,12.24.5,13.5,1.76,9,10,.8a1,1,0,0,1,1.43,0L13.2,2.58A1,1,0,0,1,13.2,4Z" fill="none" stroke="#1b55e2" stroke-linecap="round" stroke-linejoin="round"></path></svg></a>
                <a href="" class="delete-city" data-toggle="modal" data-action="' . route('cities.destroy', $city->id) . '" data-target="#delete-city"><svg class="mb-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 14" height="18" width="18"><g><polyline points="11.5 5.5 10.5 13.5 3.5 13.5 2.5 5.5" fill="none" stroke="#1b55e2" stroke-linecap="round" stroke-linejoin="round"></polyline><line x1="1" y1="3.5" x2="13" y2="3.5" fill="none" stroke="#1b55e2" stroke-linecap="round" stroke-linejoin="round"></line><path d="M4.46,3.21l0-1.73a1,1,0,0,1,1-1h3a1,1,0,0,1,1,1v2" fill="none" stroke="#1b55e2" stroke-linecap="round" stroke-linejoin="round"></path></g></svg></a>';
                $data[] = $nestedData;
            }
        }

        $json_data = array(
            "draw" => intval($request->input('draw')),
            "recordsTotal" => intval($totalCitys),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data,
        );

        echo json_encode($json_data);
    }

    public function getCounty(Request $request)
    {
        $counties = County::where('state', $request->state)->get();
        return view('admin.cities.counties', compact('counties'));
    }
}
