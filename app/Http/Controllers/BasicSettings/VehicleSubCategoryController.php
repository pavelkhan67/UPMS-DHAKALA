<?php

namespace App\Http\Controllers\BasicSettings;

use App\Http\Controllers\Controller;
use App\Models\VehicleSubCategory;
use Illuminate\Http\Request;

class VehicleSubCategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.pages.basic.vehicle.subcategory.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pages.basic.vehicle.subcategory.create');
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VehicleSubCategory  $vehicleSubCategory
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('backend.pages.basic.vehicle.subcategory.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VehicleSubCategory  $vehicleSubCategory
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('backend.pages.basic.vehicle.subcategory.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\VehicleSubCategory  $vehicleSubCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VehicleSubCategory  $vehicleSubCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        //
    }
}
