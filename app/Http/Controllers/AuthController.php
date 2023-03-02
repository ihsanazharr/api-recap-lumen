<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required| unique:users',
            'email' => 'required| unique:users',
            'password' => 'required| min:8',
            'telp' => 'required| unique:users',
            'alamat' => 'required',
            'status' => 'required',
        ]);

        $data = [
            'nama' => $request->input('nama'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'telp' => $request->input('telp'),
            'alamat' => $request->input('alamat'),
            'status' => $request->input('status')
        ];

        $user =  User::create(array_merge($request->all(),[
            'password' => bcrypt($request->password)
        ]));

        if($user){
            $result = [
                'pesan' => 'Registrasi Berhasil',
                'data' => $data
            ];
        }else{
            $result = [
                'pesan' => 'Registrasi Gagal',
                'data' => ''
            ];
        }

        return response()->json($result, 200);
    }

    
    public function login(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        $validasi = Validator::make($request->all(),[
            'email' => 'required',
            'password' => 'required|min:8',
        ]);

        if($validasi->fails()){
            return $this->error($validasi->errors()->first());
        }

        $user = User::where('email', $request->email)->first();
        if($user){
            if(password_verify($request->password, $user->password)){
                 return $this->success($user);
            }else{
                return $this->error("Password anda salah");
            }
        }
        return $this->error("Email atau Password anda salah");
    }


    public function success($data, $message = "Login Berhasil"){
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
