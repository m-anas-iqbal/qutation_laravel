<?php

namespace App\Http\Controllers;

use App\City;
use App\Country;
use App\County;
use App\Exports\ExportCity;
use App\Exports\ExportCounty;
use App\Exports\ExportData;
use App\Exports\ExportState;
use App\Exports\ExportTown;
use App\Exports\ExportUrl;
use App\State;
use App\Town;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ImportCity;
use App\Imports\ImportCountry;
use App\Imports\ImportCounty;
use App\Imports\ImportState;
use App\Imports\ImportTown;
use App\Exports\ExportCountry;

class ExcelController extends Controller
{
    public function importView(Request $request){

//       return $applicant = Country::join('states', 'states.country', '=', 'countries.name')
//            ->join('counties', 'counties.country', '=', 'countries.name')
//            ->join('cities', 'cities.county', '=', 'counties.name')
//            ->join('towns', 'towns.city', '=', 'cities.name')
//            ->select( 'countries.name as country', 'states.name', 'counties.name as county', 'cities.name as city', 'towns.name')
//            ->get();
//        var_dump($applicant);
//        die;


        return view('admin.import_file');
    }

    public function import(Request $request){
        Excel::import(new ImportCountry(),
            $request->file('file')->store('files'));
        Excel::import(new ImportState(),
            $request->file('file')->store('files'));
        Excel::import(new ImportCounty(),
            $request->file('file')->store('files'));
        Excel::import(new ImportCity(),
            $request->file('file')->store('files'));
        Excel::import(new ImportTown(),
            $request->file('file')->store('files'));
        return redirect()->back()->with('success', 'Date Added Successfully.');
    }

    public function townImport(Request $request)
    {
        Excel::import(new ImportTown(),
            $request->file('file')->store('files'));
        return redirect()->back()->with('success', 'Date Updated Successfully.');
    }

    public function exportCountry(Request $request){
        return Excel::download(new ExportCountry(), 'countries.xlsx');
    }

    public function exportState(Request $request){
        return Excel::download(new ExportState(), 'states.xlsx');
    }

    public function exportCounty(Request $request){
        return Excel::download(new ExportCounty(), 'counties.xlsx');
    }

    public function exportCity(Request $request){
        return Excel::download(new ExportCity(), 'cities.xlsx');
    }

    public function exportTown(Request $request){
        return Excel::download(new ExportTown(), 'towns.xlsx');
    }

    public function exportExcel()
    {
        return Excel::download(new ExportData(), 'data.xlsx');
    }

    public function exportUrl()
    {
        $countries = Country::all();
        $states = State::all();
        $counties = County::all();
        $cities = City::all();
        $towns = Town::all();
        return view('admin.export_excel', compact('countries', 'states', 'counties', 'cities', 'towns'));

    }

    public function exportByCategory(Request $request)
    {
        $category = $request->service_area;
//        $check_status = County::where('name', $category)->first();
//        if (isset($check_status)){
//            $country = County::where('name', $category)->first();
//        }
//        die();
        return Excel::download(new ExportUrl($category), 'data_urls.xlsx');
    }

}
