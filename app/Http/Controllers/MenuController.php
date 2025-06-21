<?php

namespace App\Http\Controllers;

use App\models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        $modul = new Menu;
        $modul->title = $request->input('title');
        $modul->slug = $request->input('slug');
        $modul->order = Menu::where('layout_id', (int) $request->layout_id)->max('order') + 1;
        $modul->layout_id = (int) $request->layout_id;
        $returnData = [];
        if ($modul->save()) {
            $returnData['status'] = 1;
            $returnData['message'] = 'Sukses Menambah Menu';
            $returnData['menuId'] = $modul->id;
            $returnData['menuTitle'] = $modul->title;
            $returnData['menuSlug'] = $modul->slug;
        } else {
            $returnData['status'] = 0;
            $returnData['message'] = 'Gagal Menambah Menu';
            $returnData['menuId'] = null;
            $returnData['menuTitle'] = null;
            $returnData['menuSlug'] = null;

        }

        return $returnData;
    }

    public function update(Request $request, $id)
    {
        $modul = Menu::find($id);
        $modul->title = $request->input('title');
        $modul->slug = $request->input('slug');
        if ($modul->update()) {
            return redirect()->back()->with('message', 'Menu telah diupdate');
        }

    }

    public function destroy($id)
    {
        $modul = Menu::find($id);
        if ($modul->delete()) {
            return redirect()->back()->with('message', 'Menu telah dihapus');
        }
    }

    public function reOrder(Request $request)
    {
        $list = json_decode($request->list);
        foreach ($list as $key => $value) {
            if (property_exists($value, 'id')) {
                $modul = Menu::find((int) $value->id);
                $modul->order = (int) $key;
                $modul->parent_id = null;
                $modul->update();
                if (property_exists($value, 'children')) {
                    foreach ($value->children as $keyChildren => $valueChildren) {
                        $modul = Menu::find((int) $valueChildren->id);
                        $modul->parent_id = (int) $value->id;
                        $modul->order = $keyChildren;
                        $modul->update();
                    }
                }
            }
        }

        return redirect()->back()->with('message', 'Menu telah diupdate');
    }
}
