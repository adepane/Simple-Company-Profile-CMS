<?php

namespace App\Http\Controllers;

use App\Models\Layout;
use App\Models\Menu;
use Illuminate\Http\Request;
use Str;

class LayoutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $getModul = Layout::paginate(10);
        return view('panel.menu.index',['data'=>$getModul]);
    }


    public function create()
    {
        return view('panel.menu.create');
    }

    public function store(Request $request)
    {
        
        $modul = new Layout;
        $modul->name = $request->name;
        $modul->slug = Str::slug($request->name);
        if ($modul->save()) {
            return redirect()->route('menu.index')->with('message', 'Menu telah ditambah');
        }  
    }

    public function buildMenu($menu, $parentid = 0)
    {
        $result = null;
        foreach ($menu as $item)
            if ($item->parent_id == $parentid) {
                $result .= "<li class='dd-item kt-avatar kt-avatar--outline' data-order='{$item->order}' data-id='{$item->id}'>
                <div class='dd-handle col-6'>
                    {$item->title}
                </div>
                <label class='kt-avatar__upload ubahmenu' data-title='" . $item->title . "' data-slug='" . $item->slug . "' id-menu='" . $item->id . "' data-toggle='kt-tooltip' title='' data-original-title='Ubah Menu'>
                    <i class='fa fa-pencil-alt'></i>
                </label>" . $this->buildMenu($menu, $item->id) . "</li>";
            }
        return $result ?  "\n<ol class=\"dd-list MenuHere\">\n$result</ol>\n" : "\n<ol class=\"dd-list MenuHere\"></ol>\n";
    }

    public function getHTML($items)
    {
        return $this->buildMenu($items);
    }

    public function show($id)
    {
        $getModul = Menu::where('layout_id',$id)->orderby('order', 'asc')->get();
        $data = Layout::find($id);
        $menu = $this->getHTML($getModul);
        return view('panel.menu.show', ['menu'=>$menu,'data'=>$data]);
    }

    public function edit($id)
    {
        $modul = Layout::find($id);
        return view('panel.menu.edit', ['data' => $modul]);
    }

    public function update(Request $request, $id)
    {
        $modul = Layout::find($id);
        $modul->name = $request->name;
        $modul->slug = Str::slug($request->name);
        if ($modul->save()) {
            return redirect()->route('menu.index')->with('message', 'Menu telah diupdate');
        }  
    }

    function destroy($id)
    {
        $modul = Layout::find($id);
        if ($modul->delete()) {
            if ($modul->menulayout()->delete()) {
                return redirect()->route('menu.index')->with('message', 'Menu telah dihapus');

            }
        }  
    }
}
