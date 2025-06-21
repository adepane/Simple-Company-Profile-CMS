<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Pengumuman;
use Illuminate\Http\Request;
use Str;

class PengumumanController extends Controller
{
    public function index()
    {
        $getModul = Pengumuman::paginate(10)->onEachSide(2);

        return view('panel.pengumuman.index', ['data' => $getModul]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('panel.pengumuman.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'file_gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
                'filepdf' => 'nullable|mimes:pdf',
            ],
            [
                'file_gambar.image' => 'File gambar tidak valid',
                'filepdf.image' => 'File PDF tidak valid',
            ]
        );

        $modul = new Pengumuman;
        $media = $request->file('filepdf');
        if ($media != '') {
            $newDocument = new Document;
            $ext = $media->guessClientExtension();
            $newdate = date('YmdHis');
            $origName = preg_replace('/\\.[^.\\s]{3,4}$/', '', $media->getClientOriginalName());
            $path = $media->storeAs('pdf', Str::slug($origName.'_'.$newdate).'.'.$ext, 'uploadfile');
            $newDocument->path = $path;
            $newDocument->name = $origName;
            $newDocument->save();
            $modul->document_id = $newDocument->id;
        }
        $modul->title = Str::title($request->title);
        $modul->slug = Str::slug($request->title);
        $modul->id_media = $request->id_media;
        $modul->content = $request->content;
        $modul->status = $request->status;
        if ($modul->save()) {
            return redirect()->route('pengumuman.index')->with('message', 'Pengumuman telah ditambah');
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
        $getModul = Pengumuman::find($id);

        return view('panel.pengumuman.edit', ['data' => $getModul]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());

        $this->validate(
            $request,
            [
                'file_gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
                'filepdf' => 'nullable|mimes:pdf',
                'title' => 'required',
            ],
            [
                'file_gambar.image' => 'File gambar tidak valid',
                'filepdf.image' => 'File PDF tidak valid',
                'title.required' => 'title tidak boleh kosong',
            ]
        );
        $modul = Pengumuman::find($id);
        $media = $request->file('filepdf');
        if ($media != '') {
            $newDocument = new Document;
            $ext = $media->guessClientExtension();
            $mimeType = $media->getClientMimeType();
            $newdate = date('YmdHis');
            $origName = preg_replace('/\\.[^.\\s]{3,4}$/', '', $media->getClientOriginalName());
            $path = $media->storeAs('pdf', Str::slug($origName.'_'.$newdate).'.'.$ext, 'uploadfile');
            $newDocument->path = $path;
            $newDocument->name = $origName;
            $newDocument->save();
            $modul->document_id = $newDocument->id;
        }
        $modul->title = Str::title($request->title);
        $modul->slug = Str::slug($request->title);
        $modul->id_media = $request->id_media;
        $modul->content = $request->content;
        $modul->status = $request->status;
        if ($modul->update()) {
            return redirect()->route('pengumuman.index')->with('message', 'Pengumuman telah diupdate');
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
        $modul = Document::find($id);
        if ($modul->delete()) {
            return redirect()->back()->with('message', 'Pengumuman telah dihapus');
        }
    }
}
