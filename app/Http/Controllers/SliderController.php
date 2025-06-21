<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $getModul = Slider::paginate(10)->onEachSide(2);

        return view('panel.slider.index', ['data' => $getModul]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('panel.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'id_media' => 'required',
            'order' => 'required',
        ]
        );
        $modul = new Slider;
        $modul->title = $request->title;
        $modul->id_media = $request->id_media;
        $modul->desc = json_encode($request->desc);
        $modul->order = $request->order;
        if ($modul->save()) {
            return redirect()->route('slider.index')->with('message', 'Slide telah ditambah');
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
        $modul = Slider::find($id);

        return view('panel.slider.edit', ['data' => $modul]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $modul = Slider::find($id);
        $modul->title = $request->title;
        $modul->id_media = $request->id_media;
        $modul->desc = json_encode($request->desc);
        $modul->order = $request->order;
        if ($modul->update()) {
            return redirect()->route('slider.index')->with('message', 'Slide telah diupdate');
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
        $modul = Slider::find($id);
        if ($modul->delete()) {
            return redirect()->route('slider.index')->with('message', 'Slide telah dihapus');
        }
    }
}
