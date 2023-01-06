<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    public function index()
    {

        $Post_api = Http::post('https://qexal.net/api/auth/login', [
           'email'=>'admin@app.com',
           'password'=>'12345678',
           'device_name'=>'android'
        ]);
        if($Post_api){
            return response()->json($Post_api->json());
        }


    }
}
