<?php

namespace App\Http\Controllers;

use App\BusinessCategory;
use App\BusinessSubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BusinessSubCategoryController extends Controller
{
    public function index()
    {
        $cats = BusinessCategory::all();
        return view('admin.business_sub_categories.index', compact('cats'));
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
                'category_id' => 'required',
                'name' => 'required|unique:business_sub_categories,name'
            ]
        );
        BusinessSubCategory::create(['category_id' => $request->category_id, 'name' => $request->name]);
        return back()->with('success', 'Business SubCategory added successfully');
    }

    public function Edit($id)
    {
        $cats = BusinessCategory::all();
        $category = BusinessSubCategory::find($id);
        return view('admin.business_sub_categories.edit', compact('category', 'cats'));
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
                'category_id' => 'required',
                'name' => 'required|unique:business_sub_categories,name,' . $id
            ]
        );
        BusinessSubCategory::where('id', $id)->update(['category_id' => $request->category_id, 'name' => $request->name]);

        return back()->with('success', 'Business SubCategory updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        BusinessSubCategory::where('id', $id)->delete();
        return back()->with('success', 'Business SubCategory deleted successfully');
    }

    public function dataList(Request $request)
    {
        $columns = array('id', 'category');

        $totalBusinessSubCategorys = DB::table('business_sub_categories')->count();
        $totalFiltered = $totalBusinessSubCategorys;
        if ($request->input('length') == -1) {
            $limit =  $totalBusinessSubCategorys;
        } else {
            $limit = $request->input('length');
        }
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $business_sub_categories = DB::table('business_sub_categories')
                ->select('id', 'category_id', 'name')
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
        } else {
            $search = $request->input('search.value');
            $business_sub_categories = DB::table('business_sub_categories')
                ->select('id', 'name')
                ->where('name', 'LIKE', "%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();

            $totalFiltered = $business_sub_categories->count();
        }

        $data = array();
        if (!empty($business_sub_categories)) {
            foreach ($business_sub_categories as $category) {
                $main = BusinessCategory::where('id', $category->category_id)->first();
                $nestedData['id']       = $category->id;
                $nestedData['category']     = $main->name;
                $nestedData['sub_category']     = $category->name;
                $nestedData['action']   = '<a href="'.url("business-sub-category-edit", $category->id).'" class="mr-2"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 14" height="18" width="18"><path d="M5,12.24.5,13.5,1.76,9,10,.8a1,1,0,0,1,1.43,0L13.2,2.58A1,1,0,0,1,13.2,4Z" fill="none" stroke="#1b55e2" stroke-linecap="round" stroke-linejoin="round"></path></svg></a>
                <a href="" class="delete-category" data-toggle="modal" data-action="' . route('business-sub-categories.destroy', $category->id) . '" data-target="#delete-category"><svg class="mb-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 14" height="18" width="18"><g><polyline points="11.5 5.5 10.5 13.5 3.5 13.5 2.5 5.5" fill="none" stroke="#1b55e2" stroke-linecap="round" stroke-linejoin="round"></polyline><line x1="1" y1="3.5" x2="13" y2="3.5" fill="none" stroke="#1b55e2" stroke-linecap="round" stroke-linejoin="round"></line><path d="M4.46,3.21l0-1.73a1,1,0,0,1,1-1h3a1,1,0,0,1,1,1v2" fill="none" stroke="#1b55e2" stroke-linecap="round" stroke-linejoin="round"></path></g></svg></a>';
                $data[] = $nestedData;
            }
        }

        $json_data = array(
            "draw" => intval($request->input('draw')),
            "recordsTotal" => intval($totalBusinessSubCategorys),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data,
        );

        echo json_encode($json_data);
    }
}
