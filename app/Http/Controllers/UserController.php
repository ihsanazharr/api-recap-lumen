<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $data = User::all();
        return response()->json($data);
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        $data = User::where('id',$id)->get();
        return response()->json($data);
    }


    public function edit(User $user)
    {
        //
    }

    public function upload(Request $request, $id)
    {
        $this->validate($request, [
            'image' => 'required'
        ]);

        $image = $request->file('image')->getClientOriginalName();
        $request->file('image')->move('upload', $image);

        $data = [
            'image' => url('upload/' . $image)
        ];

        $user = User::where('id', $id)->update($data);

        if($user){
            $result = [
                'pesan' => 'Data Berhasil Ditambahkan',
                'data' => $data
            ];
        }else{
            $result = [
                'pesan' => 'Data Tidak Bisa Ditambahkan',
                'data' => ''
            ];
        }

        return response()->json($result, 200);

    
    }


    public function update(Request $request, $id)
    {
        $user = User::where('id', $id)->update($request->all());

        if($user){
            return $this->successEdit($user);
        }else{
            return $this->error('Gagal merubah data');
        }
    }

 
    public function destroy(User $user)
    {
        return response()->json("Berhasil menghapus $user");
    }

    public function search($nama)
    {
        return User::where("nama", "like", "%".$nama."%")->get();
    }


    public function successShow($data)
    {
        return response()->json([
            'code' => 200,
            'data' => $data
        ]);
    }

    public function successEdit($data, $message = "Data Berhasil Dirubah")
    {
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
