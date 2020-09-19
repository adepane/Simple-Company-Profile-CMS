<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Str;

class TagController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $getModul = Tag::paginate(10)->onEachSide(2);
        return view('panel.tag.index',['data'=>$getModul]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('panel.tag.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'          => 'required|unique:tags',
        ]);
        $modul = new Tag;
        $modul->name = $request->name;
        $modul->slug = Str::slug($request->name);
        if ($modul->save()) {
            return redirect()->route('tag.index')->with('message', 'Tag telah ditambah');
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
        $data = Tag::find($id);
        return view('panel.tag.edit', ['data' => $data]);
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
        $this->validate($request, [
            'name'          => 'required',
            'slug'          => 'required|unique:tags',
        ]);
        $modul = Tag::find($id);
        $modul->name = $request->name;
        $modul->slug = Str::slug($request->slug);
        if ($modul->update()) {
            return redirect()->route('tag.index')->with('message', 'Tag telah diupdate');
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
        $modul = Tag::find($id);
        if ($modul->delete()) {
            return redirect()->back()->with('message', 'Tag telah dihapus');
        }
    }

    
}
