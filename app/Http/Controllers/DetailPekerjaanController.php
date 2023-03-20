<?php

namespace App\Http\Controllers;

use App\Models\DetailPekerjaan;
use Illuminate\Http\Request;

class DetailPekerjaanController extends Controller
{

    public function index()
    {
        $data = DetailPekerjaan::all();
        return response()->json($data);
    }


    public function create(Request $request)
    {
        $this->validate($request, [
            'id_pekerjaan' => 'required',
            'nama_pekerjaan' => 'required',
            'desc_pekerjaan' => 'required',
            'jam_kerja' => 'required',
            'tgl_kerja' => 'required',
            'tipe' => 'required',
            
        ]);

        $data = [
            'id_pekerjaan' => $request->input('id_pekerjaan'),
            'nama_pekerjaan' => $request->input('nama_pekerjaan'),
            'desc_pekerjaan' => $request->input('desc_pekerjaan'),
            'jam_kerja' => $request->input('jam_kerja'),
            'tgl_kerja' => $request->input('tgl_kerja'),
            'tipe' => $request->input('tipe')
        ];

        $detailPekerjaan = DetailPekerjaan::create($data);

        if($detailPekerjaan){
            return $this->successAdd($detailPekerjaan);
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
        $data = DetailPekerjaan::where('id',$id)->get();
        return response()->json($data);
    }


    public function edit(DetailPekerjaan $detailPekerjaan)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $detailPekerjaan = DetailPekerjaan::where('id', $id)->update($request->all());

        if($detailPekerjaan){
            return $this->successEdit($detailPekerjaan);
        }else{
            return $this->error("Gagal Merubah Data");
        }
    }


    public function destroy(DetailPekerjaan $detailPekerjaan)
    {
        return response()->json("Berhasil menghapus $detailPekerjaan");
    }


    public function search($namaPekerjaan)
    {
        if($namaPekerjaan){
            return DetailPekerjaan::where("nama_pekerjaan", "like", "%".$namaPekerjaan."%")->get();
        }else{
            return $this->error("Data Tidak Ditemukan");
        }
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


    public function error($message){
        return response()->json([
            'code' => 400,
            'message' => $message
        ], 400);
    }
}
