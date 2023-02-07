<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class MenuController extends Controller
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
        // $user = JWTAuth::user();
        // $m = $user->tasks()->paginate(5);
        $menus = \App\Models\Menu::get();
        return $menus;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $this->authorize('create' , \App\Models\Menu::class);
        $validated = $request->validate([
            'menu_id' => ['required'],
            'catagories' => ['required'],
            'sort_menu' => ['required'],
            'name_ENG' => ['required'],
            'name_TH' => ['required'],
            'menu_status' => ['required'],
            'price' => ['required'],
            'QTY' => ['required'],
            'size' => ['required'],
            'comment' => ['required'],
        ]);

        $menu = new Menu();
        $menu->menu_id = $request->input('menu_id');
        $menu->catagories = $request->input('catagories');
        $menu->sort_menu = $request->input('sort_menu');
        $menu->name_ENG = $request->input('name_ENG');
        $menu->name_TH = $request->input('name_TH');
        $menu->menu_status = $request->input('menu_status');
        $menu->price = $request->input('price');
        $menu->QTY = $request->input('QTY');
        $menu->size = $request->input('size');
        $menu->comment = $request->input('comment');
        $menu->recipe_id = 0;
        $menu->promotion_id = 0;
        $menu->save();

        return $menu;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $menu)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menu $menu)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        //
    }
}
