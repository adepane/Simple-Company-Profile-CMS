<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\Media;
use App\Models\Document;
use App\Models\Announcement;
use App\Models\Post;
use App\Models\User;
use Arr;

class DashboardController extends Controller
{

    public function getPosts()
    {
        $getPosts = Post::get()->count();

        return $getPosts;
    }

    public function getMedia()
    {
        $getPhoto = Media::count();
        $getDocument = Document::count();
        $total = $getPhoto + $getDocument;
        $mediaTotal = Arr::add(['photo' => $getPhoto, 'document' => $getDocument], 'media', $total);

        return $mediaTotal;
    }

    public function getMessage()
    {
        return $totalMessasge = Arr::add(['unread' => 0], 'total', 0);
    }

    public function getAgenda()
    {
        $getAgenda = Agenda::count();

        return $getAgenda;
    }

    public function getAnnouncement()
    {
        $getAnnouncement = Announcement::count();

        return $getAnnouncement;
    }

    public function getUsers()
    {
        $getUsers = User::count();

        return $getUsers;
    }

    public function index()
    {
        return view('panel.home')->with('posts', $this->getPosts())->with('medias', $this->getMedia())->with('message', $this->getMessage())->with('agenda', $this->getAgenda())->with('announcement', $this->getAnnouncement())->with('users', $this->getUsers());
    }
}
