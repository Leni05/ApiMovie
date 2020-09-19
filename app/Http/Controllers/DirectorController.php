<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Director;
use DB;
use Validator;

class DirectorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Director::all();
  
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
        $validator= Validator::make($request->all(),[
            'name' => 'required|min:3|max:255',
            'date_of_birth' => 'required',
            'gender' => 'required|integer',
        ]);

        if($validator->fails()){
            return response()->json([
                'success' => false,
                'status' => 401,
                'error'=>$validator->errors()
            ], 401);
        }

        if($request->input('gender') == 1 ) {
            $gender = "laki-laki";
        } else  if($request->input('gender') == 2 ) {
            $gender = "perempuan";
        } else{
            return response()->json([
                'success' => false,
                'status' => 400,
                'message' => 'check inputan your gender'
            ], 400);
        }
        $data= new Director();
        $data->name=$request->input('name');
        $data->date_of_birth=$request->input('date_of_birth');
        $data->gender=$gender;

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
        $data=Director::where('id',$id)->get();
       
        if(count($data) == 0 ){
            return response()->json([
                'success' => false,
                'status' => 400,
                'message' => 'Director with id ' . $id . ' not found'
            ], 400);
        }else{
            return response()->json([
                'success' => true,
                'status' => 200,
                'message' => $data
            ], 200);
        }
    }

    public function update(Request $request, $id){

        $validator= Validator::make($request->all(),[
            'name' => 'required|min:3|max:255',
            'date_of_birth' => 'required',
            'gender' => 'required|integer',
        ]);

        $data=Director::where('id',$id)->first();
         
        if (empty($data)) {

            // dd('kosong');
            return response()->json([
                'success' => false,
                'status' => 400,
                'message' => 'Director with id ' . $id . ' not found'
            ], 400);
        } 
      

        if($validator->fails()){
            return response()->json([
                'success' => false,
                'status' => 401,
                'error'=>$validator->errors()
            ], 401);
        }
        if($request->input('gender') == 1 ) {           
            $gender = "laki-laki";
        } else  if($request->input('gender') == 2 ) {          
            $gender = "perempuan";
        } else{
            return response()->json([
                'success' => false,
                'status' => 400,
                'message' => 'check inputan your gender'
            ], 400);
        }

        $data->name=$request->input('name');
        $data->date_of_birth=$request->input('date_of_birth');
        $data->gender=$gender;

       
        if($data->save()){
            $res["message"]="Sukses";
            $res["status"]=200;
            $res["value"]=$data;
            return response($res);
        } else{
            $res["status"]=400;
            $res["message"]="Gagal";
            return response($res);
        }
    }
}
