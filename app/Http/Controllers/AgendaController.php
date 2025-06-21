<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Str;

class AgendaController extends Controller
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
        return view('panel.agenda.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $modul = new Agenda;
        $modul->title = $request->title;
        $createSlug = Str::slug($request->title);
        $modul->slug = $createSlug;
        $modul->start = Carbon::parse($request->start);
        $modul->end = Carbon::parse($request->end);
        $modul->time_start = request('time_mulai');
        $modul->time_end = request('time_selesai');
        $modul->lokasi = request('location');
        $modul->description = $request->deskripsi;
        $modul->color = $request->color;
        if ($modul->save()) {
            $getReturn = Agenda::find($modul->id);

            return response()->json(['status' => 1, 'message' => $getReturn]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $modul = Agenda::find($id);
        $modul->start = Carbon::parse($request->start);
        $modul->end = Carbon::parse($request->end);
        if ($modul->update()) {
            $getReturn = Agenda::find($modul->id);

            return response()->json(['status' => 1, 'message' => $getReturn]);
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
        $modul = Agenda::find($id);
        if ($modul->delete()) {
            return response()->json(['status' => 1, 'message' => 'Agenda telah dihapus']);
        }
    }

    public function getAgenda(Request $request)
    {
        $start = Carbon::parse($request->start);
        $end = Carbon::parse($request->end);
        $getModul = Agenda::where('start', '>=', $start)
            ->where('end', '<=', $end)
            ->get();

        return json_encode($getModul);
    }
}
