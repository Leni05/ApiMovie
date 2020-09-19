<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Gendre;
use App\Model\Movie;
use App\Model\MovieActor;
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
        $data = Movie::with(['director','gendre', 'actor'])->get();
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

    public function store(Request $request)
    {
        $validator= Validator::make($request->all(),[
            'id_genre' => 'required|integer',
            'id_director' => 'required|integer',
            'title' => 'required|min:3|max:225',
            'description' => 'required',
            'year' => 'required|date_format:Y-m-d',
            'duration' => 'required|date_format:H:i:s',
            'actor.*' => 'required',
        ]);

        if($validator->fails()){
            return response()->json([
                'success' => false,
                'status' => 401,
                'error'=>$validator->errors()
            ], 401);
        }
        $director=Director::where('id',$request->input('id_director'))->first();
        $genre=Gendre::where('id',$request->input('id_genre'))->first();
        $actor=$request->input('actor');

        // dd($director);
        if (empty($director)) {
            // dd('aaaa');
            return response()->json([
                'success' => false,
                'status' => 400,
                'message' => 'Director with id ' . $request->input('id_director') . ' not found'
            ], 400);
        } 
        if (empty($genre)) {
            // dd('nbbbb');
            return response()->json([
                'success' => false,
                'status' => 400,
                'message' => 'Genre with id ' . $request->input('id_genre') . ' not found'
            ], 400);
        } 
        DB::beginTransaction();
        try {

            $data= new Movie();
            $data->id_genre=$request->input('id_genre');
            $data->id_director=$request->input('id_director');
            $data->title=$request->input('title');
            $data->description=$request->input('description');
            $data->year=$request->input('year');
            $data->duration=$request->input('duration');
            $data->save();
            // dd($data->id);
    
            
            foreach ($actor as $i => $item) {
                // dd($request->input('actor')[$i]);
                $actorid=actor::where('id',$request->input('actor')[$i])->first();
                if (empty($actorid)) {
                    // dd('nbbbb');
                    return response()->json([
                        'success' => false,
                        'status' => 400,
                        'message' => 'Actor with id ' . $request->input('actor')[$i]. ' not found'
                    ], 400);
                } else {
                    $actor= new MovieActor();
                    $actor->movie_id=$data->id;
                    $actor->actor_id=$request->input('actor')[$i];
                    $actor->save();     
                }                        
               
            }
            DB::commit();
            $data = Movie::with(['director','gendre', 'actor'])->where('id',$data->id)->get();

            $res["message"]="Sukses";
            $res["status"]=200;
            $res["value"]=$data;
            return response($res);           
    
        } catch (Exception $e) {
            DB::rollBack();

            $res["status"]=400;
            $res["message"]="Gagal";
            return response($res);
        }

    }


    public function update(Request $request, $id)
    {
        $validator= Validator::make($request->all(),[
            'id_genre' => 'required|integer',
            'id_director' => 'required|integer',
            'title' => 'required|min:3|max:225',
            'description' => 'required',
            'year' => 'required|date_format:Y-m-d',
            'duration' => 'required|date_format:H:i:s',
            'actor.*' => 'required',
        ]);

        $data=Movie::where('id',$id)->first();
         
        if (empty($data)) {
            return response()->json([
                'success' => false,
                'status' => 400,
                'message' => 'Movie with id ' . $id . ' not found'
            ], 400);
        } 
        if($validator->fails()){
            return response()->json([
                'success' => false,
                'status' => 401,
                'error'=>$validator->errors()
            ], 401);
        }
        $director=Director::where('id',$request->input('id_director'))->first();
        $genre=Gendre::where('id',$request->input('id_genre'))->first();
        $actor=$request->input('actor');

        // dd($director);
        if (empty($director)) {
            // dd('aaaa');
            return response()->json([
                'success' => false,
                'status' => 400,
                'message' => 'Director with id ' . $request->input('id_director') . ' not found'
            ], 400);
        } 
        if (empty($genre)) {
            // dd('nbbbb');
            return response()->json([
                'success' => false,
                'status' => 400,
                'message' => 'Genre with id ' . $request->input('id_genre') . ' not found'
            ], 400);
        } 
        DB::beginTransaction();
        try {

            $data->id_genre=$request->input('id_genre');
            $data->id_director=$request->input('id_director');
            $data->title=$request->input('title');
            $data->description=$request->input('description');
            $data->year=$request->input('year');
            $data->duration=$request->input('duration');
            $data->save();
            // dd($data->id);
    
            
            foreach ($actor as $i => $item) {
                // dd($request->input('actor')[$i]);
                $actorid=actor::where('id',$request->input('actor')[$i])->first();
                if (empty($actorid)) {
                    // dd('nbbbb');
                    return response()->json([
                        'success' => false,
                        'status' => 400,
                        'message' => 'Actor with id ' . $request->input('actor')[$i]. ' not found'
                    ], 400);
                } else {
                    $actor= new MovieActor();
                    $actor->movie_id=$data->id;
                    $actor->actor_id=$request->input('actor')[$i];
                    $actor->save();     
                }                        
               
            }
            DB::commit();
            $data = Movie::with(['director','gendre', 'actor'])->where('id',$data->id)->get();

            $res["message"]="Sukses";
            $res["status"]=200;
            $res["value"]=$data;
            return response($res);           
    
        } catch (Exception $e) {
            DB::rollBack();

            $res["status"]=400;
            $res["message"]="Gagal";
            return response($res);
        }


    }

}