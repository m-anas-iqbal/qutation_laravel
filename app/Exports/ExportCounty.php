<?php

namespace App\Exports;

use App\County;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportCounty implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return County::select('name','slug')->get();
    }
}
