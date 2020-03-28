<?php

namespace App\Http\Controllers;

use App\Path;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PathController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function searchPaths(Request $request)
    {
        $lat = $request->lat;
        $lng = $request->lng;
        //print_r($request);
        $paths =DB::table('paths')->get();
        //$houses = House::whereBetween('lat',[$lat-0.1,$lat+0.1])->whereBetween('lng'//,[$lng-0.1,$lng+0.1])->get();

        return $paths;
    }
    public function index()
    {
        
        return view('map.houseLocation');
        /*$results = DB::table('houses')->get();
         return view('house', ['results' => $results]);*/
        /*$results = DB::table('houses')->get();
         return view('house', ['results' => $results]);*/
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('map.path-edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      
        //$request->session()->flush();

        $db = new Path();
        $db->startNode = $request->start_node;
        $db->endNode = $request->end_node;
        $db->encodedstring = $request->encoding;
        
        $db->save();
        
          //return response()->json(['success'=>'Data is successfully added']);
          return $request->expectsJson()
                    ? response()->json(['success' => 'Data is successfully added'])
                    : response()->json(['error' => 'Data is unsuccessfully rejected']);
    

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\House  $house
     * @return \Illuminate\Http\Response
     */
    public function show(Path $path)
    {
        //$results = DB::table('houses')->get();
        // return view('map.houseLocationOutput', ['results' => $results]);
        return view('map.path-show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\House  $house
     * @return \Illuminate\Http\Response
     */
    public function edit(Path $path)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\House  $house
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Path $path)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\House  $house
     * @return \Illuminate\Http\Response
     */
    public function destroy(House $house)
    {
        //
    }
}
