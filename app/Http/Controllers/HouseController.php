<?php

namespace App\Http\Controllers;

use App\House;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class HouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function searchHouses(Request $request)
    {
        $lat = $request->lat;
        $lng = $request->lng;
        //print_r($request);
        $houses =DB::table('houses')->get();
        //$houses = House::whereBetween('lat',[$lat-0.1,$lat+0.1])->whereBetween('lng'//,[$lng-0.1,$lng+0.1])->get();

        return $houses;
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
        return view('map.houseLocationInput');
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

        $db = new House();
        $db->name = $request->name;
        $db->adress = $request->address;
        $db->type = $request->type;
        $db->lat = $request->lat;
        $db->lng = $request->lng;
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
    public function show(House $house)
    {
        //$results = DB::table('houses')->get();
        // return view('map.houseLocationOutput', ['results' => $results]);
        return view('map.houseLocationOutput');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\House  $house
     * @return \Illuminate\Http\Response
     */
    public function edit(House $house)
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
    public function update(Request $request, House $house)
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
