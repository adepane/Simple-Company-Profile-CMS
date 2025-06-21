<?php

namespace App\Http\Controllers;

use App\Models\Pesan;

class PesanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $getModul = Pesan::orderBy('id', 'desc')->paginate(10)->onEachSide(2);

        return view('panel.pesan.index', ['data' => $getModul]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $getModul = Pesan::find($id);
        if ($getModul->status == 0) {
            $getModul->status = 1;
            $getModul->update();
        }

        return view('panel.pesan.show', ['data' => $getModul]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $modul = Pesan::find($id);
        if ($modul->delete()) {
            return redirect()->back()->with('message', 'Pesan telah dihapus');
        }
    }
}
