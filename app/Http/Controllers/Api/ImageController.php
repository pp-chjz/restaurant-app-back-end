<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Image;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return new \App\Models\Image()::get();
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);
        $file = $request->file('image');
        $path = $file->store('public/files');
        $name = $file->getClientOriginalName();

        //store your file into directory and db
        $save = new Image();
        $save->name = $file;
        $save->path= $path;
        $save->save();
            
        return response()->json([
            "success" => true,
            "message" => "File successfully uploaded",
            "file" => $file
        ]);

        // $image = request()->file('image');
        // $imageName = $image->getClientOriginalName();
        // $imageName = time().'-'.$imageName;

        // // $image->move(public_path('/images', $imageName));

        // $img = new Image;
        // $img->menu_id = $request->input('menu_id');
        // $img->image = '/images'.$imageName;
        // $img->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function show(Image $image)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Image $image)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function destroy(Image $image)
    {
        //
    }
}
