<?php

namespace App\Http\Controllers;

use App\Models\DetailPekerjaan;
use App\Models\PersonalToken;
use App\Models\User;
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
            'id_user' => 'required',
            'id_pekerjaan' => 'required',
            'nama_pekerjaan' => 'required',
            'desc_pekerjaan' => 'required',
            'jam_kerja' => 'required',
            'tgl_kerja' => 'required',
            'tipe' => 'required',
            
        ]);

        $data = [
            'id_user' => $request->input('id_user'),
            'id_pekerjaan' => $request->input('id_pekerjaan'),
            'nama_pekerjaan' => $request->input('nama_pekerjaan'),
            'desc_pekerjaan' => $request->input('desc_pekerjaan'),
            'jam_kerja' => $request->input('jam_kerja'),
            'tgl_kerja' => $request->input('tgl_kerja'),
            'tipe' => $request->input('tipe'),
        ];

        $detailPekerjaan = DetailPekerjaan::create($data);

        if($detailPekerjaan){
            $token = PersonalToken::where('id_user', 1)->first()->token;
            return response()->json([
                'code' => 200,
                'message' => 'data berhasil ditambah',
                'token' => $token,
                'data'=> $detailPekerjaan
            ]);
            // return $this->successAdd($detailPekerjaan);
        }else{
            return $this->error("Gagal Menambahkan Data");
        }

    }

    public function upload(Request $request, $id)
    {
        $this->validate($request, [
            'bukti_pekerjaan' => 'required'
        ]);

        $image = $request->file('bukti_pekerjaan')->getClientOriginalName();
        $request->file('bukti_pekerjaan')->move('upload', $image);

        $data = [
            'bukti_pekerjaan' => url('upload/' . $image),
        ];

        $detailPekerjaan = DetailPekerjaan::where('id', $id)->update($data);
        

        if(DetailPekerjaan::where('id', $request->id)->firstOrFail()){
            $detailPekerjaan = DetailPekerjaan::where('id', $id)->first();
            
            $result = [
                'code' => 200,
                'message' => 'Data Berhasil Ditambahkan',
                'data' => $detailPekerjaan
            ];
        }else{
            $result = [
                'pesan' => 'Data Tidak Bisa Ditambahkan',
                'data' => []
            ];
        }

        return response()->json($result, 200);

    
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
            // 'token' => $token,
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
