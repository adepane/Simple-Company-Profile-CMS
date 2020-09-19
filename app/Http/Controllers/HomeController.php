<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\Berita;
use App\Models\Halaman;
use App\Models\Layout;
use App\Models\Menu;
use App\Models\Slider;
use App\Models\Pengumuman;
use App\Models\Pdf;
use App\Models\Pesan;
use App\Models\Gallery;
use App\Models\Kategori;
use App\Models\Tag;
use App\Models\Iklan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Str;
use File;
use App\Helpers\Helpers as CMS;

class HomeController extends Controller
{

    public function index()
    {
        return view('home.index');
    }

    public function showPage(Request $request,$slug)
    {
        $getHalaman = Halaman::where("slug",$slug)->get()->first();
        if($getHalaman == null){
            abort(404);
        } else {
            return view('home.halaman',['data'=>$getHalaman]);
        }
    }
    
    public function listPost()
    {
        $getBeritas = Berita::where("status",1)->orderBy('publish_date','desc')->paginate(10)->onEachSide(2);
        return view('home.berita',['data'=>$getBeritas]);
    }
    public function showPost(Request $request,$id, $slug)
    {
        $getBerita = Berita::find($id);
        if ($getBerita == null) {
            abort(404);
        } else {
            $getBerita->increment('view');
            return view('home.single',['data'=>$getBerita]);
        }
    }

    public function showTags(Request $request,$slug)
    {
        $getTag = Tag::where("slug",$slug)->get()->first();
        $taggingPosts = Tag::find($getTag->id);
        $header = Str::title("Tag ".$getTag->name);
        return view('home.archive',['data'=>$getTag->posts,'header'=>$header]);
    }

    public function showSearch(Request $request)
    {
        $terms = $request->q;
        $result = Berita::where("status",1)->where("title","like","%".$terms."%")->orderBy('publish_date','desc')->get();
        $header = Str::title("Pencarian ".$terms);
        return view('home.archive',['data'=>$result,'header'=>$header]);
    }

    public function showCategories(Request $request,$slug)
    {
        $getCategory = Kategori::where("slug",$slug)->get()->first();
        $header = Str::title("Kategori ".$getCategory->name);
        return view('home.archive',['data'=>$getCategory->getBeritaCats,'header'=>$header]);
    }

    public function listAgenda()
    {
        $getAgenda = Agenda::orderBy('start','desc')->get();
        return view('home.agenda',['data'=>$getAgenda]);
    }

    public function showAgenda(Request $result,$id,$slug)
    {
        $getAgenda = Agenda::find($id);
        return view('home.agenda_single',['data'=>$getAgenda]);
    }

    public function listPengumuman()
    {
        $getPengumuman = Pengumuman::orderBy('id','desc')->paginate(10)->onEachSide(2);
        return view('home.pengumuman',['data'=>$getPengumuman]);
    }

    public function showPengumuman(Request $request,$id,$slug)
    {
        $getPengumuman = Pengumuman::find($id);
        if ($getPengumuman == null) {
            abort(404);
        } else {
            $getPengumuman->increment('view');
            return view('home.pengumuman_single',['data'=>$getPengumuman]);
        }
    }
    
    public function showContactUs(Request $request)
    {
        return view('home.contact');
    }

    public function listGallery()
    {
        $getGallery = Gallery::orderBy('id','desc')->paginate(10)->onEachSide(2);
        return view('home.gallery',['galleries'=>$getGallery]);
    }

    public function showGallery($id)
    {
        $getMediaGallery = Gallery::find($id);
        return view('home.gallery_single',['galleries'=>$getMediaGallery]);
    }

    public function kirimPesan(Request $request)
    {
        $modul = new Pesan;
        $modul->nama = $request->form_name;
        $modul->email = $request->form_email;
        $modul->phone = $request->form_phone;
        $modul->perihal = $request->form_subject;
        $modul->isi = $request->form_message;
        $modul->status = 0;
        $dataReturn = array();
        if($modul->save()){
            $dataReturn['status'] = 'true';
            $dataReturn['message'] = 'Thanks for your contact, your message was sent';
            return $dataReturn;
        }
    }

}
