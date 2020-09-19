<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Tag;
use App\Models\Terms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Str;

class BeritaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    protected function checkSlug($slug,$id=0,$oldSlug=null)
    {
        $checkSlug =  Berita::select('slug')->where('slug','like',$slug.'%')
            ->where('id', '<>', $id)
            ->count();

        if (!empty($checkSlug)) {
            if ($id != 0) {
                if (Str::contains($oldSlug,$slug)) {
                    $realSlug = Berita::find($id);
                    if ($realSlug->slug != $oldSlug) {
                        $newSlug = $slug.'-'.($checkSlug+1);
                    } else {
                        $newSlug = $oldSlug;
                    }
                } else {
                    $newSlug = $slug.'-'.($checkSlug+1);
                }
            } else {
                $newSlug = $slug.'-'.($checkSlug+1);
            }
        } else {
            $newSlug = $slug;
        }
        return $newSlug;
    }

    public function index()
    {
        $getModul = Berita::select([
            'id',
            'title',
            'slug',
            'author',
            'id_kategori',
            'status',
            'view',
            'created_at',
            'updated_at',
        ])
        ->with('kategories')
        ->with('authors')
        ->with('tags')
        ->orderBy('publish_date','desc')
        ->paginate(10)->onEachSide(2);

        return view('panel.berita.index',['data'=>$getModul]);
    }

    public function create()
    {
        return view('panel.berita.create');
    }

    public function store(Request $request)
    {
        $regex = '#https?://(?:www\.)?youtube\.com/watch\?v=([^&]+?)#';
        $this->validate(
            $request,
            [
                'yt_video'          => 'nullable|regex:' . $regex,
                'file_gambar'          => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            ],
            [
                'file_gambar.image' => 'File gambar tidak valid',
                'yt_video.regex' => 'Link Youtube Salah',
            ]
        );
        $modul = new Berita;
        $modul->title = $request->title;
        $createSlug = Str::slug($request->title);
        $modul->slug = $this->checkSlug($createSlug);
        $modul->content = $request->content;
        $modul->author = Auth::user()->id;
        $modul->id_kategori = $request->kategori;
        $modul->id_media = $request->id_media;
        $modul->ket_photo = $request->ket_gambar;
        $modul->yt_video = $request->yt_video;
        $modul->publish_date = (!empty($request->publish_date))? Carbon::parse($request->publish_date):Carbon::now();
        $modul->status = $request->status;
        if ($modul->save()) {
            if ($request->tags != null) {
                $modul->tags()->attach($request->tags);
            }
            return redirect()->route('berita.index')->with('message', 'Berita telah ditambah');
        } 
    }

    public function edit($id)
    {
        $modul = Berita::find($id);
        $getTags = $this->getTags($id);
        return view('panel.berita.edit',['data'=>$modul,'tags'=>$getTags]);
    }

    public function update(Request $request, $id)
    {
        $regex = '#https?://(?:www\.)?youtube\.com/watch\?v=([^&]+?)#';
        $this->validate(
            $request,
            [
                'yt_video'          => 'nullable|regex:' . $regex,
                'file_gambar'          => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            ],
            [
                'file_gambar.image' => 'File Gambar Tidak Valid',
                'yt_video.regex' => 'Link Youtube Salah',
            ]
        );
        $modul = Berita::find($id);
        $modul->title = $request->title;
        $createSlug = Str::slug($request->title);
        $oldSlug = $modul->slug;
        $modul->slug = $this->checkSlug($createSlug,$modul->id,$oldSlug);
        $modul->content = $request->content;
        $modul->author = Auth::user()->id;
        $modul->id_kategori = (int) $request->kategori;
        $modul->id_media = (int) $request->id_media;
        $modul->ket_photo = $request->ket_gambar;
        $modul->yt_video = $request->yt_video;
        $modul->status = $request->status;
        $modul->publish_date = Carbon::parse($request->publish_date);
        $modul->tags()->detach();

        if ($request->tags != null) {
            $modul->tags()->attach($request->tags);
        }
        if ($modul->update()) {
            
            return redirect($request->lastState)->with('message', 'Berita telah diupdate');
        } 
    }

    public function destroy($id)
    {
        $modul = Berita::find($id);
        $modul->tags()->detach();
        if ($modul->delete()) {
            return redirect()->back()->with('message', 'Berita telah dihapus');
        }
    }

    public function getTags($id)
    {
        $modul = Berita::find($id);
        $getAllTag = $modul->tags->pluck('name','id')->all();
        return $getAllTag;
    }

    public function addTags(Request $request)
    {
        $dataReturn = array();
        $modul = Tag::where("name",$request->dataTag)->get()->first();
        if (!empty($modul)) {
            $dataReturn['status'] = 1;
            $dataReturn['message'] = "Tag telah ditambahkan";
            $dataReturn['tagId'] = $modul->id;
        } else {
            $tag = new Tag;
            $tag->name = $request->dataTag;
            $tag->slug = Str::slug($request->dataTag);
            if($tag->save()){
                $dataReturn['status'] = 1;
                $dataReturn['message'] = "Tag telah ditambahkan";
                $dataReturn['tagId'] = $tag->id;
            } else {
                $dataReturn['status'] = 1;
                $dataReturn['message'] = "Tag gagal ditambahkan";
                $dataReturn['tagId'] = null;
            }
        }
        return $dataReturn;
    }

    public function quickDraft(Request $request)
    {
        
        $modul = new Berita;
        $modul->title = $request->title;
        $createSlug = Str::slug($request->title);
        $modul->slug = $this->checkSlug($createSlug);
        $modul->content = $request->content;
        $modul->author = Auth::user()->id;
        $modul->id_kategori = ($request->kategori != null)?$request->kategori:1;
        $modul->publish_date = (!empty($request->publish_date))? Carbon::parse($request->publish_date):Carbon::now();
        $modul->status = 0;
        $dataReturn = array();
        if ($modul->save()) {
            $dataReturn['status'] = 1;
            $dataReturn['message'] = 'Berita telah disimpan';
            return $dataReturn;
        }
    }
    
}
