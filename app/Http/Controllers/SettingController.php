<?php

namespace App\Http\Controllers;

use App\Models\Layout;
use App\Models\Settings;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function randStr($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        return $randomString;
    }

    public function index()
    {
        $settings = Settings::get();
        $dataSetting = [];
        foreach ($settings as $key => $setting) {
            $dataSetting[$setting->name] = $setting;
        }
        $layout = Layout::pluck('name', 'slug')->all();
        $data = [
            'title' => [
                'name' => 'Title',
                'type' => 'text',
                'value' => 'title',
            ],
            'tagline' => [
                'name' => 'Tagline',
                'type' => 'text',
                'value' => 'tagline',
            ],
            'description' => [
                'name' => 'Description',
                'type' => 'textarea',
                'value' => 'description',
            ],
            'keyword' => [
                'name' => 'Meta Keyword',
                'type' => 'text',
                'value' => 'keyword',
            ],
            'phone' => [
                'name' => 'Phone',
                'type' => 'text',
                'value' => 'phone',
            ],
            'email' => [
                'name' => 'E-mail',
                'type' => 'text',
                'value' => 'email',
            ],
            'address' => [
                'name' => 'Alamat',
                'type' => 'textarea',
                'value' => 'address',
            ],
            'facebook' => [
                'name' => 'Facebook',
                'type' => 'text',
                'value' => 'facebook',
            ],
            'twitter' => [
                'name' => 'Twitter',
                'type' => 'text',
                'value' => 'twitter',
            ],
            'twitter' => [
                'name' => 'Twitter',
                'type' => 'text',
                'value' => 'twitter',
            ],
            'instagram' => [
                'name' => 'Instagram',
                'type' => 'text',
                'value' => 'instagram',
            ],
            'yt_channel' => [
                'name' => 'YouTube Channel',
                'type' => 'text',
                'value' => 'yt_channel',
            ],

            'favicon' => [
                'name' => 'Favicon',
                'type' => 'file',
                'value' => 'favicon',
            ],
            'logo' => [
                'name' => 'Logo',
                'type' => 'file',
                'value' => 'logo',
            ],
            'logo_footer' => [
                'name' => 'Logo Footer',
                'type' => 'file',
                'value' => 'logo_footer',
            ],
            'defaultimage' => [
                'name' => 'Default Image',
                'type' => 'file',
                'value' => 'defaultimage',
            ],
            'header_script' => [
                'name' => 'Header Script',
                'type' => 'textarea',
                'value' => 'header_script',
            ],
            'menu_top' => [
                'name' => 'Main Menu',
                'type' => 'select',
                'value' => 'menu_top',
                'options' => $layout,
            ],
            'menu_bottom' => [
                'name' => 'Footer Menu',
                'type' => 'select',
                'value' => 'menu_bottom',
                'options' => $layout,
            ],
            'site_link' => [
                'name' => 'Site Link',
                'type' => 'select',
                'value' => 'site_link',
                'options' => $layout,
            ],
            'slideshow' => [
                'name' => 'Number of slide',
                'type' => 'text',
                'value' => 'slideshow',
            ],

        ];

        return view('panel.setting.index', compact(['dataSetting', 'data']));
    }

    public function store()
    {
        // dd(request()->all());
        $valueSets = request('sets');
        foreach ($valueSets as $key => $value) {
            if ($key == 'text') {
                foreach ($value as $keyName => $valueVal) {
                    if (! empty($keyName)) {
                        $modul = Settings::updateOrCreate(
                            ['name' => $keyName],
                            ['val' => $valueVal]
                        );
                    }
                }
            } else {
                foreach ($value as $keyName => $valueVal) {
                    if ($valueVal != '') {
                        $ext = $valueVal->guessClientExtension();
                        $path = $valueVal->storeAs('assets', 'img_'.$this->randStr(15).'_'.date('dmYHis').'.'.$ext, 'uploadfile');

                    } else {
                        $path = null;
                    }
                    $modul = Settings::updateOrCreate(
                        ['name' => $keyName],
                        ['val' => $path]
                    );
                }
            }

        }

        return $this->index();
    }

    public function deleted()
    {
        $getSetting = Settings::find(request('data'));
        if ($getSetting->delete()) {
            return response()->json(['status' => 1, 'message' => 'telah dihapus']);
        }

    }
}
