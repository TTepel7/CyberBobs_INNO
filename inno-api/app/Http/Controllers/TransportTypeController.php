<?php

namespace App\Http\Controllers;

use App\Models\Transport_type;
use Illuminate\Http\Request;

class TransportTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Transport_type::all();
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transport_type  $transport_type
     * @return \Illuminate\Http\Response
     */
    public function show(Transport_type $transport_type)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transport_type  $transport_type
     * @return \Illuminate\Http\Response
     */
    public function edit(Transport_type $transport_type)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transport_type  $transport_type
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transport_type $transport_type)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transport_type  $transport_type
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transport_type $transport_type)
    {
        //
    }
}
