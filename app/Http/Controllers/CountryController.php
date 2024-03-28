<?php

namespace App\Http\Controllers;

use App\City;
use App\County;
use App\Imports\Countries;
use App\Imports\States;
use App\State;
use App\Town;
use Illuminate\Http\Request;
use App\Country;
use Illuminate\Support\Facades\DB;

class CountryController extends Controller
{
    public function index()
    {
        return view('admin.countries.index');
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
                'name' => 'required|unique:countries,name'
            ]
        );

        $slug =  env('APP_URL').'/traders/'.$request->name;
        Country::create(['name' => $request->name, 'slug' => $slug]);

        return back()->with('success', 'Country added successfully');
    }

    public function countryEdit($id)
    {
        $country = Country::find($id);
        return view('admin.countries.edit', compact('country'));
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
                'name' => 'required|unique:countries,name,' . $id
            ]
        );
        $slug =  env('APP_URL').'/traders/'.$request->name;
        Country::where('id', $id)->update(['name' => $request->name, 'slug' => $slug]);

        return back()->with('success', 'Country updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $country = Country::where('id', $id)->first();

        Town::where('country', $country->name)->delete();
        City::where('country', $country->name)->delete();
        County::where('country', $country->name)->delete();
        State::where('country', $country->name)->delete();

        Country::where('id', $id)->delete();

        return back()->with('success', 'Country deleted successfully');
    }

    public function countriesList(Request $request)
    {
        $columns = array('id', 'country');

        $totalCountrys = DB::table('countries')->count();
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
            $countries = DB::table('countries')
                ->select('id', 'name')
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
        } else {
            $search = $request->input('search.value');
            $countries = DB::table('countries')
                ->select('id', 'name')
                ->where('name', 'LIKE', "%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();

            $totalFiltered = $countries->count();
        }

        $data = array();
        if (!empty($countries)) {
            foreach ($countries as $country) {
                $nestedData['id']       = $country->id;
                $nestedData['country']     = $country->name;
                $nestedData['action']   = '<a href="'.url("country-edit", $country->id).'" class="mr-2"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 14" height="18" width="18"><path d="M5,12.24.5,13.5,1.76,9,10,.8a1,1,0,0,1,1.43,0L13.2,2.58A1,1,0,0,1,13.2,4Z" fill="none" stroke="#1b55e2" stroke-linecap="round" stroke-linejoin="round"></path></svg></a>
                <a href="" class="delete-country" data-toggle="modal" data-action="' . route('countries.destroy', $country->id) . '" data-target="#delete-country"><svg class="mb-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 14" height="18" width="18"><g><polyline points="11.5 5.5 10.5 13.5 3.5 13.5 2.5 5.5" fill="none" stroke="#1b55e2" stroke-linecap="round" stroke-linejoin="round"></polyline><line x1="1" y1="3.5" x2="13" y2="3.5" fill="none" stroke="#1b55e2" stroke-linecap="round" stroke-linejoin="round"></line><path d="M4.46,3.21l0-1.73a1,1,0,0,1,1-1h3a1,1,0,0,1,1,1v2" fill="none" stroke="#1b55e2" stroke-linecap="round" stroke-linejoin="round"></path></g></svg></a>';
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
