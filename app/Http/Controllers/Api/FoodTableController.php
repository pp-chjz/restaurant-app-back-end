<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FoodTable;
use Illuminate\Http\Request;

class FoodTableController extends Controller
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
        $foodTable = \App\Models\FoodTable::with('orders')->get();
        return new \App\Http\Resources\FoodTableCollection($foodTable);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tablenumber = new FoodTable();
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
     * @param  \App\Models\FoodTable  $foodTable
     * @return \Illuminate\Http\Response
     */
    public function show(FoodTable $foodTable)
    {
        return new \App\Http\Resources\FoodTable($foodTable);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FoodTable  $foodTable
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FoodTable $foodTable)
    {
        $order = $request->input('order_id');
        $foodTable->orders()->sync($order);
        return new \App\Http\Resources\FoodTable($foodTable);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FoodTable  $foodTable
     * @return \Illuminate\Http\Response
     */
    public function destroy(FoodTable $foodTable)
    {
        //
    }
}
