<?php

namespace App\Http\Controllers;

use App\Models\GeoLocation;
use App\Models\State;
use App\Models\District;
use App\Models\City;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class GeoLocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(GeoLocation $geoLocation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GeoLocation $geoLocation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, GeoLocation $geoLocation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GeoLocation $geoLocation)
    {
        //
    }

    public function admin_data_list(Request $request){

        $data = GeoLocation::paginate(10);

        if(!empty($data) && count($data) > 0){

            return view('admin.data_list')->with('lists', $data);

        }
        else{

            $data = '0';

            return view('admin.data_list')->with('lists', $data);

        }

    }


    public function search_form(Request $request){

        $states = State::all();

        return view('user.search_form')->with('states', $states);

    }

    public function search_location(Request $request){

        $request->validate([
            'lot' => 'required',
            'area' => 'required',
            'state' => 'required',
            'district' => 'required',
            'city' => 'required',
        ]);

        $find_location = GeoLocation::where('lot', $request->lot)
                                    ->where('area', $request->area)
                                    ->where('state_id', $request->state)
                                    ->where('district_id', $request->district)
                                    ->where('city_id', $request->city)->first();

        if(!empty($find_location)){

            return response()->json([
                'isSuccess' => true,
                'Message' => "Lokasi dijumpai dalam pangkalan data GeoGeran.",
                'status' => 'success',
                'data' =>  [
                    'latitude' => $find_location->latitude_map, // Use => for key-value pairs
                    'longitude' => $find_location->longitude_map,
                    'notes' => $find_location->notes,
                ],
            ]);

        }
        else{

            return response()->json([
                'isSuccess' => true,
                'Message' => "Lokasi tidak dijumpai dalam pangkalan data GeoGeran.",
                'status' => 'failed',
            ]);

        }

    }

    public function save_location(Request $request){

        $user = Auth::user();

        $request->validate([
            'lot' => 'required',
            'area' => 'required',
            'state' => 'required',
            'district' => 'required',
            'city' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'notes' => 'nullable',
        ]);
        
        $location = new GeoLocation();
        $location->user_id = $user->id;
        $location->lot = $request->lot;
        $location->area = $request->area;
        $location->state_id = $request->state;
        $location->district_id = $request->district;
        $location->city_id = $request->city;
        $location->latitude_map = $request->latitude;
        $location->longitude_map = $request->longitude;
        $location->notes = $request->notes;

        $location->save();

        if($location){

            return response()->json([
                'isSuccess' => true,
                'Message' => "Lokasi berjaya disimpan dalam pangkalan data GeoGeran.",
                'status' => 'success',
            ]);

        }
        else{

            return response()->json([
                'isSuccess' => true,
                'Message' => "Lokasi gagal disimpan dalam pangkalan data GeoGeran.",
                'status' => 'failed',
            ]);

        }

    }

    public function edit_location(string $id){

        $find_location = GeoLocation::findOrFail($id);

        $states = State::all();

        if(!empty($find_location)){

            return view('user.edit_form')->with('location', $find_location)
                                        ->with('states', $states);

        }
        else{

            return redirect()->back()->with('error', 'Lokasi tidak dijumpai dalam pangkalan data GeoGeran.');

        }

    }

    public function update_location(Request $request){

        $request->validate([
            'id' => 'required',
            'lot' => 'required',
            'area' => 'required',
            'state' => 'required',
            'district' => 'required',
            'city' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'notes' => 'required',
        ]);

        $find_location = GeoLocation::findOrFail($request->id);

        if(!empty($find_location)){

            $find_location->update([
                'lot' => $request->lot,
                'area' => $request->area,
                'state_id' => $request->state,
                'district_id' => $request->district,
                'city_id' => $request->city,
                'latitude_map' => $request->latitude,
                'longitude_map' => $request->longitude,
                'notes' => $request->notes,
            ]);

            return redirect()->route('user.dashboard')->with('success', 'Berjaya kemaskini data.');

        }
        else{

            return redirect()->route('user.dashboard')->with('error', 'Gagal kemaskini data.');

        }

    }

}
