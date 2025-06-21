<?php

namespace App\Http\Controllers;

use App\Models\Halaman;
use Illuminate\Http\Request;
use Str;

class HalamanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    protected function checkSlug($slug, $id = 0, $oldSlug = null)
    {
        $checkSlug = Halaman::select('slug')->where('slug', 'like', $slug.'%')
            ->where('id', '<>', $id)
            ->count();

        if (! empty($checkSlug)) {
            if ($id != 0) {
                if (Str::contains($oldSlug, $slug)) {
                    $realSlug = Halaman::find($id);
                    if ($realSlug->slug != $oldSlug) {
                        $newSlug = $slug.'-'.($checkSlug + 1);
                    } else {
                        $newSlug = $oldSlug;
                    }
                } else {
                    $newSlug = $slug.'-'.($checkSlug + 1);
                }
            } else {
                $newSlug = $slug.'-'.($checkSlug + 1);
            }
        } else {
            $newSlug = $slug;
        }

        return $newSlug;
    }

    public function index()
    {
        $getModul = Halaman::paginate(10)->onEachSide(2);

        return view('panel.halaman.index', ['data' => $getModul]);
    }

    public function create()
    {
        return view('panel.halaman.create');
    }

    public function store(Request $request)
    {
        // $regex = '#https?://(?:www\.)?youtube\.com/watch\?v=([^&]+?)#';
        $this->validate(
            $request,
            [
                'file_gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            ],
            [
                'file_gambar.image' => 'File Gambar Tidak Valid',
            ]
        );
        $modul = new Halaman;
        $modul->judul = $request->title;
        $createSlug = Str::slug($request->title);
        $modul->slug = $this->checkSlug($createSlug);
        $modul->content = $request->content;
        $modul->id_media = $request->id_media;
        $modul->ket_photo = $request->ket_gambar;
        $modul->status = (int) $request->status;
        if ($modul->save()) {
            return redirect()->route('halaman.index')->with('message', 'Halaman telah ditambah');
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $modul = Halaman::find($id);

        return view('panel.halaman.edit', ['data' => $modul]);
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        $this->validate(
            $request,
            [
                'file_gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            ],
            [
                'file_gambar.image' => 'Gambar tidak valid',
            ]
        );
        $modul = Halaman::find($id);
        $modul->judul = $request->title;
        $createSlug = Str::slug($request->title);
        $oldSlug = $modul->slug;
        $modul->slug = $this->checkSlug($createSlug, $modul->id, $oldSlug);
        $modul->content = $request->content;
        $modul->id_media = $request->id_media;
        $modul->ket_photo = $request->ket_gambar;
        $modul->status = (int) $request->status;
        if ($modul->update()) {
            return redirect()->route('halaman.index')->with('message', 'Halaman telah diupdate');
        }
    }

    public function destroy($id)
    {
        $modul = Halaman::find($id);
        if ($modul->delete()) {
            return redirect()->back()->with('message', 'Halaman telah dihapus');
        }
    }
}
