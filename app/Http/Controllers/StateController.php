<?php

namespace App\Http\Controllers;

use App\Country;
use Illuminate\Http\Request;
use App\State;
use Illuminate\Support\Facades\DB;

class StateController extends Controller
{
    public function index()
    {
        $countries = Country::all();
        return view('admin.states.index', compact('countries'));
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
                'name' => 'required|unique:states,name'
            ]
        );

        $slug =  env('APP_URL').'/traders/'.$request->name;
        State::create(['country' => $request->country, 'name' => $request->name, 'slug' => $slug]);

        return back()->with('success', 'State added successfully');
    }

    public function stateEdit($id)
    {
        $countries = Country::all();
        $state = State::find($id);
        return view('admin.states.edit', compact('countries','state'));
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
                'name' => 'required|unique:states,name,' . $id
            ]
        );

        $slug =  env('APP_URL').'/traders/'.$request->name;
        State::where('id', $id)->update(['name' => $request->name, 'slug' => $slug]);

        return back()->with('success', 'State updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        State::where('id', $id)->delete();

        return back()->with('success', 'State deleted successfully');
    }

    public function statesList(Request $request)
    {
        $columns = array('id', 'state');

        $totalStates = DB::table('states')->count();
        $totalFiltered = $totalStates;
        if ($request->input('length') == -1) {
            $limit =  $totalStates;
        } else {
            $limit = $request->input('length');
        }
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $states = DB::table('states')
                ->select('id', 'country', 'name')
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
        } else {
            $search = $request->input('search.value');
            $states = DB::table('states')
                ->select('id', 'country',  'name')
                ->where('name', 'LIKE', "%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();

            $totalFiltered = $states->count();
        }

        $data = array();
        if (!empty($states)) {
            foreach ($states as $state) {
                $nestedData['id']       = $state->id;
                $nestedData['country']     = $state->country;
                $nestedData['state']     = $state->name;
                $nestedData['action']   = '<a href="'.url("state-edit", $state->id).'" class="mr-2"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 14" height="18" width="18"><path d="M5,12.24.5,13.5,1.76,9,10,.8a1,1,0,0,1,1.43,0L13.2,2.58A1,1,0,0,1,13.2,4Z" fill="none" stroke="#1b55e2" stroke-linecap="round" stroke-linejoin="round"></path></svg></a>
                <a href="" class="delete-state" data-toggle="modal" data-action="' . route('states.destroy', $state->id) . '" data-target="#delete-state"><svg class="mb-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 14" height="18" width="18"><g><polyline points="11.5 5.5 10.5 13.5 3.5 13.5 2.5 5.5" fill="none" stroke="#1b55e2" stroke-linecap="round" stroke-linejoin="round"></polyline><line x1="1" y1="3.5" x2="13" y2="3.5" fill="none" stroke="#1b55e2" stroke-linecap="round" stroke-linejoin="round"></line><path d="M4.46,3.21l0-1.73a1,1,0,0,1,1-1h3a1,1,0,0,1,1,1v2" fill="none" stroke="#1b55e2" stroke-linecap="round" stroke-linejoin="round"></path></g></svg></a>';
                $data[] = $nestedData;
            }
        }

        $json_data = array(
            "draw" => intval($request->input('draw')),
            "recordsTotal" => intval($totalStates),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data,
        );

        echo json_encode($json_data);
    }
}
