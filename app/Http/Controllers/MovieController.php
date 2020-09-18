<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Gendre;
use App\Model\Movie;
use App\Model\Actor;
use App\Model\Director;
use DB;
use Validator;

class MovieController extends Controller
{   

   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Movie::with(['director','gendre'])->get();
        // dd($data);
  
        return response()->json([
            'success' => true,
            'status' =>200,
            'data' => $data
        ]);
    }
   
    // return response()->json(['data' => $users]);

    public function show($id)
    {   
        $data = Movie::with(['director','gendre', 'actor'])->where('id',$id)->get();
       
        if(count($data) == 0 ){
            // dd('gagakllll');
            return response()->json([
                'success' => false,
                'status' => 400,
                'message' => 'Actor with id ' . $id . ' not found'
            ], 400);
        }else{
            // dd('success');
            return response()->json([
                'success' => true,
                'status' => 200,
                'message' => $data
            ], 200);
        }
    }

}