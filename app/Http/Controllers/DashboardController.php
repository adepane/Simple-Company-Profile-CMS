<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;
use App\Models\Media;
use App\Models\Pdf;
use App\Models\Pesan;
use App\Models\Agenda;
use App\Models\Pengumuman;
use App\Models\User;
use Arr;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getPosts()
    {
        $getPosts = Berita::get()->count();
        return $getPosts;
    }

    public function getMedia()
    {
        $getPhoto = Media::count();
        $getPdf = Pdf::count();
        $total = $getPhoto+$getPdf;
        $mediaTotal = Arr::add(['photo'=>$getPhoto,'pdf'=>$getPdf],'media',$total);
        return $mediaTotal;
    }

    public function getMessage()
    {
        $getAll = Pesan::count();
        $unread = Pesan::where('status',0)->count();
        return $totalMessasge = Arr::add(['unread'=>$unread],'total',$getAll);
    }

    public function getAgenda()
    {
        $getAgenda = Agenda::count();
        return $getAgenda;
    }

    public function getPengumuman()
    {
        $getPengumuman = Pengumuman::count();
        return $getPengumuman;
    }

    public function getUsers()
    {
        $getUsers = User::count();
        return $getUsers;
    }
    
    public function index()
    {
        return view('panel.home')->with('posts',$this->getPosts())->with('medias',$this->getMedia())->with('message',$this->getMessage())->with('agenda',$this->getAgenda())->with('pengumuman',$this->getPengumuman())->with('users',$this->getUsers());
    }
}
