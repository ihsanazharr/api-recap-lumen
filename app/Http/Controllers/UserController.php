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

    public function successAdd($data, $message = "Data Berhasil Ditambah")
    {
        return response()->json([
            'code' => 200,
            'message' => $message,
            'data' => $data
        ]);
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
