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
}
