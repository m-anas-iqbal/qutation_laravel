<?php

namespace App\Exports;

use App\City;
use App\Country;
use App\County;
use App\State;
use App\Town;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportUrl implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $category;

    function __construct($category) {
        $this->category = $category;
    }

    public function collection()
    {
        $country = Country::select('name', 'id', 'slug')->where('name', $this->category)->first();
        $state = State::select('name', 'half_postcode', 'slug')->where('name', $this->category)->first();
        $county = County::select('name', 'half_postcode', 'slug')->where('name', $this->category)->first();
        $city = City::select('name', 'half_postcode', 'slug')->where('name', $this->category)->first();
        $town = Town::select('name', 'half_postcode', 'slug')->where('name', $this->category)->first();
        if (isset($country)) {
            $states = State::select('name', 'half_postcode', 'slug')->where('country', $this->category)->get();
            $counties = County::select('name', 'half_postcode', 'slug')->where('country', $this->category)->get();
            $cities = City::select('name', 'half_postcode', 'slug')->where('country', $this->category)->get();
            $postcodes = Town::select('name', 'half_postcode', 'postcode_url')->where('country', $this->category)->get()->unique('half_postcode');
            $towns = Town::select('name', 'half_postcode', 'slug')->where('country', $this->category)->get();
            return collect([
                $country,
                $states,
                $counties,
                $cities,
                $postcodes,
                $towns
            ]);
        }
        elseif(isset($state)){
            $counties = County::select('name', 'half_postcode', 'slug')->where('state', $this->category)->get();
            $cities = City::select('name', 'half_postcode', 'slug')->where('state', $this->category)->get();
            $postcodes = Town::select('name', 'half_postcode', 'postcode_url')->where('state', $this->category)->get()->unique('half_postcode');
            $towns = Town::select('name', 'half_postcode', 'slug')->where('state', $this->category)->get();
            return collect([
                $state,
                $counties,
                $cities,
                $postcodes,
                $towns
            ]);
        }
        elseif(isset($county)){
            $cities = City::select('name', 'half_postcode', 'slug')->where('county', $this->category)->get();
            $postcodes = Town::select('name', 'half_postcode', 'postcode_url')->where('county', $this->category)->get()->unique('half_postcode');
            $towns = Town::select('name', 'half_postcode', 'slug')->where('county', $this->category)->get();
            return collect([
                $county,
                $cities,
                $postcodes,
                $towns
            ]);
        }
        elseif(isset($city)){
            $postcodes = Town::select('name', 'half_postcode', 'postcode_url')->where('city', $this->category)->get()->unique('half_postcode');
            $towns = Town::select('name', 'half_postcode', 'slug')->where('city', $this->category)->get();
            return collect([
                $city,
                $postcodes,
                $towns
            ]);
        }
        elseif(isset($town)){
            return collect([
                $town
            ]);
        }


//        return Town::select('country_url', 'state_url', 'county_url', 'city_url')->get();
    }
}
