<?php

namespace App\Http\Controllers;

use App\Models\Pekerjaan;
use Illuminate\Http\Request;

class PekerjaanController extends Controller
{

    public function index()
    {
        $data = Pekerjaan::all();
        return response()->json($data);
    }


    public function create(Request $request)
    {
        $this->validate($request, [
            'id_user' => 'required',
            'bulan' => 'required',
            'jam_toleransi' => 'required| numeric',
            'total_jam' => 'required| numeric'
        ]);

        $data = [
            'id_user' => $request->input('id_user'),
            'bulan' => $request->input('bulan'),
            'jam_toleransi' => $request->input('jam_toleransi'),
            'total_jam' => $request->input('total_jam')
        ];

        $pekerjaan = Pekerjaan::create($data);

        if($pekerjaan){
            return $this->successAdd($pekerjaan);
        }else{
            return $this->error("Gagal Menambahkan Data");
        }
    }


    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        $data = Pekerjaan::where('id',$id)->get();
        
        if($data){
            return $this->successShow($data);
        }else{
            return $this->error('Gagal menampilkan data');
        }
    }

  
    public function edit(Pekerjaan $pekerjaan)
    {
        //
    }

  
    public function update(Request $request, $id)
    {
        Pekerjaan::where('id', $id)->update($request->all());
        return response()->json('Data Berhasil Diubah');
    }


    public function destroy(Pekerjaan $pekerjaan)
    {
        return response()->json("Berhasil menghapus $pekerjaan");
    }


    public function search($bulan)
    {
        return Pekerjaan::where("bulan", "like", "%".$bulan."%")->get();
    }


    public function successAdd($data, $message = "Data Berhasil Ditambah"){
        return response()->json([
            'code' => 200,
            'message' => $message,
            'data' => $data
        ]);
    }


    public function successShow($data){
        return response()->json([
            'code' => 200,
            'data' => $data
        ]);
    }


    public function successEdit($data, $message = "Data Berhasil Dirubah"){
        return response()->json([
            'code' => 200,
            'message' => $message,
            'data' => $data
        ]);
    }


    public function error($message = "Gagal"){
        return response()->json([
            'code' => 400,
            'message' => $message
        ], 400);

    }
}
