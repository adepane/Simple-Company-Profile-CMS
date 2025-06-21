<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Str;

class AnnouncementController extends Controller
{
    public function index()
    {
        $getModul = Announcement::paginate(10)->onEachSide(2);

        return view('panel.announcement.index', ['data' => $getModul]);
    }

    public function create()
    {
        return view('panel.announcement.create');
    }

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

        $modul = new Announcement;
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
        $modul->media_id = $request->media_id;
        $modul->content = $request->content;
        $modul->status = $request->status;
        if ($modul->save()) {
            return redirect()->route('announcement.index')->with('message', 'Pengumuman telah ditambah');
        }
    }

    public function edit($id)
    {
        $getModul = Announcement::find($id);

        return view('panel.announcement.edit', ['data' => $getModul]);
    }

    public function update(Request $request, $id)
    {
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
        $modul = Announcement::find($id);
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
        $modul->media_id = $request->media_id;
        $modul->content = $request->content;
        $modul->status = $request->status;
        if ($modul->update()) {
            return redirect()->route('announcement.index')->with('message', 'Pengumuman telah diupdate');
        }
    }

    public function destroy($id)
    {
        $modul = Announcement::find($id);
        if ($modul->delete()) {
            return redirect()->back()->with('message', 'Pengumuman telah dihapus');
        }
    }
}
