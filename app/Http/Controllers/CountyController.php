<?php

namespace App\Http\Controllers;

use App\Country;
use App\County;
use App\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CountyController extends Controller
{
    public function index()
    {
        $countries = Country::all();
        $states = State::all();
        return view('admin.counties.index', compact('countries', 'states'));
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
                'name' => 'required|unique:counties,name'
            ]
        );

        $slug =  env('APP_URL').'/traders/'.$request->name;
        County::create(['country' => $request->country, 'state' => $request->state, 'name' => $request->name, 'slug' => $slug]);

        return back()->with('success', 'County added successfully');
    }

    public function countyEdit($id)
    {
        $countries = Country::all();
        $states = State::all();
        $county = County::find($id);
        return view('admin.counties.edit', compact('countries','states' ,'county'));
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
                'name' => 'required|unique:counties,name,' . $id
            ]
        );

        $slug =  env('APP_URL').'/traders/'.$request->name;
        County::where('id', $id)->update(['country' => $request->country, 'state' => $request->state, 'name' => $request->name, 'slug' => $slug]);

        return back()->with('success', 'County updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        County::where('id', $id)->delete();

        return back()->with('success', 'County deleted successfully');
    }

    public function countiesList(Request $request)
    {
        $columns = array('id', 'county');

        $totalCountys = DB::table('counties')->count();
        $totalFiltered = $totalCountys;
        if ($request->input('length') == -1) {
            $limit =  $totalCountys;
        } else {
            $limit = $request->input('length');
        }
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $counties = DB::table('counties')
                ->select('id', 'country', 'state', 'name')
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
        } else {
            $search = $request->input('search.value');
            $counties = DB::table('counties')
                ->select('id', 'country',  'state', 'name')
                ->where('name', 'LIKE', "%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();

            $totalFiltered = $counties->count();
        }

        $data = array();
        if (!empty($counties)) {
            foreach ($counties as $county) {
                $nestedData['id']       = $county->id;
                $nestedData['country']     = $county->country;
                $nestedData['state']     = $county->state;
                $nestedData['county']     = $county->name;
                $nestedData['action']   = '<a href="'.url("county-edit", $county->id).'" class="mr-2"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 14" height="18" width="18"><path d="M5,12.24.5,13.5,1.76,9,10,.8a1,1,0,0,1,1.43,0L13.2,2.58A1,1,0,0,1,13.2,4Z" fill="none" stroke="#1b55e2" stroke-linecap="round" stroke-linejoin="round"></path></svg></a>
                <a href="" class="delete-county" data-toggle="modal" data-action="' . route('counties.destroy', $county->id) . '" data-target="#delete-county"><svg class="mb-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 14" height="18" width="18"><g><polyline points="11.5 5.5 10.5 13.5 3.5 13.5 2.5 5.5" fill="none" stroke="#1b55e2" stroke-linecap="round" stroke-linejoin="round"></polyline><line x1="1" y1="3.5" x2="13" y2="3.5" fill="none" stroke="#1b55e2" stroke-linecap="round" stroke-linejoin="round"></line><path d="M4.46,3.21l0-1.73a1,1,0,0,1,1-1h3a1,1,0,0,1,1,1v2" fill="none" stroke="#1b55e2" stroke-linecap="round" stroke-linejoin="round"></path></g></svg></a>';
                $data[] = $nestedData;
            }
        }

        $json_data = array(
            "draw" => intval($request->input('draw')),
            "recordsTotal" => intval($totalCountys),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data,
        );

        echo json_encode($json_data);
    }
}
