<?php

namespace App\Exports;

use App\State;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportState implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return State::select('name','slug')->get();
    }
}
