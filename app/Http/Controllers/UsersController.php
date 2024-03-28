<?php

namespace App\Http\Controllers;

use App\BusinessCategory;
use App\City;
use App\Country;
use App\County;
use App\Exports\ExportUser;
use App\Image;
use App\Imports\ImportUser;
use App\Review;
use App\BusinessSubCategory;
use App\State;
use App\Town;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\User;
use Maatwebsite\Excel\Facades\Excel;

class UsersController extends Controller
{
    public function index()
    {
        return view('admin.users.index');
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'role_id' => 'required',
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
        ]);

        User::create([
            'role_id' => $request->role_id,
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return redirect(route('users.index'))->with('success', 'New User added successfully.');
    }

    public function show($id)
    {
        $data['user'] = User::find(decrypt($id));
        return view('admin.users.show', $data);
    }

    public function edit($id)
    {
        $user = User::find(decrypt($id));

        $countries = Country::all();
        $states = State::all();
        $counties = County::all();
        $cities = City::all();
        $towns = Town::all();

        $arr_values = explode(',', $user->service_area_values);

        $images = Image::where('user_id', $user->id)->get();

        $trades = BusinessCategory::all();
        // $category_id = $user->business_subcat_name;
        // print_r($category_id);
        // die;
        // $subs = DB::table('business_sub_categories')->where("name",$category_id)->first();
        // print_r($subs);
        // die;
        // ,"subs"
        return view('admin.users.edit', compact('user', 'countries', 'states', 'counties', 'cities', 'towns', 'arr_values', 'images', 'trades' ));
    }

    public function update(Request $request, $id)
    {
        $user = User::where('id', $id)->first();
        $this->validate($request, [
            'name' => 'required|string',
//            'role_id' => 'required',
            'status' => 'required',
        ]);

        $cat_arr = $request->service_area;
        $cat_arr_values = implode(',', $cat_arr);

        $short_service_area = array_unique($request->short_service_area);

        $short_service_area =  array_filter($short_service_area);

        $short_arr_values = implode(',', $short_service_area);


        if ($request->photo) {
            $photoName = time() . '.' . $request->photo->getClientOriginalExtension();
            $photo = $request->photo->move(public_path('upload/user'), $photoName);
        }
        else{
            $photoName = $user->photo;
        }


        $business_subcat_name = $request->business_subcat_name;
        $business_subcat_arr_values = implode(',', $business_subcat_name);

        User::where('id', $id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'service_area' => $cat_arr_values,
            'service_area_values' => $short_arr_values,
            'business_name' => $request->business_name,
            'business_subcat_name' => $business_subcat_arr_values,
            'phone' => $request->phone,
            'postcode' => $request->postcode,
            'business_type' => $request->business_type,
            'business_description' => $request->business_description,
            'no_of_employee' => $request->no_of_employee,
            'website_url' => $request->website_url,
            'photo' => $photoName,
//            'role_id' => $request->role_id,
'rank_order_no'=>$request->rank_order_no,
            'status' => $request->status
        ]);

        $images = $request->images;
        if ($images){
            foreach ($images as $key=>$image){
                $imgName = $key.time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('upload/user/images'), $imgName);
                Image::create([
                    'user_id' => $id,
                    'name' => $imgName
                ]);
            }
        }

        return redirect(route('users.index'))->with('success', 'User updated successfully.');
    }

    public function destroy($id)
    {
        User::find($id)->delete();

        return back()->with('success', 'User deleted successfully');
    }

    public function usersList(Request $request)
    {
        $columns = array('id', 'name', 'role', 'email', 'status');
        $totalUsers = DB::table('users')->where('role_id','!=', 2)->count();
        $totalFiltered = $totalUsers;
        if ($request->input('length') == -1) {
            $limit =  $totalUsers;
        } else {
            $limit = $request->input('length');
        }
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $users = DB::table('users')
                ->select('id', 'name', 'email', 'role_id', 'status', 'is_get_email')
                ->where('role_id','!=', 2)
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
        } else {
            $search = $request->input('search.value');
            $users = DB::table('users')
                ->select('id', 'name', 'email', 'role_id', 'status', 'is_get_email')
                ->where('role_id','!=', 2)
                ->where('name', 'LIKE', "%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();

            $totalFiltered = $users->count();
        }

        $data = array();
        if (!empty($users)) {
            foreach ($users as $user) {
                $nestedData['id']       = $user->id;
                $nestedData['name']     = $user->name;
                $nestedData['email']    = $user->email;
                $nestedData['role']     = ($user->role_id == 1) ? 'Admin' : (($user->role_id == 2) ? 'Trader' : 'User');
                $nestedData['status']   = ($user->status == 1) ? '<span class="badge badge-success">Active</span>' : '<span class="badge badge-danger">Deactive</span>';
                $nestedData['ratings']   = ($user->role_id == 2) ? '<a href="' . url('user-ratings', $user->id) . '" class="mr-1 btn btn-warning">Ratings</a>' : '';
                $nestedData['action']   = '<a href="' . route('users.edit', encrypt($user->id)) . '" class="mr-1"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 14" height="18" width="18"><path d="M5,12.24.5,13.5,1.76,9,10,.8a1,1,0,0,1,1.43,0L13.2,2.58A1,1,0,0,1,13.2,4Z" fill="none" stroke="#1b55e2" stroke-linecap="round" stroke-linejoin="round"></path></svg></a><a href="" class="delete-user" data-toggle="modal" data-target="#delete-user" data-action="' . route('users.destroy', $user->id) . '"><svg class="mb-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 14" height="18" width="18"><g><polyline points="11.5 5.5 10.5 13.5 3.5 13.5 2.5 5.5" fill="none" stroke="#1b55e2" stroke-linecap="round" stroke-linejoin="round"></polyline><line x1="1" y1="3.5" x2="13" y2="3.5" fill="none" stroke="#1b55e2" stroke-linecap="round" stroke-linejoin="round"></line><path d="M4.46,3.21l0-1.73a1,1,0,0,1,1-1h3a1,1,0,0,1,1,1v2" fill="none" stroke="#1b55e2" stroke-linecap="round" stroke-linejoin="round"></path></g></svg></a>';
                $data[] = $nestedData;
            }
        }

        $json_data = array(
            "draw" => intval($request->input('draw')),
            "recordsTotal" => intval($totalUsers),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data,
        );

        echo json_encode($json_data);
    }

    public function usersList_2(Request $request)
    {
        $columns = array('id', 'name', 'role', 'email', 'status');

        $totalUsers = DB::table('users')->where('role_id', 2)->count();
        $totalFiltered = $totalUsers;
        if ($request->input('length') == -1) {
            $limit =  $totalUsers;
        } else {
            $limit = $request->input('length');
        }
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $users = DB::table('users')
                ->select('id', 'name', 'email', 'role_id', 'status', 'is_get_email')
                ->where('role_id', 2)
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
        } else {
            $search = $request->input('search.value');
            $users = DB::table('users')
                ->select('id', 'name', 'email', 'role_id', 'status', 'is_get_email')
                ->where('role_id', 2)->where('name', 'LIKE', "%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();

            $totalFiltered = $users->count();
        }

        $data = array();
        if (!empty($users)) {
            foreach ($users as $user) {
                $nestedData['id']       = $user->id;
                $nestedData['name']     = $user->name;
                $nestedData['email']    = $user->email;
                $nestedData['role']     = ($user->role_id == 1) ? 'Admin' : (($user->role_id == 2) ? 'Trader' : 'User');
                $nestedData['status']   = ($user->status == 1) ? '<span class="badge badge-success">Active</span>' : '<span class="badge badge-danger">Deactive</span>';
                $nestedData['ratings']   = ($user->role_id == 2) ? '<a href="' . url('user-ratings', $user->id) . '" class="mr-1 btn btn-warning">Ratings</a>' : '';
                $nestedData['action']   = '<a href="' . route('users.edit', encrypt($user->id)) . '" class="mr-1"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 14" height="18" width="18"><path d="M5,12.24.5,13.5,1.76,9,10,.8a1,1,0,0,1,1.43,0L13.2,2.58A1,1,0,0,1,13.2,4Z" fill="none" stroke="#1b55e2" stroke-linecap="round" stroke-linejoin="round"></path></svg></a><a href="" class="delete-user" data-toggle="modal" data-target="#delete-user" data-action="' . route('users.destroy', $user->id) . '"><svg class="mb-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 14" height="18" width="18"><g><polyline points="11.5 5.5 10.5 13.5 3.5 13.5 2.5 5.5" fill="none" stroke="#1b55e2" stroke-linecap="round" stroke-linejoin="round"></polyline><line x1="1" y1="3.5" x2="13" y2="3.5" fill="none" stroke="#1b55e2" stroke-linecap="round" stroke-linejoin="round"></line><path d="M4.46,3.21l0-1.73a1,1,0,0,1,1-1h3a1,1,0,0,1,1,1v2" fill="none" stroke="#1b55e2" stroke-linecap="round" stroke-linejoin="round"></path></g></svg></a>';
                $data[] = $nestedData;
            }
        }

        $json_data = array(
            "draw" => intval($request->input('draw')),
            "recordsTotal" => intval($totalUsers),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data,
        );

        echo json_encode($json_data);
    }

    public function adminsStatusChange(Request $request)
    {
        User::find($request->id)->update(['is_get_email' => $request->status]);
        return 1;
    }

//    import export functions
    public function importView(Request $request){
        return view('importFile');
    }

    public function import(Request $request){
        Excel::import(new ImportUser,
            $request->file('file')->store('files'));
        return redirect()->back();
    }

    public function exportUsers(Request $request){
        return Excel::download(new ExportUser, 'users.xlsx');
    }

    public function userRatings($id)
    {
        $user = User::where('id', $id)->first();
        $ratings = Review::where('company_name', $user->name)->get();
        return view('admin.users.reviews', compact('ratings'));
    }

    public function deleteRating($id)
    {
        Review::where('id', $id)->delete();
        return back()->with('success', 'Deleted successfully.');
    }

}
