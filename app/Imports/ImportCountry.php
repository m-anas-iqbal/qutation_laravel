<?php

namespace App\Imports;

use App\Country;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Facades\Validator;

class ImportCountry implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
//        Validator::make($rows->toArray(), [
//            '*.0' => 'required|unique:countries,name'
//        ])->validate();

        $country_rows = $rows->unique('name');

        foreach ($rows as $row) {
            $check_value = Country::where('name', $row[0])->first();
            if (!$check_value){
                $slug = env('APP_URL') . '/a/' . $row[0];
                Country::create([
                    'name' => $row[0],
                    'slug' => $slug
                ]);
            }
            else{
                $slug = env('APP_URL') . '/a/' . $row[0];
                $check_value->update([
                    'slug' => $slug
                ]);
            }
        }
    }
}
