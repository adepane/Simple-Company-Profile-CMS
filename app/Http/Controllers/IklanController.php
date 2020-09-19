<?php

namespace App\Http\Controllers;

use App\Models\Iklan;
use Illuminate\Http\Request;

class IklanController extends Controller
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
        $getModul = Iklan::paginate(10)->onEachSide(2);
        return view('panel.iklan.index',['data'=>$getModul]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('panel.iklan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        switch ((int)$request->position) {
            case 1:
                $checkIklan = Iklan::where("position",$request->position)->get()->first();
                if (!empty($checkIklan)) {
                    return redirect()->back()->withErrors(['Iklan Homepage hanya boleh 1']);
                } else {
                    $modul = new Iklan;
                    $modul->title = $request->title;
                    $modul->tautan = $request->tautan;
                    $modul->id_media = $request->id_media;
                    $modul->order = $request->order;
                    $modul->position = $request->position;
                    $modul->script = $request->script;
                    $modul->status = $request->status;
                    if ($modul->save()) {
                        return redirect()->route('iklan.index')->with('message', 'Iklan telah ditambah');
                    }
                }
                break;
            case 2:
                $checkIklan = Iklan::where("position",$request->position)->get()->first();
                if (!empty($checkIklan)) {
                    return redirect()->back()->withErrors(['Iklan Floating hanya boleh 1']);
                } else {
                    $modul = new Iklan;
                    $modul->title = $request->title;
                    $modul->tautan = $request->tautan;
                    $modul->id_media = $request->id_media;
                    $modul->order = $request->order;
                    $modul->position = $request->position;
                    $modul->script = $request->script;
                    $modul->status = $request->status;
                    if ($modul->save()) {
                        return redirect()->route('iklan.index')->with('message', 'Iklan telah ditambah');
                    }
                }
                break;
            default:
                $modul = new Iklan;
                $modul->title = $request->title;
                $modul->tautan = $request->tautan;
                $modul->id_media = $request->id_media;
                $modul->order = $request->order;
                $modul->position = $request->position;
                $modul->script = $request->script;
                $modul->status = $request->status;
                if ($modul->save()) {
                    return redirect()->route('iklan.index')->with('message', 'Iklan telah ditambah');
                }
                break;
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
        $getModul = Iklan::find($id);
        return view('panel.iklan.edit',['data'=>$getModul]);
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
        $modul = Iklan::find($id);
        $modul->title = $request->title;
        $modul->tautan = $request->tautan;
        $modul->id_media = $request->id_media;
        $modul->position = $request->position;
        $modul->order = $request->order;
        $modul->script = $request->script;
        $modul->status = $request->status;
        if ($modul->update()) {
            return redirect()->route('iklan.index')->with('message', 'Iklan telah diupdate');
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
        $modul = Iklan::find($id);
        if ($modul->delete()) {
            return redirect()->back()->with('message', 'Iklan telah dihapus');
        }
    }
}
