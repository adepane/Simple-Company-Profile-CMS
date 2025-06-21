<?php

namespace App\Http\Controllers;

use App\Models\Document;
use File;
use Illuminate\Http\Request;
use Str;
use Validator;

class DocumentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $getModul = Document::paginate(20)->onEachSide(2);

        return view('panel.document.index', ['data' => $getModul]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('panel.document.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $media = $request->file('filepdf');
        if ($media != '') {
            foreach ($media as $value) {
                $newDocument = new Document;
                $ext = $value->guessClientExtension();
                $mimeType = $value->getClientMimeType();
                $newdate = date('YmdHis');
                $origName = preg_replace('/\\.[^.\\s]{3,4}$/', '', $value->getClientOriginalName());
                $path = $value->storeAs('pdf', Str::slug($origName.'-'.$newdate).'.'.$ext, 'uploadfile');
                $newDocument->path = $path;
                $newDocument->name = $origName;
                $newDocument->save();
            }
        }

        return redirect()->route('document.index')->with('message', 'Document telah ditambah');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $media = $request->file('filepdf');
        if ($media != '') {
            $newDocument = Document::find($id);
            $ext = $media->guessClientExtension();
            $mimeType = $media->getClientMimeType();
            $newdate = date('YmdHis');
            $origName = preg_replace('/\\.[^.\\s]{3,4}$/', '', $media->getClientOriginalName());
            $path = $media->storeAs('pdf', Str::slug($origName.'-'.$newdate).'.'.$ext, 'uploadfile');
            $newDocument->path = $path;
            $newDocument->name = $origName;
            if ($newDocument->update()) {
                return redirect()->route('document.index')->with('message', 'Document telah diupdate');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $modul = Document::find($id);
        $pdf_path = public_path('files/'.$modul->path);
        if ($modul->delete()) {
            if (File::exists($pdf_path)) {
                File::delete($pdf_path);

                return redirect()->back()->with('message', 'Document telah dihapus');
            }
        }
    }

    public function modalshow()
    {
        $getModul = Document::orderBy('id', 'desc')->paginate(18)->onEachSide(2);

        return view('panel.document.modal', ['data' => $getModul]);
    }

    public function ajaxStore(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            ['files' => 'nullable|mimes:pdf']
        );
        $dataFailDocument = [];
        $dataFailDocument['status'] = 0;
        $dataFailDocument['message'] = 'Upload Failed, File Tidak diizinkan!';
        $dataFailDocument['documentId'] = null;
        $dataFailDocument['path'] = null;
        if ($validator->fails()) {
            return response()->json($dataFailDocument, 200);
        }
        $modul = new Document;
        $media = $request->file('files');
        if ($media != '') {
            $ext = $media->guessClientExtension();
            $mimeType = $media->getClientMimeType();
            $newdate = date('YmdHis');
            $origName = preg_replace('/\\.[^.\\s]{3,4}$/', '', $media->getClientOriginalName());
            $origName = str_replace(' ', '-', $origName);
            $path = $media->storeAs('pdf', $origName.'_'.$newdate.'.'.$ext, 'uploadfile');
            $modul->path = $path;
            $modul->name = $origName;
        }
        $dataReturn = [];
        if ($modul->save()) {
            $dataReturn['status'] = 1;
            $dataReturn['message'] = 'Upload Success';
            $dataReturn['documentId'] = $modul->id;
            $dataReturn['path'] = $modul->path;
        } else {
            $dataReturn['status'] = 0;
            $dataReturn['message'] = 'Upload Failed';
            $dataReturn['documentId'] = null;
            $dataReturn['path'] = null;
        }

        return $dataReturn;
    }
}
