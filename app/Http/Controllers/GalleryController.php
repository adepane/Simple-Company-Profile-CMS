<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $getModul = Gallery::orderBy('id','desc')->paginate(10)->onEachSide(2);
        return view('panel.gallery.index',['data'=>$getModul]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('panel.gallery.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->ket_gambar[1]);
        // dd($request->all());
        $modul = new Gallery;
        $modul->title = $request->title;
        if($modul->save()){
            foreach ($request->id_media as $key => $value) {
                $modul->gallerymedias()->attach($value,['photo_desc' => $request->ket_gambar[$key]]);
            }
            return redirect()->route('gallery.index')->with('messsage','Galeri telah ditambah');
        }
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $getModul = Gallery::find($id);
        return view('panel.gallery.edit',['data'=>$getModul]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());
        $modul = Gallery::find($id);
        $modul->gallerymedias()->detach();
        $modul->title = $request->title;
        foreach ($request->id_media as $key => $value) {
            $modul->gallerymedias()->attach($value,['photo_desc' => $request->ket_gambar[$key]]);
        }
        if($modul->update()){
            
            return redirect()->route('gallery.index')->with('messsage','Galeri telah diupdate');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $modul = Gallery::find($id);
        $modul->gallerymedias()->detach();
        if ($modul->delete()) {
            return redirect()->back()->with('message', 'Galeri telah dihapus');
        }
    }
}
