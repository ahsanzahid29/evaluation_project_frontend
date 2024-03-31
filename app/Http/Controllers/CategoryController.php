<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    public function index(){
        $token = Session::get('api_token');
        // check if user has token
        if($token!=''){
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . $token,
            ])->get(env('API_BASE_URL') . '/api/list-category');

            // saving response in variable
            $result = $response->json();

            // passing categories to view
            if($response->status()==200){
                return view('category.list',['categories' => $result['detail']]);
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
        if($token!=''){
            return view('category.add');
        }
        else{
            Session::flash('message','Login First');
            Session::flash('alert-class', 'alert-danger');
            return redirect('/');
        }
    }
    public function save(Request $request){
        $token = Session::get('api_token');
        // check if user has token
        if($token!=''){
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . $token,
            ])->post(env('API_BASE_URL') . '/api/add-category', [
                'name' => $request->name,
            ]);
            // saving response in variable
            $result = $response->json();

            //redirection to add-category page if validation fails
            if($response->status()==422){
                Session::flash('message', $result['error']);
                Session::flash('alert-class', 'alert-danger');
                return redirect('/add-category');
            }
            // redirection if category added successfully
            if($response->status()==201){
                Session::flash('message', $result['message']);
                Session::flash('alert-class', 'alert-success');
                return redirect('/category');
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
            ])->get(env('API_BASE_URL') . '/api/edit-category/'.$id);

            // saving response in variable
            $result = $response->json();

            // passing categories to view
            if($response->status()==200){
                return view('category.edit',['category' => $result['detail']]);
            }
            // if id does not match
            if($response->status()==404){
                Session::flash('message', $result['message']);
                Session::flash('alert-class', 'alert-danger');
                return redirect('/category');
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
            ])->patch(env('API_BASE_URL') . '/api/update-category', [
                'name' => $request->name,
                'id'   => $request->category_id,
            ]);
            // saving response in variable
            $result = $response->json();

            if($response->status()==422){
                Session::flash('message', $result['error']);
                Session::flash('alert-class', 'alert-danger');
                return redirect('/edit-category/'.$request->category_id);
            }
            // redirection if category updated successfully
            if($response->status()==200){
                Session::flash('message', $result['message']);
                Session::flash('alert-class', 'alert-info');
                return redirect('/category');
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
            ])->get(env('API_BASE_URL') . '/api/delete-category/'.$id);

            // saving response in variable

            $result = $response->json();

            // redirection if category is used in cars table
            if($response->status()==409){
                Session::flash('message', $result['message']);
                Session::flash('alert-class', 'alert-danger');
                return redirect('/category');
            }

            // redirection if category deleted successfully
            if($response->status()==200){
                Session::flash('message', $result['message']);
                Session::flash('alert-class', 'alert-success');
                return redirect('/category');
            }

            // redirection if category id not found or record is deleted
            if($response->status()==404){
                Session::flash('message', $result['message']);
                Session::flash('alert-class', 'alert-danger');
                return redirect('/category');
            }

        }
        else{
            Session::flash('message','Login First');
            Session::flash('alert-class', 'alert-danger');
            return redirect('/');
        }

    }

}
