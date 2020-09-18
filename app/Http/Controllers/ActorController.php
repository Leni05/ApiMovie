<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Actor;
use DB;
use Validator;

class ActorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Actor::all();
  
        return response()->json([
            'success' => true,
            'status' =>200,
            'data' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        dd('aaaaaa');
        $validator= Validator::make($request->all(),[
            'name' => 'required|min:3|max:255',
            'date_of_birth' => 'required',
            'gender' => 'required',
        ]);

        if($validator->fails()){
            return response()->json([
                'success' => false,
                'status' => 401,
                'error'=>$validator->errors()
            ], 401);
        }

        $data= new Actor();
        $data->name=$request->input('name');
        $data->date_of_birth=$request->input('date_of_birth');
        $data->gender=$request->input('gender');

        if($data->gender == 1 ) {
            $gender = "laki-laki";
        } else  if($data->gender == 2 ) {
            $gender = "perempuan";
        } else{
            return response()->json([
                'success' => false,
                'status' => 400,
                'message' => 'check inputan your gender'
            ], 400);
        }

        if($data->save()){
            $res["message"]="Sukses";
            $res["status"]=200;
            $res["value"]=$data;
            return response($res);

        } else {
             $res["message"]="Gagal";
            $res["status"]=400;
            return response($res);
        }
    
    }

      /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
        //
        $data=Actor::where('id',$id)->get();
       
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
