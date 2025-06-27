<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use Illuminate\Http\Request;

class AdvertisementController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $getModul = Advertisement::paginate(10)->onEachSide(2);

        return view('panel.advertisement.index', ['data' => $getModul]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('panel.advertisement.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        switch ((int) $request->position) {
            case 1:
                $checkAdvertisement = Advertisement::where('position', $request->position)->get()->first();
                if (! empty($checkAdvertisement)) {
                    return redirect()->back()->withErrors(['Advertisement Homepage hanya boleh 1']);
                } else {
                    $modul = new Advertisement;
                    $modul->title = $request->title;
                    $modul->tautan = $request->tautan;
                    $modul->id_media = $request->id_media;
                    $modul->order = $request->order;
                    $modul->position = $request->position;
                    $modul->script = $request->script;
                    $modul->status = $request->status;
                    if ($modul->save()) {
                        return redirect()->route('advertisement.index')->with('message', 'Advertisement telah ditambah');
                    }
                }
                break;
            case 2:
                $checkAdvertisement = Advertisement::where('position', $request->position)->get()->first();
                if (! empty($checkAdvertisement)) {
                    return redirect()->back()->withErrors(['Advertisement Floating hanya boleh 1']);
                } else {
                    $modul = new Advertisement;
                    $modul->title = $request->title;
                    $modul->tautan = $request->tautan;
                    $modul->id_media = $request->id_media;
                    $modul->order = $request->order;
                    $modul->position = $request->position;
                    $modul->script = $request->script;
                    $modul->status = $request->status;
                    if ($modul->save()) {
                        return redirect()->route('advertisement.index')->with('message', 'Advertisement telah ditambah');
                    }
                }
                break;
            default:
                $modul = new Advertisement;
                $modul->title = $request->title;
                $modul->tautan = $request->tautan;
                $modul->id_media = $request->id_media;
                $modul->order = $request->order;
                $modul->position = $request->position;
                $modul->script = $request->script;
                $modul->status = $request->status;
                if ($modul->save()) {
                    return redirect()->route('advertisement.index')->with('message', 'Advertisement telah ditambah');
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
        $getModul = Advertisement::find($id);

        return view('panel.advertisement.edit', ['data' => $getModul]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $modul = Advertisement::find($id);
        $modul->title = $request->title;
        $modul->tautan = $request->tautan;
        $modul->id_media = $request->id_media;
        $modul->position = $request->position;
        $modul->order = $request->order;
        $modul->script = $request->script;
        $modul->status = $request->status;
        if ($modul->update()) {
            return redirect()->route('advertisement.index')->with('message', 'Advertisement telah diupdate');
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
        $modul = Advertisement::find($id);
        if ($modul->delete()) {
            return redirect()->back()->with('message', 'Advertisement telah dihapus');
        }
    }
}