<?php

namespace App\Imports;

use App\County;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Facades\Validator;

class ImportCounty implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $rows)
    {

//        foreach ($rows as $row) {
//
//            //county
//            $check_row_county = County::where([
//                ['country', $row[0]],
//                ['state', $row[1]]
//            ])->first();
//
//            if (isset($check_row_county)) {
//                $check_row_county->update([
//                    'state' => $row[2]
//                ]);
//            }
//
//            else {
//
//                $check_value = County::where([
//                    ['country', $row[0]],
//                    ['state', $row[1]],
//                    ['state', $row[2]]
//                ])->first();
//                if (!$check_value) {
//                    $slug = env('APP_URL') . '/traders/' . $row[2];
//                    County::create([
//                        'country' => $row[0],
//                        'state' => $row[1],
//                        'state' => $row[2],
//                        'slug' => $slug
//                    ]);
//                }
//            }
//        }



        $counties = County::all();
        if (count($counties) > 0) {
            foreach ($rows as $row) {
                $slug = env('APP_URL') . '/a/' . $row[0] .'/'. $row[1] .'/'. $row[2];

                //country-state
                $country_state = County::where([
                    ['country', $row[0]],
                    ['state', $row[1]],
                ])->first();


                //country-county
                $country_county = County::where([
                    ['country', $row[0]],
                    ['name', $row[2]],
                ])->first();


                //country-city
                $country_city = County::where([
                    ['country', $row[0]],
                    ['city', $row[3]],
                ])->first();

                //country-town
                $country_town = County::where([
                    ['country', $row[0]],
                    ['town', $row[4]],
                ])->first();

                //country-postcode
                $country_postcode = County::where([
                    ['country', $row[0]],
                    ['postcode', $row[5]],
                ])->first();

                //country-latitude
                $country_latitude = County::where([
                    ['country', $row[0]],
                    ['latitude', $row[6]],
                ])->first();

                //country-longitude
                $country_longitude = County::where([
                    ['country', $row[0]],
                    ['longitude', $row[7]],
                ])->first();

                //country-wik_url
                $country_wik_url = County::where([
                    ['country', $row[0]],
                    ['wik_url', $row[8]],
                ])->first();

                //country-state-county
                $country_state_county = County::where([
                    ['country', $row[0]],
                    ['state', $row[1]],
                    ['name', $row[2]],
                ])->first();

                //country-state-city
                $country_state_city = County::where([
                    ['country', $row[0]],
                    ['state', $row[1]],
                    ['city', $row[3]],
                ])->first();

                //country-state-town
                $country_state_town = County::where([
                    ['country', $row[0]],
                    ['state', $row[1]],
                    ['town', $row[4]],
                ])->first();

                //country-state-postcode
                $country_state_postcode = County::where([
                    ['country', $row[0]],
                    ['state', $row[1]],
                    ['postcode', $row[5]],
                ])->first();

                //country-state-latitude
                $country_state_latitude = County::where([
                    ['country', $row[0]],
                    ['state', $row[1]],
                    ['latitude', $row[6]],
                ])->first();

                //country-state-longitude
                $country_state_longitude = County::where([
                    ['country', $row[0]],
                    ['state', $row[1]],
                    ['longitude', $row[7]],
                ])->first();

                //country-state-wik_url
                $country_state_wik_url = County::where([
                    ['country', $row[0]],
                    ['state', $row[1]],
                    ['wik_url', $row[8]],
                ])->first();

                //country-state-county-city
                $country_state_county_city = County::where([
                    ['country', $row[0]],
                    ['state', $row[1]],
                    ['name', $row[2]],
                    ['city', $row[3]],
                ])->first();

                //country-state-county-town
                $country_state_county_town = County::where([
                    ['country', $row[0]],
                    ['state', $row[1]],
                    ['name', $row[2]],
                    ['town', $row[4]],
                ])->first();

                //country-state-county-postcode
                $country_state_county_postcode = County::where([
                    ['country', $row[0]],
                    ['state', $row[1]],
                    ['name', $row[2]],
                    ['postcode', $row[5]],
                ])->first();

                //country-state-county-latitude
                $country_state_county_latitude = County::where([
                    ['country', $row[0]],
                    ['state', $row[1]],
                    ['name', $row[2]],
                    ['latitude', $row[6]],
                ])->first();

                //country-state-county-longitude
                $country_state_county_longitude = County::where([
                    ['country', $row[0]],
                    ['state', $row[1]],
                    ['name', $row[2]],
                    ['longitude', $row[7]],
                ])->first();


                //country-state-county-wik_url
                $country_state_county_wik_url = County::where([
                    ['country', $row[0]],
                    ['state', $row[1]],
                    ['name', $row[2]],
                    ['wik_url', $row[8]],
                ])->first();


                //country-state-county-city-town
                $country_state_county_city_town = County::where([
                    ['country', $row[0]],
                    ['state', $row[1]],
                    ['name', $row[2]],
                    ['city', $row[3]],
                    ['town', $row[4]],
                ])->first();

                //country-state-county-city-postcode
                $country_state_county_city_postcode = County::where([
                    ['country', $row[0]],
                    ['state', $row[1]],
                    ['name', $row[2]],
                    ['city', $row[3]],
                    ['postcode', $row[5]],
                ])->first();

                //country-state-county-city-latitude
                $country_state_county_city_latitude = County::where([
                    ['country', $row[0]],
                    ['state', $row[1]],
                    ['name', $row[2]],
                    ['city', $row[3]],
                    ['latitude', $row[6]],
                ])->first();

                //country-state-county-city-longitude
                $country_state_county_city_longitude = County::where([
                    ['country', $row[0]],
                    ['state', $row[1]],
                    ['name', $row[2]],
                    ['city', $row[3]],
                    ['longitude', $row[7]],
                ])->first();

                //country-state-county-city-wik_url
                $country_state_county_city_wik_url = County::where([
                    ['country', $row[0]],
                    ['state', $row[1]],
                    ['name', $row[2]],
                    ['city', $row[3]],
                    ['wik_url', $row[8]],
                ])->first();


                //country-state-county-city-town-postcode
                $country_state_county_city_town_postcode = County::where([
                    ['country', $row[0]],
                    ['state', $row[1]],
                    ['name', $row[2]],
                    ['city', $row[3]],
                    ['town', $row[4]],
                    ['postcode', $row[5]],
                ])->first();

                //country-state-county-city-town-latitude
                $country_state_county_city_town_latitude = County::where([
                    ['country', $row[0]],
                    ['state', $row[1]],
                    ['name', $row[2]],
                    ['city', $row[3]],
                    ['town', $row[4]],
                    ['latitude', $row[6]],
                ])->first();

                //country-state-county-city-town-longitude
                $country_state_county_city_town_longitude = County::where([
                    ['country', $row[0]],
                    ['state', $row[1]],
                    ['name', $row[2]],
                    ['city', $row[3]],
                    ['town', $row[4]],
                    ['longitude', $row[7]],
                ])->first();

                //country-state-county-city-town-wik_url
                $country_state_county_city_town_wik_url = County::where([
                    ['country', $row[0]],
                    ['state', $row[1]],
                    ['name', $row[2]],
                    ['city', $row[3]],
                    ['town', $row[4]],
                    ['wik_url', $row[8]],
                ])->first();

                //country-state-county-city-town-postcode-latitude
                $country_state_county_city_postcode_latitude = County::where([
                    ['country', $row[0]],
                    ['state', $row[1]],
                    ['name', $row[2]],
                    ['city', $row[3]],
                    ['town', $row[4]],
                    ['postcode', $row[5]],
                    ['latitude', $row[6]],
                ])->first();

                //country-state-county-city-town-postcode-longitude
                $country_state_county_city_postcode_longitude = County::where([
                    ['country', $row[0]],
                    ['state', $row[1]],
                    ['name', $row[2]],
                    ['city', $row[3]],
                    ['town', $row[4]],
                    ['postcode', $row[5]],
                    ['longitude', $row[7]]
                ])->first();

                //country-state-county-city-town-postcode-wik_url
                $country_state_county_city_postcode_wik_url = County::where([
                    ['country', $row[0]],
                    ['state', $row[1]],
                    ['name', $row[2]],
                    ['city', $row[3]],
                    ['town', $row[4]],
                    ['postcode', $row[5]],
                    ['wik_url', $row[8]]
                ])->first();

                //country-state-county-city-town-postcode-latitude-longitude
                $country_state_county_city_postcode_latitude_longitude = County::where([
                    ['country', $row[0]],
                    ['state', $row[1]],
                    ['name', $row[2]],
                    ['city', $row[3]],
                    ['town', $row[4]],
                    ['postcode', $row[5]],
                    ['latitude', $row[6]],
                    ['longitude', $row[7]]
                ])->first();

                //country-state-county-city-town-postcode-latitude-wik_url
                $country_state_county_city_postcode_latitude_wik_url = County::where([
                    ['country', $row[0]],
                    ['state', $row[1]],
                    ['name', $row[2]],
                    ['city', $row[3]],
                    ['town', $row[4]],
                    ['postcode', $row[5]],
                    ['latitude', $row[6]],
                    ['wik_url', $row[8]]
                ])->first();

                //country-state-county-city-town-postcode-longitude-wik_url
                $country_state_county_city_postcode_longitude_wik_url = County::where([
                    ['country', $row[0]],
                    ['state', $row[1]],
                    ['name', $row[2]],
                    ['city', $row[3]],
                    ['town', $row[4]],
                    ['postcode', $row[5]],
                    ['longitude', $row[7]],
                    ['wik_url', $row[8]]
                ])->first();


//            if (isset($check_row)){
//                $check_row->update([
//                    'postcode' => $row[5],
//                    'latitude' => $row[6],
//                    'longitude' => $row[7],
//                    'wik_url' => $row[8]
//                ]);
//            }
//            elseif (isset($check_row_county)){
//                $check_row_county->update([
//                    'name' => $row[2],
//                    'postcode' => $row[5],
//                    'latitude' => $row[6],
//                    'longitude' => $row[7],
//                    'wik_url' => $row[8]
//                ]);
//            }
//            elseif (isset($check_row_city)){
//                $check_row_city->update([
//                    'city' => $row[3],
//                    'postcode' => $row[5],
//                    'latitude' => $row[6],
//                    'longitude' => $row[7],
//                    'wik_url' => $row[8]
//                ]);
//            }

                //// country multiple

//7

                if (isset($country_state_county_city_postcode_latitude_longitude)) {
                    $country_state_county_city_postcode_latitude_longitude->update([
                        'wik_url' => $row[8],
                        'slug' => $slug
                    ]);
                } elseif (isset($country_state_county_city_postcode_latitude_wik_url)) {
                    $country_state_county_city_postcode_latitude_wik_url->update([
                        'longitude' => $row[7],
                        'slug' => $slug
                    ]);
                } elseif (isset($country_state_county_city_postcode_longitude_wik_url)) {
                    $country_state_county_city_postcode_longitude_wik_url->update([
                        'latitude' => $row[6],
                        'slug' => $slug
                    ]);
                } //6


                elseif (isset($country_state_county_city_town_postcode)) {
                    $country_state_county_city_town_postcode->update([
                        'latitude' => $row[6],
                        'longitude' => $row[7],
                        'wik_url' => $row[8],
                        'slug' => $slug
                    ]);
                } elseif (isset($country_state_county_city_town_latitude)) {
                    $country_state_county_city_town_latitude->update([
                        'postcode' => $row[5],
                        'longitude' => $row[7],
                        'wik_url' => $row[8],
                        'slug' => $slug
                    ]);
                } elseif (isset($country_state_county_city_town_longitude)) {
                    $country_state_county_city_town_longitude->update([
                        'postcode' => $row[5],
                        'latitude' => $row[6],
                        'wik_url' => $row[8],
                        'slug' => $slug
                    ]);
                } elseif (isset($country_state_county_city_town_wik_url)) {
                    $country_state_county_city_town_wik_url->update([
                        'postcode' => $row[5],
                        'latitude' => $row[6],
                        'longitude' => $row[7]
                    ]);
                } elseif (isset($country_state_county_city_postcode_latitude)) {
                    $country_state_county_city_postcode_latitude->update([
                        'longitude' => $row[7],
                        'wik_url' => $row[8],
                        'slug' => $slug
                    ]);
                } elseif (isset($country_state_county_city_postcode_longitude)) {
                    $country_state_county_city_postcode_longitude->update([
                        'latitude' => $row[6],
                        'wik_url' => $row[8],
                    ]);
                } elseif (isset($country_state_county_city_postcode_wik_url)) {
                    $country_state_county_city_postcode_wik_url->update([
                        'latitude' => $row[6],
                        'longitude' => $row[7],
                        'slug' => $slug
                    ]);
                } // 5


                elseif (isset($country_state_county_city_town)) {
                    $country_state_county_city_town->update([
                        'postcode' => $row[5],
                        'latitude' => $row[6],
                        'longitude' => $row[7],
                        'wik_url' => $row[8],
                        'slug' => $slug
                    ]);
                } elseif (isset($country_state_county_city_postcode)) {
                    $country_state_county_city_postcode->update([
                        'town' => $row[4],
                        'latitude' => $row[6],
                        'longitude' => $row[7],
                        'wik_url' => $row[8],
                        'slug' => $slug
                    ]);
                } elseif (isset($country_state_county_city_latitude)) {
                    $country_state_county_city_latitude->update([
                        'town' => $row[4],
                        'postcode' => $row[5],
                        'longitude' => $row[7],
                        'wik_url' => $row[8],
                        'slug' => $slug
                    ]);
                } elseif (isset($country_state_county_city_longitude)) {
                    $country_state_county_city_longitude->update([
                        'town' => $row[4],
                        'postcode' => $row[5],
                        'latitude' => $row[6],
                        'wik_url' => $row[8],
                        'slug' => $slug
                    ]);
                } elseif (isset($country_state_county_city_wik_url)) {
                    $country_state_county_city_wik_url->update([
                        'town' => $row[4],
                        'postcode' => $row[5],
                        'latitude' => $row[6],
                        'longitude' => $row[7],
                        'slug' => $slug
                    ]);
                } // 4


                elseif (isset($country_state_county_city)) {
                    $country_state_county_city->update([
                        'town' => $row[4],
                        'postcode' => $row[5],
                        'latitude' => $row[6],
                        'longitude' => $row[7],
                        'wik_url' => $row[8],
                        'slug' => $slug
                    ]);
                } elseif (isset($country_state_county_town)) {
                    $country_state_county_town->update([
                        'city' => $row[3],
                        'postcode' => $row[5],
                        'latitude' => $row[6],
                        'longitude' => $row[7],
                        'wik_url' => $row[8],
                        'slug' => $slug
                    ]);
                } elseif (isset($country_state_county_postcode)) {
                    $country_state_county_postcode->update([
                        'city' => $row[3],
                        'town' => $row[4],
                        'latitude' => $row[6],
                        'longitude' => $row[7],
                        'wik_url' => $row[8],
                        'slug' => $slug
                    ]);
                } elseif (isset($country_state_county_latitude)) {
                    $country_state_county_latitude->update([
                        'city' => $row[3],
                        'town' => $row[4],
                        'postcode' => $row[5],
                        'longitude' => $row[7],
                        'wik_url' => $row[8],
                        'slug' => $slug
                    ]);
                } elseif (isset($country_state_county_longitude)) {
                    $country_state_county_longitude->update([
                        'city' => $row[3],
                        'town' => $row[4],
                        'postcode' => $row[5],
                        'latitude' => $row[6],
                        'wik_url' => $row[8],
                        'slug' => $slug
                    ]);
                } elseif (isset($country_state_county_wik_url)) {
                    $country_state_county_wik_url->update([
                        'city' => $row[3],
                        'town' => $row[4],
                        'postcode' => $row[5],
                        'latitude' => $row[6],
                        'longitude' => $row[7],
                        'slug' => $slug
                    ]);
                } // 3


                elseif (isset($country_state_county)) {
                    $country_state_county->update([
                        'city' => $row[3],
                        'town' => $row[4],
                        'postcode' => $row[5],
                        'latitude' => $row[6],
                        'longitude' => $row[7],
                        'wik_url' => $row[8],
                        'slug' => $slug
                    ]);
                } elseif (isset($country_state_city)) {
                    $country_state_city->update([
                        'name' => $row[2],
                        'town' => $row[4],
                        'postcode' => $row[5],
                        'latitude' => $row[6],
                        'longitude' => $row[7],
                        'wik_url' => $row[8],
                        'slug' => $slug
                    ]);
                } elseif (isset($country_state_town)) {
                    $country_state_town->update([
                        'name' => $row[2],
                        'city' => $row[3],
                        'postcode' => $row[5],
                        'latitude' => $row[6],
                        'longitude' => $row[7],
                        'wik_url' => $row[8],
                        'slug' => $slug
                    ]);
                } elseif (isset($country_state_postcode)) {
                    $country_state_postcode->update([
                        'name' => $row[2],
                        'city' => $row[3],
                        'town' => $row[4],
                        'latitude' => $row[6],
                        'longitude' => $row[7],
                        'wik_url' => $row[8],
                        'slug' => $slug
                    ]);
                } elseif (isset($country_state_latitude)) {
                    $country_state_latitude->update([
                        'name' => $row[2],
                        'city' => $row[3],
                        'town' => $row[4],
                        'postcode' => $row[5],
                        'longitude' => $row[7],
                        'wik_url' => $row[8],
                        'slug' => $slug
                    ]);
                } elseif (isset($country_state_longitude)) {
                    $country_state_longitude->update([
                        'name' => $row[2],
                        'city' => $row[3],
                        'town' => $row[4],
                        'postcode' => $row[5],
                        'latitude' => $row[6],
                        'wik_url' => $row[8],
                        'slug' => $slug
                    ]);
                } elseif (isset($country_state_wik_url)) {
                    $country_state_wik_url->update([
                        'name' => $row[2],
                        'city' => $row[3],
                        'town' => $row[4],
                        'postcode' => $row[5],
                        'latitude' => $row[6],
                        'longitude' => $row[7],
                        'slug' => $slug
                    ]);
                } // 2

                elseif (isset($country_state)) {
                    $country_state->update([
                        'name' => $row[2],
                        'city' => $row[3],
                        'town' => $row[4],
                        'postcode' => $row[5],
                        'latitude' => $row[6],
                        'longitude' => $row[7],
                        'wik_url' => $row[8],
                        'slug' => $slug
                    ]);
                } //.
                elseif (isset($country_county)) {
                    $country_county->update([
                        'state' => $row[1],
                        'name' => $row[2],
                        'city' => $row[3],
                        'postcode' => $row[5],
                        'latitude' => $row[6],
                        'longitude' => $row[7],
                        'wik_url' => $row[8],
                        'slug' => $slug
                    ]);
                } elseif (isset($country_city)) {
                    $country_city->update([
                        'state' => $row[1],
                        'name' => $row[2],
                        'postcode' => $row[5],
                        'latitude' => $row[6],
                        'longitude' => $row[7],
                        'wik_url' => $row[8],
                        'slug' => $slug
                    ]);
                } elseif (isset($country_town)) {
                    $country_town->update([
                        'state' => $row[1],
                        'name' => $row[2],
                        'city' => $row[3],
                        'postcode' => $row[5],
                        'latitude' => $row[6],
                        'longitude' => $row[7],
                        'wik_url' => $row[8],
                        'slug' => $slug
                    ]);
                } elseif (isset($country_postcode)) {
                    $country_postcode->update([
                        'state' => $row[1],
                        'name' => $row[2],
                        'city' => $row[3],
                        'town' => $row[4],
                        'latitude' => $row[6],
                        'longitude' => $row[7],
                        'wik_url' => $row[8],
                        'slug' => $slug
                    ]);
                } elseif (isset($country_latitude)) {
                    $country_latitude->update([
                        'state' => $row[1],
                        'name' => $row[2],
                        'city' => $row[3],
                        'town' => $row[4],
                        'postcode' => $row[5],
                        'longitude' => $row[7],
                        'wik_url' => $row[8],
                        'slug' => $slug
                    ]);
                } elseif (isset($country_longitude)) {
                    $country_longitude->update([
                        'state' => $row[1],
                        'name' => $row[2],
                        'city' => $row[3],
                        'town' => $row[4],
                        'postcode' => $row[5],
                        'latitude' => $row[6],
                        'wik_url' => $row[8],
                        'slug' => $slug
                    ]);
                } elseif (isset($country_wik_url)) {
                    $country_wik_url->update([
                        'state' => $row[1],
                        'name' => $row[2],
                        'city' => $row[3],
                        'town' => $row[4],
                        'postcode' => $row[5],
                        'latitude' => $row[6],
                        'longitude' => $row[7],
                        'slug' => $slug
                    ]);
                } else {
                    County::create([
                        'country' => $row[0],
                        'state' => $row[1],
                        'name' => $row[2],
                        'city' => $row[3],
                        'town' => $row[4],
                        'postcode' => $row[5],
                        'latitude' => $row[6],
                        'longitude' => $row[7],
                        'wik_url' => $row[8],
                        'slug' => $slug
                    ]);
                }
            }
        }
        else{

            foreach ($rows as $row) {
                $check_value = County::where('name', $row[2])->first();
                if (!$check_value){
                    $slug = env('APP_URL') . '/a/' . $row[0] .'/'. $row[1] .'/'. $row[2];


                    $p = '';
                    if (isset($row[5])) {
                        $p = explode(" ", $row[5]);
                        $p[0];
                    }

                County::create([
                    'country' => $row[0],
                    'state' => $row[1],
                    'name' => $row[2],
                    'city' => $row[3],
                    'town' => $row[4],
                    'postcode' => $row[5],
                    'half_postcode' => $p[0],
                    'latitude' => $row[6],
                    'longitude' => $row[7],
                    'wik_url' => $row[8],
                    'slug' => $slug
                ]);
            }
            }
        }

    }
}
