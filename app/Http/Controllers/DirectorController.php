<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Director;
use DB;

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
        //
        dd('aaaaaa');
        $validator= Validator::make($request->all(),[
            'name' => 'required',
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

        $data= new Director();
        $data->name=$request->input('name');
        $data->date_of_birth=$request->input('date_of_birth');

        if($data->save()){
            $res["message"]="Sukses";
            $res["status"]=200;
            $res["value"]=$data;
            return response($res);

        } else{
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
        $data=Gendre::where('id',$id)->get();
       
        if(count($data) == 0 ){
            // dd('gagakllll');
            return response()->json([
                'success' => false,
                'status' => 400,
                'message' => 'gendre with id ' . $id . ' not found'
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
