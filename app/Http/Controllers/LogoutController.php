<?php

namespace App\Http\Controllers;

use Illuminate\Http\Client\Request;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class LogoutController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __invoke(Request $request)
    {
        $removeToken = JWTAuth::invalidate(JWTAuth::getToken());
        if($removeToken){
            return response ()->json([
                'success' => true,
                'message' => 'Logout Berhasil'
            ]);
        }
    }
    

}
