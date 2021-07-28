<?php

namespace App\Http\Controllers;

use App\Models\{Album, Image};
use Illuminate\Http\Request;
use App\Http\Requests\AlbumRequest;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $galleries = Album::with('image')->paginate(10);
        return view('album.index')->with(['galleries' => $galleries]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('album.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AlbumRequest $request)
    {
        $gallery = new Album();
        foreach($request->only('title', 'description') as $key => $value){
            $gallery[$key] = $value;
        }
        $gallery->save();
        if($request->hasFile('image'))
        {
            $images = array();
            $files = $request->file('image');
            foreach ($files as $file) {
                $fileName = $file->store('image', ['disk' => 'uploads']);

                $images[] = [
                    'album_id' => $gallery->id,
                    'path' => $fileName,
                ];
            }
        Image::insert($images);
        }

        return redirect()->route('gallery.index')->with(['success' => 'Gallery added successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\album  $album
     * @return \Illuminate\Http\Response
     */
    public function show($album_id)
    {
        $gallery = Album::with('image')->where('id', $album_id)->firstOrFail();  
        return view('album.show')->with(['gallery' => $gallery]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\album  $album
     * @return \Illuminate\Http\Response
     */
    public function edit($album_id)
    {
        $gallery = Album::find($album_id);
        //dd($gallery->toArray()); 
        return view('album.edit', compact('gallery'));  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\album  $album
     * @return \Illuminate\Http\Response
     */
    public function update(AlbumRequest $request, $id)
    {
        $gallery = Album::find($id);
        $gallery->title = $request->title;
        $gallery->description = $request->description;  
        $gallery->save();
        if($request->hasFile('image'))
        {
            $images = array();
            $files = $request->file('image');
            foreach ($files as $file) {
                $fileName = $file->store('image', ['disk' => 'uploads']);

                $images[] = [
                    'album_id' => $gallery->id,
                    'path' => $fileName,
                ];
            }
        Image::insert($images);
        }
        return redirect()->route('gallery.index')->with(['success' => 'Gallery updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\album  $album
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $gallery = Album::find($id);
        $gallery->delete();
        return redirect()->route('gallery.index')->with(['success' => 'Gallery deleted successfully.']);
    }

    /** Remove the specified resource from storage.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function deleteImage($img_id)
    {
        $img = Image::findOrFail($img_id);
        $img->delete();
        return redirect()->back()->with('success', 'Image deleted successfully!');
        
    }
}
