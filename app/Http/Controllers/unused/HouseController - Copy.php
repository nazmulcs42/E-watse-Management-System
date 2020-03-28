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
        $houses = House::whereBetween('lat',[$lat-0.1,$lat+0.1])->whereBetween('lng',[$lng-0.1,$lng+0.1])->get();

        return $houses;
    }
    public function index()
    {
        
        $results = DB::table('houses')->get();
         return view('map.test', ['results' => $results]);
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
       /* $name = mysql_real_escape_string($_GET['name']);
        $address = mysql_real_escape_string($_GET['address']);
        $lat = mysql_real_escape_string($_GET['lat']);
        $lng = mysql_real_escape_string($_GET['lng']);
        $type = mysql_real_escape_string($_GET['type']);*/

        print_r('houseController@store');
      /*  print_r($request);*/


        $db = new House;
        $db->name = $request->name;
        $db->adress = $request->address;
        $db->type = $request->type;
        $db->lat = $request->lat;
        $db->lng = $request->lng;
         $db->save();

        $db = new House;
        $db->name = 'me';
        $db->adress = 'you';
        $db->type = 'nam';
        $db->lat = 23.2656;
        $db->lng = 89.3256;
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
        //
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
