<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\PDF;
use App\Models\Employes;
use Illuminate\Http\Request;
use App\Exports\EmployesExport;
use App\Imports\EmployesImport;
use Maatwebsite\Excel\Facades\Excel;

class EmployesController extends Controller
{
    public function index(Request $request){

        if($request->has('search')){
            
            $data= Employes::where('name', 'LIKE', '%' .$request->search. '%')->paginate(5);
        }else{
            $data= Employes::paginate(5);
        }

        return view ('datapegawai', compact(('data')));
    }
    // Sebelum Form Cari Data!
    // public function index(){
    //     $data= Employes::all();
    //     return view ('datapegawai', compact(('data')));
    // }
    public function tambahdata(){
        return view ('tambahdata');
    }

    public function inserdata(Request $request){
        // dd($request->all());
        $data = Employes::create($request->all());
        if ($request->hasFile('foto')){
            $request->file('foto')->move('fotopegawai/', $request->file('foto')->getClientOriginalName());
            $data ->foto = $request->file('foto')->getClientOriginalName();
            $data->save();
        }
        return redirect()->route('pegawai')->with('success', 'Data Berhasil Ditambahkan!');
    }

    public function tampildata($id){
        $data = Employes::find($id);
        // dd($data);
        return view('tampildata',compact('data'));
    }

    public function updatedata(Request $request, $id){
        $data = Employes::find($id);
        $data->update($request->all());

        return redirect()->route('pegawai')->with('success', 'Data Berhasil Update!');
    }

    public function delete($id){
        $data = Employes::find($id);
        $data->delete();

        return redirect()->route('pegawai')->with('success', 'Data Berhasil Delete!');
    }

    public function exportPdf(){
        $data = Employes::all();

        view()->share('data', $data);

        $pdf = PDF::loadview('datapegawai-pdf');
        return $pdf->download('datapegawai.pdf');


    }

    public function exportExcel(){
        return Excel::download(new EmployesExport, 'datapegawai.xlsx');
    }

    public function importExcel(Request $request){
        $data = $request->file('file');
        
        $namafile = $data->getClientOriginalName();

        $data->move('EmployesData', $namafile);

        Excel::import(new EmployesImport, \public_path('/EmployesData/' .$namafile));
        return \redirect()->back();
    }
}
