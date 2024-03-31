<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;


class UserController extends Controller
{
    public function saveUser(Request $request){
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ])->post(env('API_BASE_URL') . '/api/register', [
            'name' => $request->name,
            'email' => $request->email,
        ]);
        // saving response in variable
        $result = $response->json();

        // redirection for missing required fields data
        if($response->status()==422){
            Session::flash('message', $result['error']);
            Session::flash('alert-class', 'alert-danger');
            return redirect('/signup');
        }
        // redirection for valid credentials
        if($response->status()==201){
            Session::flash('message', $result['message']);
            Session::flash('alert-class', 'alert-success');
            return redirect('/');
        }




    }
    public function checkLogin(Request $request){
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ])->post(env('API_BASE_URL') . '/api/login', [
            'email' => $request->email,
            'password' => $request->password,
        ]);
        // saving response in variable
        $result = $response->json();

        // redirection for missing required fields data
        if($response->status()==422){
            Session::flash('message', $result['error']);
            Session::flash('alert-class', 'alert-danger');
            return redirect('/');
        }
        // redirection for unauthorized credentials
        if($response->status()==401){
            Session::flash('message', $result['message']);
            Session::flash('alert-class', 'alert-danger');
            return redirect('/');
        }
       // redirection for valid credentials
        if($response->status()==200){
            // get value of access_token and use it in api's
            $token = $result['access_token'];
            $vehicleCount = $result['vehicle_count'];
            Session::put('api_token', $token);
            return view('dashboard',['carCount' => $vehicleCount ]);
        }
    }

    public function logout(Request $request){
        $token = Session::get('api_token');
        // check if user has token
        if($token!='') {
            $token = Session::get('api_token');
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . $token,
            ])->get(env('API_BASE_URL') . '/api/logout');
            // saving response in variable
            $result = $response->json();
            if($response->status()==200){
                Session::flush();
                Session::flash('message',$result['message']);
                Session::flash('alert-class', 'alert-danger');
                return redirect('/');

            }
        }
        else{
            Session::flash('message','Login First');
            Session::flash('alert-class', 'alert-danger');
            return redirect('/');
        }

    }
}
