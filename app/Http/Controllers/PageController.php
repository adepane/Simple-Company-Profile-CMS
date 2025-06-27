<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;
use Str;

class PageController extends Controller
{
    protected function checkSlug($slug, $id = 0, $oldSlug = null)
    {
        $checkSlug = Page::select('slug')->where('slug', 'like', $slug.'%')
            ->where('id', '<>', $id)
            ->count();

        if (! empty($checkSlug)) {
            if ($id != 0) {
                if (Str::contains($oldSlug, $slug)) {
                    $realSlug = Page::find($id);
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
        $getModul = Page::paginate(10)->onEachSide(2);

        return view('panel.pages.index', ['data' => $getModul]);
    }

    public function create()
    {
        return view('panel.pages.create');
    }

    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'file_gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            ],
            [
                'file_gambar.image' => 'File Gambar Tidak Valid',
            ]
        );

        $modul = new Page;
        $modul->title = $request->title;
        $createSlug = Str::slug($request->title);
        $modul->slug = $this->checkSlug($createSlug);
        $modul->content = $request->content;
        // Accept id_media from the request for backward compatibility
        $modul->media_id = $request->id_media;
        $modul->img_description = $request->ket_gambar;
        $modul->status = (int) $request->status;

        if ($modul->save()) {
            return redirect()->route('pages.index')->with('message', 'Page has been added');
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $modul = Page::find($id);

        return view('panel.pages.edit', ['data' => $modul]);
    }

    public function update(Request $request, $id)
    {
        $this->validate(
            $request,
            [
                'file_gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            ],
            [
                'file_gambar.image' => 'Gambar tidak valid',
            ]
        );

        $modul = Page::find($id);
        $modul->title = $request->title;
        $createSlug = Str::slug($request->title);
        $oldSlug = $modul->slug;
        $modul->slug = $this->checkSlug($createSlug, $modul->id, $oldSlug);
        $modul->content = $request->content;
        // Accept id_media from the request for backward compatibility
        $modul->media_id = $request->id_media;
        $modul->img_description = $request->ket_gambar;
        $modul->status = (int) $request->status;

        if ($modul->update()) {
            return redirect()->route('pages.index')->with('message', 'Page has been updated');
        }
    }

    public function destroy($id)
    {
        $modul = Page::find($id);
        if ($modul->delete()) {
            return redirect()->back()->with('message', 'Page has been deleted');
        }
    }
}
