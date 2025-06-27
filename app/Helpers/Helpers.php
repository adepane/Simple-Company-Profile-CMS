<?php

namespace App\Helpers;

use App\Models\Agenda;
use App\Models\Gallery;
use App\Models\Iklan;
use App\Models\Category;
use App\Models\Layout;
use App\Models\Media;
use App\Models\Menu;
use App\Models\Document;
use App\Models\Post;
use App\Models\Settings;
use App\Models\Slider;
use App\Models\Announcement;
use Request;
use Route;
use Str;

class Helpers
{
    public static function getSetting($name)
    {
        $setting = Settings::where('name', $name)->get()->first();
        if (! empty($setting)) {
            if (Str::contains($setting->val, 'assets/')) {
                $value = asset('/files/'.$setting->val);
            } else {
                $value = $setting->val;
            }
        } else {
            $value = '';
        }

        return $value;
    }

    public static function set_active($uri, $output = 'kt-menu__item--active')
    {
        if (is_array($uri)) {
            foreach ($uri as $u) {
                if (Route::is($u)) {
                    return $output;
                }
            }
        } else {
            if (Route::is($uri)) {
                return $output;
            }
        }
    }

    public static function setActive($uri, $output = 'kt-menu__item--active')
    {
        $path = explode('.', Route::currentRouteName());
        if (is_array($uri)) {
            foreach ($uri as $u) {
                if (Route::is($u)) {
                    return $output;
                }
            }
        } else {
            if ($uri == $path[0]) {
                return $output;
            }
        }
    }

    public static function set_open($uri, $output = 'kt-menu__item--open')
    {
        $path = explode('.', Route::currentRouteName());

        if (is_array($uri)) {
            foreach ($uri as $u) {
                if (Route::is($u)) {
                    return $output;
                }
            }
        } else {
            if ($uri == $path[0]) {
                echo $output;
            }
        }
    }

    public static function check_active($uri, $output = 'active')
    {
        switch ($uri) {
            case '/':
                if (url($uri) == url()->full()) {
                    return $output;
                }
                break;
            case '#':
                $getMenu = Menu::select(['id', 'slug'])->where('slug', '#')->get();
                if ($getMenu->count() == 1) {
                    $firstMenu = $getMenu->first();
                    $getChild = Menu::select('slug')->where('parent_id', $firstMenu->id)->pluck('slug')->all();
                    $path = '/'.request()->path();
                    if (Str::contains($path, $getChild)) {
                        return $output;
                    }
                }
                break;
            default:
                if (Str::contains('/'.request()->segment(1), $uri)) {
                    return $output;
                }
                break;
        }
    }

    public static function getRouteName()
    {
        $routeName = explode('.', Route::currentRouteName());
        $name = strtoupper($routeName[0]);

        return $name;

    }

    public static function excerpt($content, $length = 25)
    {
        return Str::words(strip_tags($content), $length);
    }

    public static function getImage($path, $thumb = false)
    {
        $getMedia = Media::find($path);
        if (! empty($getMedia)) {
            switch ($thumb) {
                case true:
                    return asset('/files/'.$getMedia->path_220);
                    break;
                default:
                    return asset('/files/'.$getMedia->path);
                    break;
            }
        } else {
            return asset(self::getSetting('defaultimage'));
        }
    }

    public static function getPdf($path)
    {
        $getMedia = Document::find($path);
        if (! empty($getMedia)) {
            return asset('/files/'.$getMedia->path);
        }
    }

    public static function buildMenu($menu, $parentid = 0)
    {
        $result = null;
        foreach ($menu as $item) {
            if ($item->parent_id == null) {
                $getChild = Menu::where('parent_id', $item->id)->get();
                if ($getChild->count() != 0) {
                    $result .= "<li class='".self::check_active($item->slug)."'><a href='#'>".$item->title."</a><ul class='dropdown'>";
                    foreach ($getChild as $itemChild) {
                        $result .= "<li><a href='".$itemChild->slug."'>".$itemChild->title.'</a></li>';
                    }
                    $result .= '</ul></li>';
                } else {
                    $result .= "<li class='".self::check_active($item->slug)."'><a href='".$item->slug."'>".$item->title.'</a></li>';
                }
            }
        }

        return $result ? $result : '';
    }

    public static function getMenus($slug)
    {
        $layouts = Layout::where('slug', $slug)->get()->first();

        return $layouts;
    }

    public static function getTags($id)
    {
        $getData = Post::find($id);
        $tags = $getData->tags;
        $out = '';
        $tagging = [];
        if ($tags->count() != 0) {
            $out = "<i class='fa fa-tags text-theme-colored'></i> <span>tag : ";
            foreach ($tags as $key => $value) {
                $tagging[] = "<a class='text-black' href='".route('home.showTags', $value->slug)."'>".$value->name.'</a>';
            }
        }

        return $out.implode(', ', $tagging);
    }

    public static function getCategories()
    {
        $cats = Category::get();
        $out = '';
        foreach ($cats as $key => $value) {
            $countThis = Post::where('status', 1)->where('category_id', $value->id)->count();
            $out .= '<li><a href="'.route('home.showCategories', $value->slug).'">'.$value->name.'<span> ('.$countThis.')</span></a></li>';
        }

        return $out;
    }

    public static function getLastNews($idEx = null, $page = null)
    {
        $segment = Request::segment(1);
        $news = Post::where('status', 1)
            ->where(function ($x) use ($segment, $idEx) {
                if ($segment != 'p' && $segment != 'announcement') {
                    if ($idEx != null) {
                        $x->where('id', '!=', $idEx);
                    }
                }
            })->orderBy('publish_date', 'desc')->limit('5')->get();

        return $news;
    }

    public static function getSidebarTopAds($position)
    {
        $getSidebarTop = Iklan::where('status', 1)->where('position', (int) $position)->get();
        $out = '';
        foreach ($getSidebarTop as $key => $value) {
            $out .= '<div class="widget">';
            $out .= '<a href="'.$value->tautan.'">';
            $out .= '<img src="'.self::getImage($value->id_media).'" width="100%" />';
            $out .= '</a>';
            $out .= '</div>';
        }

        return $out;
    }

    public static function getMessage()
    {
        return collect([]);
    }

    public static function getSlider($limit = 3)
    {
        $slider = Slider::orderby('order', 'asc')->limit($limit)->get();

        return $slider;
    }

    public static function getLinks($position = 0)
    {
        $links = Links::where(function ($x) use ($position) {
            if ($position != 0) {
                $x->where('position', $position);
            }
        })->orderBy('order', 'asc')->get();

        return $links;
    }

    public static function getNews($limit = 4)
    {
        $news = Post::where('status', 1)->orderBy('publish_date', 'desc')->limit($limit)->get();

        return $news;
    }

    public static function getAgenda($exclude = null, $limit = 5)
    {
        $agendas = Agenda::where(function ($x) use ($exclude) {
            if ($exclude != null) {
                $x->where('id', '!=', $exclude);
            }
        })
            ->orderBy('start', 'desc')->limit($limit)->get();

        return $agendas;
    }

    public function getHomepageAds()
    {
        $getHomepageAds = Iklan::where('status', 1)->where('position', 1)->get()->first();

        return $getHomepageAds;
    }

    public static function getNav($loc, $class = '')
    {
        $menu = self::getMenus($loc);
        $output = null;
        if (! empty($menu)) {
            $getMenu = self::getMenus($loc)->menulayout->sortBy('order');
            $output = self::buildMenu($getMenu, $class);
        } else {
            $output = '';
        }

        return $output;
    }

    public static function advertisement($loc)
    {
        $ads = Iklan::where('position', $loc)->get();

        return $ads;
    }

    public static function getAnnouncement($limit = 4)
    {
        $announcement = Announcement::limit($limit)->get();

        return $announcement;
    }

    public static function getGallery($limit = 6)
    {
        $gallery = Gallery::limit($limit)->get();

        return $gallery;
    }
}
