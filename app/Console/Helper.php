<?php

namespace App\Http;

use Illuminate\Support\Str;
use Illuminate\Http\JsonResponse;

trait Helper {
    public function success($data, $message) : JsonResponse 
    {
        $message = "Berhasil!";

        return response()->json([
            'code' => 200,
            'message' => $message,
            'data' => $data
        ], 200);
    }

    public function error($message) : JsonResponse 
    {
        return response()->json([
            'code' => 400,
            'message' => $message
        ], 400);
    }


    public function generateToken()
    {
        $token = Str::random(30);
        
        return $token;  
    }
}