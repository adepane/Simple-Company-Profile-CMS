<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Str;

class KategoriController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $getModul = Kategori::paginate(10)->onEachSide(2);

        return view('panel.kategori.index', ['data' => $getModul]);
    }

    public function create()
    {
        return view('panel.kategori.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
        $modul = new Kategori;
        $modul->name = $request->name;
        $modul->slug = Str::slug($request->name);
        if ($modul->save()) {
            return redirect()->route('kategori.index')->with('message', 'Kategori telah ditambah');
        }
    }

    public function edit($id)
    {
        $data = Kategori::find($id);

        return view('panel.kategori.edit', ['data' => $data]);
    }

    public function update(Request $request, $id)
    {
        $modul = Kategori::find($id);
        $this->validate($request, [
            'name' => 'required',
            'slug' => 'required|unique:kategori,slug,'.$modul->id,
        ]);
        $modul->name = $request->name;
        $modul->slug = Str::slug($request->slug);
        if ($modul->update()) {
            return redirect()->route('kategori.index')->with('message', 'Kategori telah diupdate');
        }
    }

    public function destroy($id)
    {
        $modul = Kategori::find($id);
        if ($modul->delete()) {
            return redirect()->back()->with('message', 'Kategori telah dihapus');
        }
    }
}
