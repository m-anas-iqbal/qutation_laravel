<?php

namespace App\Http\Controllers;

use App\City;
use App\Country;
use App\County;
use App\State;
use App\Town;
use Illuminate\Http\Request;
use App\BusinessCategory;
use Illuminate\Support\Facades\DB;

class BusinessCategoryController extends Controller
{
    public function index()
    {
        $countries = Country::all();
        $states = State::all();
        return view('admin.business_categories.index', compact('countries', 'states'));
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
                'name' => 'required|unique:business_categories,name'
            ]
        );

        BusinessCategory::create(['country' => $request->country, 'state' => $request->state, 'county' => $request->county, 'city' => $request->city, 'town' => $request->town, 'name' => $request->name]);

        return back()->with('success', 'Business Category added successfully');
    }

    public function categoryEdit($id)
    {
        $countries = Country::all();
        $states = State::all();
        $counties = County::all();
        $cities = City::all();
        $towns = Town::all();
        $business_category = BusinessCategory::find($id);
        return view('admin.business_categories.edit', compact('countries','states', 'counties', 'cities', 'towns', 'business_category'));
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
                'name' => 'required|unique:business_categories,name,' . $id
            ]
        );

        BusinessCategory::where('id', $id)->update(['country' => $request->country, 'state' => $request->state, 'county' => $request->county, 'city' => $request->city, 'town' => $request->town, 'name' => $request->name]);

        return back()->with('success', 'Business Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        BusinessCategory::where('id', $id)->delete();

        return back()->with('success', 'Business Category deleted successfully');
    }

    public function categoryList(Request $request)
    {
        $columns = array('id', 'business_category');

        $totalBusinessCategorys = DB::table('business_categories')->count();
        $totalFiltered = $totalBusinessCategorys;
        if ($request->input('length') == -1) {
            $limit =  $totalBusinessCategorys;
        } else {
            $limit = $request->input('length');
        }
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $business_categories = DB::table('business_categories')
                ->select('id', 'country', 'state', 'county', 'city', 'town', 'name')
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
        } else {
            $search = $request->input('search.value');
            $business_categories = DB::table('business_categories')
                ->select('id', 'country', 'state', 'county', 'city', 'town', 'name')
                ->where('name', 'LIKE', "%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();

            $totalFiltered = $business_categories->count();
        }

        $data = array();
        if (!empty($business_categories)) {
            foreach ($business_categories as $business_category) {
                $nestedData['id']       = $business_category->id;
                $nestedData['country']     = $business_category->country;
                $nestedData['state']     = $business_category->state;
                $nestedData['county']     = $business_category->county;
                $nestedData['city']     = $business_category->city;
                $nestedData['town']     = $business_category->town;
                $nestedData['business_category']     = $business_category->name;
                $nestedData['action']   = '<a href="'.url("business-category-edit", $business_category->id).'" class="mr-2"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 14" height="18" width="18"><path d="M5,12.24.5,13.5,1.76,9,10,.8a1,1,0,0,1,1.43,0L13.2,2.58A1,1,0,0,1,13.2,4Z" fill="none" stroke="#1b55e2" stroke-linecap="round" stroke-linejoin="round"></path></svg></a>
                <a href="" class="delete-business-category" data-toggle="modal" data-action="' . route('business-categories.destroy', $business_category->id) . '" data-target="#delete-business-category"><svg class="mb-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 14" height="18" width="18"><g><polyline points="11.5 5.5 10.5 13.5 3.5 13.5 2.5 5.5" fill="none" stroke="#1b55e2" stroke-linecap="round" stroke-linejoin="round"></polyline><line x1="1" y1="3.5" x2="13" y2="3.5" fill="none" stroke="#1b55e2" stroke-linecap="round" stroke-linejoin="round"></line><path d="M4.46,3.21l0-1.73a1,1,0,0,1,1-1h3a1,1,0,0,1,1,1v2" fill="none" stroke="#1b55e2" stroke-linecap="round" stroke-linejoin="round"></path></g></svg></a>';
                $data[] = $nestedData;
            }
        }

        $json_data = array(
            "draw" => intval($request->input('draw')),
            "recordsTotal" => intval($totalBusinessCategorys),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data,
        );

        echo json_encode($json_data);
    }

    public function getTowns(Request $request)
    {
        $towns = Town::where('city', $request->city)->get();
        return view('admin.business_categories.towns', compact('towns'));
    }

}
