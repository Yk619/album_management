<?php

namespace App\Http\Controllers;

use App\Models\{Album, Image};
use Illuminate\Http\Request;
use App\Http\Requests\ImageRequest;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $images = Image::with('album')->paginate(10);
        return view('image.index')->with(['images' => $images]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $albums = Album::all();
        return view('image.create')->with(['albums' => $albums]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ImageRequest $request)
    {
        $img = new Image();
        $img->title = $request->title;
        $img->album_id = $request->album_id;
        if (request()->hasFile('image')) {
            $file = request()->file('image');
            $extension =$file->getClientOriginalExtension();
            $fileName = $file->store('image', ['disk' => 'uploads']);
            $img->path = $fileName;
        }
        
        $img->save();
        return redirect()->route('image.index')->with(['success' => 'Image added successfully.']);
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
    public function edit($id)
    {
        $albums = Album::all();
        $image = Image::find($id);  
        return view('image.edit', compact('image'))->with(['albums' => $albums]);  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\tobo  $tobo
     * @return \Illuminate\Http\Response
     */
    public function update(ImageRequest $request, $id)
    {
        $image = Image::find($id);
        $image->title = $request->title;
        $image->album_id = $request->album_id;
        if (request()->hasFile('image')) {
            $path = public_path('uploads/'.$image->path);
            unlink($path);


            $file = request()->file('image');
            $extension =$file->getClientOriginalExtension();
            $fileName = $file->store('image', ['disk' => 'uploads']);
            $img->path = $fileName;
        } 
        $image->save();
        return redirect()->route('gallery.index')->with(['success' => 'Image updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\tobo  $tobo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $image = Image::find($id);
        $path = public_path('uploads/'.$image->path);
        unlink($path);
        $image->delete();

        return redirect()->route('image.index')->with(['success' => 'Image deleted successfully.']);
    }  
}
