<?php

namespace App\Http\Controllers;

use App\Photo;
use Illuminate\Http\Request;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $photos = Photo::all();
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
            $request->validate([
                "photos.*" => "mimes:jpeg,png,jpg",
            ]);

            if ($request->hasFile('photos')){
                $fileArray = [];
                foreach ($request->file('photos') as $file) {
                    $fileName = uniqid()."photo.".$file->getClientOriginalExtension();
                    $src = 'public/products';
                    array_push($fileArray,$fileName);
                    $file->storeAs($src,$fileName);
                }
                foreach ($fileArray as $f){
                    $photo = new Photo();
                    $photo->product_id = $request->id;
                    $photo->photos = $f;
                    $photo->save();
                }
                return redirect()->back()->with('message',['icon'=>'success','title'=>'New Photo is Update']);

            }
            return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function show(Photo $photo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function edit(Photo $photo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Photo $photo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Photo $photo)
    {
        //
        $photo->delete();
        return redirect()->back()->with('message',['icon'=>'success','title'=>'Photo is Deleted']);
    }
}
