<?php

namespace App\Imports;

use App\Models\Employes;
use Maatwebsite\Excel\Concerns\ToModel;

class EmployesImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Employes([
            //
            'name' => $row[1],
            'jeniskelamin' => $row[2],
            'notelepon' => $row[3],
            'foto' => $row[4]


        ]);
    }
}
