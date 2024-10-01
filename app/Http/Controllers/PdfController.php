<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use Barryvdh\DomPDF\Facade as PDF;


class PdfController extends Controller
{
    public function downloadPdf(){
        $data =[];

        $pdf = PDF::loadView('pdf.view', $data);
        return $pdf->download('nama-file.pdf');


    }
    //
}
