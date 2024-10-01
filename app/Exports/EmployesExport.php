<?php

namespace App\Exports;

use App\Models\Employes;
use Maatwebsite\Excel\Concerns\FromCollection;

class EmployesExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Employes::all();
    }
}
