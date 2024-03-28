<?php

namespace App\Exports;

use App\Town;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportData implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Town::select('country', 'state', 'county', 'city', 'name', 'postcode', 'latitude', 'longitude', 'wik_url')->get();
    }
}
