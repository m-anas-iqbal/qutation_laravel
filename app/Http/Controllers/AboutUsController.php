<?php

namespace App\Http\Controllers;

use App\AboutUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AboutUsController extends Controller
{
    public function index()
    {

        $about_us = AboutUs::first();
        return view('admin.about_us.edit', compact('about_us'));
//        return view('admin.about_us.index');
    }
    
    public function aboutUsEdit($id)
    {
        $about_us = AboutUs::find($id);
        return view('admin.about_us.edit', compact('about_us'));
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
                'title' => 'required|unique:about_us,title,' . $id
            ]
        );

        AboutUs::where('id', $id)->update(['title' => $request->title, 'description' => $request->description]);

        return back()->with('success', 'Data updated successfully');
    }


    public function aboutUsList(Request $request)
    {
        $columns = array('id', 'about_us');

        $totalAboutUss = DB::table('about_us')->count();
        $totalFiltered = $totalAboutUss;
        if ($request->input('length') == -1) {
            $limit =  $totalAboutUss;
        } else {
            $limit = $request->input('length');
        }
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $about_us = DB::table('about_us')
                ->select('id', 'title', 'description')
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
        } else {
            $search = $request->input('search.value');
            $about_us = DB::table('about_us')
                ->select('id', 'title')
                ->where('title', 'LIKE', "%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();

            $totalFiltered = $about_us->count();
        }

        $data = array();
        if (!empty($about_us)) {
            foreach ($about_us as $about_us) {
                $nestedData['id']       = $about_us->id;
                $nestedData['title']     = $about_us->title;
                $nestedData['description']     = $about_us->description;
                $nestedData['action']   = '<a href="'.url("about-us-edit", $about_us->id).'" class="mr-2"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 14" height="18" width="18"><path d="M5,12.24.5,13.5,1.76,9,10,.8a1,1,0,0,1,1.43,0L13.2,2.58A1,1,0,0,1,13.2,4Z" fill="none" stroke="#1b55e2" stroke-linecap="round" stroke-linejoin="round"></path></svg></a>';
                $data[] = $nestedData;
            }
        }

        $json_data = array(
            "draw" => intval($request->input('draw')),
            "recordsTotal" => intval($totalAboutUss),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data,
        );

        echo json_encode($json_data);
    }
}
