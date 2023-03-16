<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Log;

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
        $menus = \App\Models\Menu::with('ingredients')->get();
        return new \App\Http\Resources\Menu($menus);
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
            // 'QTY' => ['required'],
            'size' => ['required'],
            // 'comment' => ['required'],
        ]);

        $menu = new Menu();
        $menu->menu_id = $request->input('menu_id');
        $menu->catagories = $request->input('catagories');
        $menu->sort_menu = $request->input('sort_menu');
        $menu->name_ENG = $request->input('name_ENG');
        $menu->name_TH = $request->input('name_TH');
        $menu->menu_status = $request->input('menu_status');
        $menu->price = $request->input('price');
        // $menu->QTY = $request->input('QTY');
        $menu->size = $request->input('size');
        // $menu->comment = $request->input('comment');
        // $menu->recipe_id = 0;
        // $menu->promotion_id = 0;
        $menu->save();

        $ingredients = $request->input('ingredients');
        $this->updateIngredient($menu, $ingredients);

        return $menu;
    }


    private function updateIngredient(Menu $menu, $ingredients)
    {
        $ingredient_array = [];
        foreach ($ingredients as $ingredient_id)
        {
            array_push($ingredient_array, $ingredient_id);
        }

        $menu->ingredients()->sync($ingredient_array);

        // foreach ($ingredients as $ingredient_name)
        // {
        //     $menutest = new Menu();
        //     $menutest->menu_id = $menu->name_TH;
        //     $menutest->catagories = 1;
        //     $menutest->sort_menu = 1;
        //     $menutest->name_ENG = $ingredient_name;
        //     $menutest->name_TH = "test";
        //     $menutest->menu_status = 1;
        //     $menutest->price = 150;
        //     $menutest->QTY = 1;
        //     $menutest->size = "l";
        //     $menutest->comment = "test";
        //     $menutest->recipe_id = 0;
        //     $menutest->promotion_id = 0;
        //     $menutest->save();
        // }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $menu)
    {
        return new \App\Http\Resources\MenuResource($menu);
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
        $menu->name_ENG = $request->input('name_ENG');
        $menu->name_TH = $request->input('name_TH');
        $menu->menu_status = $request->input('menu_status');
        $menu->price = $request->input('price');
        // $menu->QTY = $request->input('QTY');
        $menu->size = $request->input('size');
        $menu->catagories = $request->input('catagories');
        $menu->save();

        $ingredients = $request->input('ingredients');
        $this->updateIngredient($menu, $ingredients);

        return $menu;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        $menu->delete();

        return response()->json(['message' => 'Menu Successfully deleted']);
    }

    public function getMenuBySearch(Request $request)
    {
        $menu_status = $request->input('menu_status');
        $menu_catagory = $request->input('menu_catagory');
        $menu_name = $request->input('menu_name');


        if($menu_status !== 0 && $menu_catagory !== 0 && $menu_name !== "")
        {
            $menu = \App\Models\Menu::where('name_ENG','like',$menu_name)->where('catagories','=',$menu_catagory)->where('menu_status','=',$menu_status)->with('ingredients')->get();
            return new \App\Http\Resources\Menu($menu);
        }
        elseif($menu_status !== 0 && $menu_catagory !== 0)
        {
            $menu = \App\Models\Menu::where('catagories','=',$menu_catagory)->where('menu_status','=',$menu_status)->with('ingredients')->get();
            return new \App\Http\Resources\Menu($menu);
        }
        elseif($menu_status !== 0 && $menu_name !== "")
        {
            $menu = \App\Models\Menu::where('name_ENG','like',$menu_name)->where('menu_status','=',$menu_status)->with('ingredients')->get();
            return new \App\Http\Resources\Menu($menu);
        }
        elseif($menu_catagory !== 0 && $menu_name !== "")
        {
            $menu = \App\Models\Menu::where('name_ENG','like',$menu_name)->where('catagories','=',$menu_catagory)->with('ingredients')->get();
            return new \App\Http\Resources\Menu($menu);
        }
        elseif($menu_name !== "")
        {
            $menu = \App\Models\Menu::where('name_ENG','like',$menu_name)->with('ingredients')->get();
            return new \App\Http\Resources\Menu($menu);
        }
        elseif($menu_catagory !== 0)
        {
            $menu = \App\Models\Menu::where('catagories','=',$menu_catagory)->with('ingredients')->get();
            return new \App\Http\Resources\Menu($menu);
        }
        elseif($menu_status !== 0)
        {
            $menu = \App\Models\Menu::where('menu_status','=',$menu_status)->with('ingredients')->get();
            return new \App\Http\Resources\Menu($menu);
        }


    }

    public function getMenuByCustomerSearch(Request $request)
    {
        $menu_catagory = $request->input('menu_catagory');
        $menu_name = $request->input('menu_name');


        if( $menu_catagory !== 0 && $menu_name !== "")
        {
            $menu = \App\Models\Menu::where('name_ENG','like',$menu_name)->where('catagories','=',$menu_catagory)->with('ingredients')->get();
            return new \App\Http\Resources\Menu($menu);
        }
        elseif( $menu_catagory !== 0)
        {
            $menu = \App\Models\Menu::where('catagories','=',$menu_catagory)->with('ingredients')->get();
            return new \App\Http\Resources\Menu($menu);
        }
        elseif($menu_name !== "")
        {
            $menu = \App\Models\Menu::where('name_ENG','like',$menu_name)->with('ingredients')->get();
            return new \App\Http\Resources\Menu($menu);
        }


    }
}
