<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Gendre;
use DB;
use Validator;

class GendreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd('a');
        $data = Gendre::all();
  
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
        // dd('aaaaaa');
        $validator= Validator::make($request->all(),[
            'name' => 'required',
            'description' => 'required',
        ]);

        if($validator->fails()){
            return response()->json([
                'success' => false,
                'status' => 401,
                'error'=>$validator->errors()
            ], 401);
        }

        $data= new Gendre();
        $data->name=$request->input('name');
        $data->description=$request->input('description');

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

    public function update(Request $request, $id){

        $validator= Validator::make($request->all(),[
            'name' => 'required',
            'description' => 'required',
        ]);
        $data=Gendre::where('id',$id)->first();
         
        if (empty($data)) {

            // dd('kosong');
            return response()->json([
                'success' => false,
                'status' => 400,
                'message' => 'Gendre with id ' . $id . ' not found'
            ], 400);
        } 
      

        if($validator->fails()){
            return response()->json([
                'success' => false,
                'status' => 401,
                'error'=>$validator->errors()
            ], 401);
        }

        $data->name=$request->input('name');
        $data->description=$request->input('description');
       
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
