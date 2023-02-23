<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tablenumber;
use Illuminate\Http\Request;

class TableNumberController extends Controller
{
    public function __construct() {
        $this->middleware('auth:api');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
        $tablenumber = new Tablenumber();
        $tablenumber->tablenum_status = $request->input('tablenum_status');
        $tablenumber->checkbill_status = $request->input('checkbill_status');
        $tablenumber->tablenumber = $request->input('tablenumber');
        $tablenumber->order_id = $request->input('order_id');

        $tablenumber->save();
        return $tablenumber;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tablenumber  $tablenumber
     * @return \Illuminate\Http\Response
     */
    public function show(Tablenumber $tablenumber)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tablenumber  $tablenumber
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tablenumber $tablenumber)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tablenumber  $tablenumber
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tablenumber $tablenumber)
    {
        //
    }
}
