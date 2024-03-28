<?php

namespace App\Http\Controllers;

use App\BusinessCategory;
use App\CategoryDescription;
use App\City;
use App\Country;
use App\County;
use App\Faq;
use App\Group;
use App\GroupTagDescription;
use App\State;
use App\Town;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CategoryDescriptionController extends Controller
{

    public function index()
    {
        return view('admin.category_description.index');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

    public function descriptionCreate()
    {

        $countries = Country::all();
        $states = State::all();
        $counties = County::all();
        $cities = City::all();
        $towns = Town::all();

        $descriptions = CategoryDescription::all();

        $filter_arr_country_1 = [];
        $filter_arr_country_2 = [];

        $filter_arr_state_1 = [];
        $filter_arr_state_2 = [];

        $filter_arr_county_1 = [];
        $filter_arr_county_2 = [];

        $filter_arr_city_1 = [];
        $filter_arr_city_2 = [];

        $filter_arr_town_1 = [];
        $filter_arr_town_2 = [];

//        country

        foreach ($countries as $country){
            $filter_arr_country_1[] = $country->name;
        }
        foreach ($descriptions as $description){
            $arr_values = explode(',', $description->service_area);
            foreach ($arr_values as $value){
                $filter_arr_country_2[] = $value;
            }
        }
        $filter_arr_countries = array_diff($filter_arr_country_1, $filter_arr_country_2);
//        print_r($filter_arr_country_2);
//        die();

//        state

        foreach ($states as $state){
            $filter_arr_state_1[] = $state->name;
        }
        foreach ($descriptions as $description){
            $arr_values = explode(',', $description->service_area);
            foreach ($arr_values as $value){
                $filter_arr_state_2[] = $value;
            }
        }
        $filter_arr_states = array_diff($filter_arr_state_1, $filter_arr_state_2);

//        county


        foreach ($counties as $county){
            $filter_arr_county_1[] = $county->name;
        }
        foreach ($descriptions as $description){
            $arr_values = explode(',', $description->service_area);
            foreach ($arr_values as $value){
                $filter_arr_county_2[] = $value;
            }
        }
        $filter_arr_counties = array_diff($filter_arr_county_1, $filter_arr_county_2);

//        city

        foreach ($cities as $city){
            $filter_arr_city_1[] = $city->name;
        }
        foreach ($descriptions as $description){
            $arr_values = explode(',', $description->service_area);
            foreach ($arr_values as $value){
                $filter_arr_city_2[] = $value;
            }
        }
        $filter_arr_cities = array_diff($filter_arr_city_1, $filter_arr_city_2);

//        town

        foreach ($towns as $town){
            $filter_arr_town_1[] = $town->name;
        }
        foreach ($descriptions as $description){
            $arr_values = explode(',', $description->service_area);
            foreach ($arr_values as $value){
                $filter_arr_town_2[] = $value;
            }
        }
        $filter_arr_towns = array_diff($filter_arr_town_1, $filter_arr_town_2);

        $groups = Group::all();

        return view('admin.category_description.create', compact('filter_arr_states', 'filter_arr_counties', 'filter_arr_cities', 'filter_arr_towns', 'filter_arr_countries', 'groups'));
    }

    public function store(Request $request)
    {

        $short_service_area = $request->short_service_area;
        $short_arr_values = implode(',', $short_service_area);

        $cat_arr = $request->service_area;
        $cat_arr_values = implode(',', $cat_arr);

        $questions = str_replace('{tag_area}', $short_arr_values, $request->question);
        $answers = str_replace('{tag_area}', $short_arr_values, $request->answer);

        $key_values = array_combine($questions, $answers);

//        print_r($c);
//        die();

        $this->validate(
            $request, [
                'service_area' => 'required|unique:category_descriptions'
            ]
        );


        $description = str_replace('{tag_area}', $short_arr_values, $request->description);

        $tag_description = str_replace('{tag_area}', $short_arr_values, $request->tag_description);


//        foreach ($request->input('group', []) as $id) {
//        echo "Package ID: ". $id ."\n";
//            echo "Quantity: ". $request->input('tag_description.'. $id) ."\n";
//         }
//        $week_no=1;
//        $activity='sdadsad';
//        return 'select_teacherActivity'.$week_no. $activity;


//die();
        $description =  CategoryDescription::create(['service_area' => $cat_arr_values, 'service_area_values' => $short_arr_values, 'description' => $description]);

        for ($i=0; $i<100; $i++) {
            $group = 'group'.$i;
            $group_name = $request->$group;
            if (isset($group_name)) {
                $tag = 'tag_description'.$i;
                $tags = $request->$tag;
                $tag_arr_values = implode(',', $tags);

                $group = Group::create([
                    'service_category_id' => $description->id,
                    'name' => $group_name
                ]);

                foreach ($tags as $arr_value){
                    GroupTagDescription::create([
                        'service_category_id' => $description->id,
                        'group_id' => $group->id,
                        'description' => $arr_value
                    ]);
                }

//                var_dump($group_name);
//                var_dump($tag_arr_values);
            }
        }

        if (!array_filter($request->question) == []) {
            foreach ($key_values as $key => $value) {
                Faq::create([
                    'service_category_id' => $description->id,
                    'question' => $key,
                    'answer' => $value,
                ]);
            }
        }

        return back()->with('success', 'Data added successfully');
    }

    public function descriptionEdit($id)
    {
        $category_description = CategoryDescription::find($id);

        $countries = Country::all();
        $states = State::all();
        $counties = County::all();
        $cities = City::all();
        $towns = Town::all();

        $descriptions = CategoryDescription::all();

        $filter_arr_country_1 = [];
        $filter_arr_country_2 = [];

        $filter_arr_state_1 = [];
        $filter_arr_state_2 = [];

        $filter_arr_county_1 = [];
        $filter_arr_county_2 = [];

        $filter_arr_city_1 = [];
        $filter_arr_city_2 = [];

        $filter_arr_town_1 = [];
        $filter_arr_town_2 = [];

//        country

        foreach ($countries as $country){
            $filter_arr_country_1[] = $country->name;
        }
        foreach ($descriptions as $description){
            $arr_values = explode(',', $description->service_area_values);
            foreach ($arr_values as $value){
                $filter_arr_country_2[] = $value;
            }
        }
        $filter_arr_countries = array_diff($filter_arr_country_1, $filter_arr_country_2);
//        print_r($filter_arr_country_2);
//        die();

//        state

        foreach ($states as $state){
            $filter_arr_state_1[] = $state->name;
        }
        foreach ($descriptions as $description){
            $arr_values = explode(',', $description->service_area_values);
            foreach ($arr_values as $value){
                $filter_arr_state_2[] = $value;
            }
        }
        $filter_arr_states = array_diff($filter_arr_state_1, $filter_arr_state_2);

//        county


        foreach ($counties as $county){
            $filter_arr_county_1[] = $county->name;
        }
        foreach ($descriptions as $description){
            $arr_values = explode(',', $description->service_area_values);
            foreach ($arr_values as $value){
                $filter_arr_county_2[] = $value;
            }
        }
        $filter_arr_counties = array_diff($filter_arr_county_1, $filter_arr_county_2);

//        city

        foreach ($cities as $city){
            $filter_arr_city_1[] = $city->name;
        }
        foreach ($descriptions as $description){
            $arr_values = explode(',', $description->service_area_values);
            foreach ($arr_values as $value){
                $filter_arr_city_2[] = $value;
            }
        }
        $filter_arr_cities = array_diff($filter_arr_city_1, $filter_arr_city_2);

//        town

        foreach ($towns as $town){
            $filter_arr_town_1[] = $town->name;
        }
        foreach ($descriptions as $description){
            $arr_values = explode(',', $description->service_area_values);
            foreach ($arr_values as $value){
                $filter_arr_town_2[] = $value;
            }
        }
        $filter_arr_towns = array_diff($filter_arr_town_1, $filter_arr_town_2);

        $arr_service_areas = explode(',', $category_description->service_area_values);

        $faqs = Faq::where('service_category_id', $id)->get();

        $groups = Group::where('service_category_id', $id)->get();
        return view('admin.category_description.edit', compact('filter_arr_states', 'filter_arr_counties', 'filter_arr_cities', 'filter_arr_towns', 'filter_arr_countries', 'category_description', 'arr_service_areas', 'faqs', 'groups'));
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
//        $this->validate(
//            $request, [
//                'service_area' => 'required|unique:category_descriptions'
//            ]
//        );

//        $questions = $request->question;
//        $answers = $request->answer;


        $short_service_area = $request->short_service_area;
        $short_arr_values = implode(',', $short_service_area);

        $cat_arr = $request->service_area;
        $cat_arr_values = implode(',', $cat_arr);


        $questions = str_replace('{tag_area}', $short_arr_values, $request->question);
        $answers = str_replace('{tag_area}', $short_arr_values, $request->answer);

        if ($request->question) {
            $key_values = array_combine($questions, $answers);
        }


        $description = str_replace('{tag_area}', $short_arr_values, $request->description);
//        $tag_description = str_replace('{tag_area}', $short_arr_values, $request->tag_description);


        $description =  CategoryDescription::where('id', $id)->update([

            'service_area' => $cat_arr_values,
            'service_area_values' => $short_arr_values,
            'description' => $description,
//            'tag_description' => $tag_description

        ]);

        for ($i=0; $i<100; $i++) {
            $group = 'group'.$i;
            $gg = $request->$group;
            if (!empty($gg)) {
                $group_status = Group::where('name', $gg)->where('status', 1)->first();
                if (isset($group_status)) {
                    Session::put('group_name', $group_status->name);
                }

            }

        }
        $session_value = Session::get('group_name');


        Group::where('service_category_id', $id)->delete();
        GroupTagDescription::where('service_category_id', $id)->delete();
        for ($i=0; $i<100; $i++) {
            $group = 'group'.$i;
            $group_name = $request->$group;
            $group_names[] = $request->$group;
            if (isset($group_name)) {
                $tag = 'tag_description'.$i;
                $tags = $request->$tag;
                $exist = Group::where('name', $group_name)->first();
                if (!isset($exist)) {
                    $group = Group::create([
                        'service_category_id' => $id,
                        'name' => $group_name
                    ]);
                    if (isset($tags)) {
                        foreach ($tags as $arr_value) {
                            GroupTagDescription::create([
                                'service_category_id' => $id,
                                'group_id' => $group->id,
                                'description' => $arr_value
                            ]);
                        }
                    }
                }
            }
        }
        Group::where('name', $session_value)->update([
            'status' => 1
        ]);

        Faq::where('service_category_id', $id)->delete();

        if ($request->question) {
            foreach ($key_values as $key => $value) {
                Faq::create([
                    'service_category_id' => $id,
                    'question' => $key,
                    'answer' => $value,
                ]);
            }
        }
        return back()->with('success', 'Data updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Faq::where('service_category_id', $id)->delete();
        CategoryDescription::where('id', $id)->delete();
        return back()->with('success', 'Data deleted successfully');
    }

    public function descriptionList(Request $request)
    {
        $columns = array('id', 'service_area');

        $totalCountrys = DB::table('category_descriptions')->count();
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
            $category_descriptions = DB::table('category_descriptions')
                ->select('id', 'service_area_values', 'description')
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
        } else {
            $search = $request->input('search.value');
            $category_descriptions = DB::table('category_descriptions')
                ->select('id', 'service_area_values', 'description')
                ->where('name', 'LIKE', "%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();

            $totalFiltered = $category_descriptions->count();
        }

        $data = array();
        if (!empty($category_descriptions)) {
            foreach ($category_descriptions as $category_description) {

                $arr_values = explode(',', $category_description->service_area_values);

                $nestedData['id']       = $category_description->id;
                $nestedData['service_area']     = $arr_values;
                $nestedData['description']     = $category_description->description;
                $nestedData['action']   = '<a href="' . route('category.description.show', $category_description->id) . '" class="mr-1"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 14" height="18" width="18"><g><path d="M.91,12.56l-.41-7A.5.5,0,0,1,1,5H5.61a.51.51,0,0,1,.49.38L6.5,7H13a.5.5,0,0,1,.5.54l-.39,5a1,1,0,0,1-1,.92H1.91A1,1,0,0,1,.91,12.56Z" fill="none" stroke="#1b55e2" stroke-linecap="round" stroke-linejoin="round"></path><path d="M3.5,3V1A.5.5,0,0,1,4,.5h8.5A.5.5,0,0,1,13,1V5" fill="none" stroke="#1b55e2" stroke-linecap="round" stroke-linejoin="round"></path><line x1="7.5" y1="3" x2="10.5" y2="3" fill="none" stroke="#1b55e2" stroke-linecap="round" stroke-linejoin="round"></line></g></svg></a><a href="'.url("category-description-edit", $category_description->id).'" class="mr-2"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 14" height="18" width="18"><path d="M5,12.24.5,13.5,1.76,9,10,.8a1,1,0,0,1,1.43,0L13.2,2.58A1,1,0,0,1,13.2,4Z" fill="none" stroke="#1b55e2" stroke-linecap="round" stroke-linejoin="round"></path></svg></a>
                <a href="" class="delete-description" data-toggle="modal" data-action="' . route('category-description.destroy', $category_description->id) . '" data-target="#delete-description"><svg class="mb-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 14" height="18" width="18"><g><polyline points="11.5 5.5 10.5 13.5 3.5 13.5 2.5 5.5" fill="none" stroke="#1b55e2" stroke-linecap="round" stroke-linejoin="round"></polyline><line x1="1" y1="3.5" x2="13" y2="3.5" fill="none" stroke="#1b55e2" stroke-linecap="round" stroke-linejoin="round"></line><path d="M4.46,3.21l0-1.73a1,1,0,0,1,1-1h3a1,1,0,0,1,1,1v2" fill="none" stroke="#1b55e2" stroke-linecap="round" stroke-linejoin="round"></path></g></svg></a>';
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

    public function descriptionShow($id)
    {
        $description = CategoryDescription::where('id', $id)->first();
        $faqs = Faq::where('service_category_id', $description->id)->get();
        return view('admin.category_description.show', compact('description', 'faqs'));
    }

    public function saveGroup(Request $request)
    {
        Group::where('id', $request->group_id)->update([
            'status' => 1
        ]);
        Group::where('id', '!=' ,$request->group_id)->update([
            'status' => 0
        ]);
        return back()->with('success', 'Group Active successfully');
    }

    public function activateGroup($category_id, $id)
    {
        Group::where('id', $id)->where('service_category_id', $category_id)->update([
            'status' => 1
        ]);
        Group::where('id', '!=' ,$id)->where('service_category_id', $category_id)->update([
            'status' => 0
        ]);
        return back()->with('success', 'Updated successfully');
    }

    public function deleteGroup($id)
    {
        Group::where('id', $id)->delete();
        GroupTagDescription::where('group_id', $id)->delete();
        return back()->with('success', 'Deleted successfully');
    }

}
