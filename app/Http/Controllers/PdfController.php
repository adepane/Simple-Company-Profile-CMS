<?php

namespace App\Http\Controllers;

use App\Models\Pdf;
use Illuminate\Http\Request;
use Str;
use File;

class PdfController extends Controller
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
        $getModul = Pdf::paginate(20)->onEachSide(2);
        return view('panel.pdf.index',['data'=>$getModul]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('panel.pdf.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $media = $request->file('filepdf');
        if ($media != "") {
            foreach ($media as $value) {
                $newPdf = new Pdf;
                $ext = $value->guessClientExtension();
                $mimeType = $value->getClientMimeType();
                $newdate = date("YmdHis");
                $origName = preg_replace('/\\.[^.\\s]{3,4}$/', '', $value->getClientOriginalName());
                $path = $value->storeAs("pdf", Str::slug($origName . "-" . $newdate).".".$ext, 'uploadfile');
                $newPdf->path = $path;
                $newPdf->name = $origName;
                $newPdf->save();
            }
        }
        return redirect()->route('pdf.index')->with('message', 'Pdf telah ditambah');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $media = $request->file('filepdf');
        if ($media != "") {
            $newPdf = Pdf::find($id);
            $ext = $media->guessClientExtension();
            $mimeType = $media->getClientMimeType();
            $newdate = date("YmdHis");
            $origName = preg_replace('/\\.[^.\\s]{3,4}$/', '', $media->getClientOriginalName());
            $path = $media->storeAs("pdf", Str::slug($origName . "-" . $newdate).".".$ext, 'uploadfile');
            $newPdf->path = $path;
            $newPdf->name = $origName;
            if ($newPdf->update()) {
            return redirect()->route('pdf.index')->with('message', 'Pdf telah diupdate');
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
        $modul = Pdf::find($id);
        $pdf_path = public_path("files/".$modul->path);
        if ($modul->delete()) {
            if (File::exists($pdf_path)) {
                File::delete($pdf_path);
                return redirect()->back()->with('message', 'Pdf telah dihapus');
            }
        }
    }
}
