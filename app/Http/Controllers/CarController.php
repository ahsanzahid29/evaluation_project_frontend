<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class CarController extends Controller
{
    public function index(){
        $token = Session::get('api_token');
        // check if user has token
        if($token!=''){
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . $token,
            ])->get(env('API_BASE_URL') . '/api/list-car');

            // saving response in variable
            $result = $response->json();

            // passing categories to view
            if($response->status()==200){
                return view('cars.list',['cars' => $result['detail']]);
            }
        }
        else{
            Session::flash('message','Login First');
            Session::flash('alert-class', 'alert-danger');
            return redirect('/');
        }
    }

    public function add(){
        $token = Session::get('api_token');
        // check if user has token
        if($token!=''){
            // get categories for dropdown
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . $token,
            ])->get(env('API_BASE_URL') . '/api/list-category');

            // saving response in variable
            $result = $response->json();

            if($response->status()==200){
                return view('cars.add',['categories' => $result['detail']]);
            }

        }
        else{
            Session::flash('message','Login First');
            Session::flash('alert-class', 'alert-danger');
            return redirect('/');
        }

        return view('cars.add');
    }
    public function save(Request $request){
        $token = Session::get('api_token');
        // check if user has token
        if($token!=''){
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . $token,
            ])->post(env('API_BASE_URL') . '/api/add-car', [
                'name'       => $request->name,
                'model'       => $request->model,
                'color'       => $request->color,
                'category_id' => $request->category_id,
            ]);
            // saving response in variable
            $result = $response->json();

            //redirection to add-category page if validation fails
            if($response->status()==422){
                Session::flash('message', $result['error']);
                Session::flash('alert-class', 'alert-danger');
                return redirect('/add-car');
            }
            // redirection if category added successfully
            if($response->status()==201){
                Session::flash('message', $result['message']);
                Session::flash('alert-class', 'alert-success');
                return redirect('/cars');
            }
        }
        else{
            Session::flash('message','Login First');
            Session::flash('alert-class', 'alert-danger');
            return redirect('/');
        }
    }

    public function edit($id){
        $token = Session::get('api_token');
        // check if user has token
        if($token!=''){
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . $token,
            ])->get(env('API_BASE_URL') . '/api/edit-car/'.$id);

            // saving response in variable
            $result = $response->json();

            //get category dropdown

            $responseCategory = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . $token,
            ])->get(env('API_BASE_URL') . '/api/list-category');

            // saving response in variable
            $resultCategory = $responseCategory->json();

            // passing categories to view
            if($response->status()==200){
                return view('cars.edit',['car' => $result['detail'], 'categories' => $resultCategory['detail']]);
            }
            // if id does not match
            if($response->status()==404){
                Session::flash('message', $result['message']);
                Session::flash('alert-class', 'alert-danger');
                return redirect('/cars');
            }

        }
        else{
            Session::flash('message','Login First');
            Session::flash('alert-class', 'alert-danger');
            return redirect('/');
        }
    }

    public function update(Request $request){
        $token = Session::get('api_token');
        // check if user has token
        if($token!=''){
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . $token,
            ])->patch(env('API_BASE_URL') . '/api/update-car', [
                'name'       => $request->name,
                'model'       => $request->model,
                'color'       => $request->color,
                'category_id' => $request->category_id,
                'id'          => $request->car_id
            ]);
            // saving response in variable
            $result = $response->json();

            if($response->status()==422){
                Session::flash('message', $result['error']);
                Session::flash('alert-class', 'alert-danger');
                return redirect('/edit-car/'.$request->car_id);
            }
            // redirection if category updated successfully
            if($response->status()==200){
                Session::flash('message', $result['message']);
                Session::flash('alert-class', 'alert-info');
                return redirect('/cars');
            }
        }
        else{
            Session::flash('message','Login First');
            Session::flash('alert-class', 'alert-danger');
            return redirect('/');
        }
    }

    public function delete($id){
        $token = Session::get('api_token');
        // check if user has token
        if($token!=''){
            $token = Session::get('api_token');
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . $token,
            ])->get(env('API_BASE_URL') . '/api/delete-car/'.$id);

            // saving response in variable

            $result = $response->json();

            // redirection if category deleted successfully
            if($response->status()==200){
                Session::flash('message', $result['message']);
                Session::flash('alert-class', 'alert-success');
                return redirect('/cars');
            }

            // redirection if car id not found or record is deleted
            if($response->status()==404){
                Session::flash('message', $result['message']);
                Session::flash('alert-class', 'alert-danger');
                return redirect('/cars');
            }
       }
        else{
            Session::flash('message','Login First');
            Session::flash('alert-class', 'alert-danger');
            return redirect('/');
        }

    }
}
