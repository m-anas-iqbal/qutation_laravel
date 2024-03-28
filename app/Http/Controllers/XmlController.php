<?php

namespace App\Http\Controllers;

use App\City;
use App\Country;
use App\County;
use App\State;
use App\Town;
use DOMDocument;
use Illuminate\Http\Request;
use File;

class XmlController extends Controller
{
    public function index()
    {
        $countries = Country::all();
        $states = State::where('name' , '!=', null)->get();
        $counties = County::where('name' , '!=', null)->get();
        $cities = City::where('name' , '!=', null)->get();
        $towns = Town::all();
        $postcodes = Town::get()->unique('half_postcode');
//        $xmlString =  response()->view('admin.sitemap', [
//            'datas' => $datas
//        ])->header('Content-Type', 'text/xml');

        $xmlString = '<?xml version="1.0" encoding="UTF-8"?>
    <urlset 
	xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" 
	xmlns:image="http://www.google.com/schemas/sitemap-image/1.1" 
	xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd" 
	xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

        foreach ($countries as $item=>$data) {
            $xmlString.='<url><loc>'.url('/a',$data->name).'</loc><lastmod>'.$data->created_at->tz('UTC')->toAtomString().'</lastmod></url>';
        }

        foreach ($states as $item=>$data) {
            $xmlString.='<url><loc>'.url('/a/'.$data->country.isset($data->name)?'/':''.$data->name).'</loc><lastmod>'.$data->created_at->tz('UTC')->toAtomString().'</lastmod></url>';
        }

        foreach ($counties as $item=>$data) {
            $xmlString.='<url><loc>'.url('/a/'.$data->country. (isset($data->state)?'/':'') .$data->state. (isset($data->name)?'/':'') .$data->name).'</loc><lastmod>'.$data->created_at->tz('UTC')->toAtomString().'</lastmod></url>';
        }

        foreach ($cities as $item=>$data) {
            $xmlString.='<url><loc>'.url('/a/'.$data->country.(isset($data->state)?'/':'').$data->state.(isset($data->county)?'/':'').$data->county.(isset($data->name)?'/':'').$data->name).'</loc><lastmod>'.$data->created_at->tz('UTC')->toAtomString().'</lastmod></url>';
        }

        foreach ($towns as $item=>$data) {
            if (isset($data->state) && $data->county && $data->city) {
                $name = preg_replace('/&(?!#?[a-z0-9]+;)/', '&amp;', $data->name);
                $xmlString .= '<url><loc>' . url('/a/' . $data->country . (isset($data->state)?'/':'') . $data->state . (isset($data->county)?'/':'') . $data->county . (isset($data->city)?'/':'') . $data->city . (isset($name)?'/':'') . $name) . '</loc><lastmod>' . $data->created_at->tz('UTC')->toAtomString() . '</lastmod></url>';
            }
        }


        foreach ($postcodes as $item=>$data) {
            if (isset($data->state) && $data->county && $data->city) {
                $xmlString .= '<url><loc>' . url('/ab/' . $data->country . (isset($data->state)?'/':'') . $data->state . (isset($data->county)?'/':'') . $data->county . (isset($data->half_postcode)?'/':'') . $data->half_postcode) . '</loc><lastmod>' . $data->created_at->tz('UTC')->toAtomString() . '</lastmod></url>';
            }
        }

        $xmlString.=' </urlset>';

        $dom = new DOMDocument;
        $dom->preserveWhiteSpace = FALSE;
        $dom->loadXML($xmlString);

//Save XML as a file
        File::delete(public_path('sitemap_data.xml'));
        $dom->save(public_path('sitemap_data.xml'));

        return back()->with('success', 'Saved successfully');
    }
}
