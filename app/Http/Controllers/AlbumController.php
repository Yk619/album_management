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
        return redirect()->route('gallery.index')->with(['success' => 'Gallery added successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\tobo  $tobo
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\tobo  $tobo
     * @return \Illuminate\Http\Response
     */
    public function edit($album_id)
    {
        $gallery = Album::find($album_id);  
        return view('album.edit', compact('gallery'));  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\tobo  $tobo
     * @return \Illuminate\Http\Response
     */
    public function update(AlbumRequest $request, $id)
    {
        $gallery = Album::find($id);
        $gallery->title = $request->title;
        $gallery->description = $request->description;  
        $gallery->save();
        return redirect()->route('gallery.index')->with(['success' => 'Gallery updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\tobo  $tobo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $gallery = Album::find($id);
        $gallery->delete();
        return redirect()->route('gallery.index')->with(['success' => 'Gallery deleted successfully.']);
    }  
}
