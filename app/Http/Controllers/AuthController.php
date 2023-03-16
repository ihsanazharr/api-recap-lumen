<?php

namespace App\Http\Controllers;

use App\Models\User;

use Firebase\JWT\JWT;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Firebase\JWT\ExpiredException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // protected function jwt(User $user) {                               
    //     $payload = [                                   
    //     'iss' => "bearer", // Issuer of the token                                   
    //     'sub' => $user->id, // Subject of the token                                   
    //     'iat' => time(), // Time when JWT was issued.                                    
    //     'exp' => time() + 60*60 // Expiration time

    //     return JWT::encode($payload, env('JWT_SECRET'));
    //     ]};

    public function register(Request $request)
    {
        // $validated = $this->validate($request, [
        //     'nama' => 'required| unique:users',
        //     'email' => 'required| unique:users',
        //     'password' => 'required| min:8',
        //     'telp' => 'required| unique:users',
        //     'alamat' => 'required',
        //     'status' => 'required',
        // ]);

        // $user = new User();
        // $user->nama = $validated['nama'];
        // $user->email = $validated['email'];
        // $user->password = Hash::make($validated['password']);
        // $user->telp = $validated['telp'];
        // $user->alamat = $validated['alamat'];
        // $user->status = $validated['status'];
        // $user->save();
        // return response()->json($user, 201);

        $this->validate($request, [
            'nama' => 'required| unique:users',
            'email' => 'required| unique:users',
            'password' => 'required| min:8',
            'telp' => 'required| unique:users',
            'alamat' => 'required',
            'status' => 'required',
        ]);

        $nama = $request->input('nama');
        $email = $request->input('email');
        $password = Hash::make($request->input('password'));
        $telp = $request->input('telp');
        $alamat = $request->input('alamat');
        $status = $request->input('status');

        $register = User::create([
            'nama' => $nama,
            'email' => $email,
            'password' => $password,
            'telp' => $telp,
            'alamat' => $alamat,
            'status' => $status
        ]);

        // $data = [
        //     'nama' => $request->input('nama'),
        //     'email' => $request->input('email'),
        //     'password' => $request->input('password'),
        //     'telp' => $request->input('telp'),
        //     'alamat' => $request->input('alamat'),
        //     'status' => $request->input('status')
        // ];

        // $user =  User::create(array_merge($request->all(),[
        //     'password' => bcrypt($request->password)
        // ]));

        if($register){
            $result = [
                'pesan' => 'Registrasi Berhasil',
                'data' => $register
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
        // $validated = $this->validate($request,[
        //     'email' => 'required| exists:users',
        //     'password' => 'required| min:8'
        // ]);

        // $user = User::where('email', $validated['email'])->first();
        // if (!Hash::check($validated['password'], $user->password)){
        //     return abort(401, "Email atau Password anda salah");
        // }
        // $payload = [
        //     'iat' => intval(microtime(true)),
        //     'exp' => intval(microtime(true)) + (60 * 60 * 1000),
        //     'uid' => $user->id
        // ];
        // $token = JWT::encode($payload, env('JWT_SECRET'));
        // return response()->json(['api_token' => $token]);


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
                $token = Str::random(40);
                $user->update([
                    'api_token' => $token
                ]);
                return response()->json([
                    'message' => 'login berhasil',
                    'token' => $token,
                    'data'=> $user
                ]);
            }
            else{
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

