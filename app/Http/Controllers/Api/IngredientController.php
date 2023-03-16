<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ingredient;
use Illuminate\Http\Request;

class IngredientController extends Controller
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
        $ingredients = \App\Models\Ingredient::get();
        return $ingredients;
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
            'QTY' => ['required'],
            'ingredient_name_ENG' => ['required'],
            'ingredient_name_TH' => ['required'],
            'ingredient_status' => ['required'],
        ]);

        $ingredient = new Ingredient();
            $ingredient->ingredient_ID = $request->input('ingredient_ID');
            $ingredient->QTY = $request->input('QTY');
            $ingredient->ingredient_name_ENG = $request->input('ingredient_name_ENG');
            $ingredient->ingredient_name_TH = $request->input('ingredient_name_TH');
            $ingredient->ingredient_status = $request->input('ingredient_status');
            $ingredient->recipe_id = 0;
            $ingredient->save();

            return $ingredient;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ingredient  $ingredient
     * @return \Illuminate\Http\Response
     */
    public function show(Ingredient $ingredient)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ingredient  $ingredient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ingredient $ingredient)
    {
        //
    }
    public function updateStatus(Request $request, Ingredient $ingredient)
    {
        $ingredient->ingredient_status = $request->input('ingredient_status');
        $ingredient_name = $ingredient->ingredient_name_ENG;

        $ingredient->save();


        $menus = \App\Models\Menu::with('ingredients')->get();
        foreach ($menus as $menu) {
            // echo $menu->ingredients;
            foreach ($menu->ingredients as $ingredient) {
                // echo $ingredient->ingredient_name_ENG;
                if($ingredient->ingredient_name_ENG === $ingredient_name)
                {
                    // echo $menu->name_ENG ;
                    // echo "/" ;

                    // echo $ingredient_name ;
                    // echo "=" ;
                    // echo $ingredient->ingredient_name_ENG ;
                    // echo "   " ;
                    if($ingredient->ingredient_status === 'out of stock')
                    {
                        $menu->menu_status = 'out of stock';
                        $menu->save();
                    }
                    elseif($ingredient->ingredient_status === 'in stock')
                    {
                        $menu->menu_status = 'in stock';
                        $menu->save();
                    }
                    
                }
            }
        }
        
        return $menus;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ingredient  $ingredient
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ingredient $ingredient)
    {
        $ingredient->delete();

        return response()->json(['message' => 'Ingredient Successfully deleted']);
    }

    public function getIngredientBySearch(Request $request)
    {
        $ingredient_status = $request->input('ingredient_status');
        $ingredient_name = $request->input('ingredient_name');


        if($ingredient_status !== 0 && $ingredient_name !== "")
        {
            $ingredient = \App\Models\Ingredient::where('ingredient_name_ENG','like',$ingredient_name)->where('ingredient_status','=',$ingredient_status)->get();
            return $ingredient;
        }
        elseif($ingredient_status !== 0)
        {
            $ingredient = \App\Models\ingredient::where('ingredient_status','=',$ingredient_status)->get();
            return $ingredient;
        }
        elseif($ingredient_name !== "")
        {
            $ingredient = \App\Models\ingredient::where('ingredient_name_ENG','like',$ingredient_name)->get();
            return $ingredient;
        }


    }
}
