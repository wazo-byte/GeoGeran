<?php

namespace App\Http\Controllers;

use App\Models\District;
use Illuminate\Http\Request;

class DistrictController extends Controller
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
    public function show(District $district)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(District $district)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, District $district)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(District $district)
    {
        //
    }

    public function get_district_list(Request $request){

        $request->validate([
            'state_id' => 'required',
        ]);

        $districts = District::where('state_id', $request->state_id)->get();

        if(!empty($districts) && count($districts) > 0){

            return response()->json([
                'isSuccess' => true,
                'Message' => "Successfully",
                'data' => $districts,
            ]);

        }
        else{

            return response()->json([
                'isSuccess' => false,
                'Message' => "Failed",
            ]);

        }

    }

}
