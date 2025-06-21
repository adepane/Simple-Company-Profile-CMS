<?php

namespace App\Http\Controllers;

use App\Models\Media;
use File;
use Illuminate\Http\Request;
use Image;
use Str;
use Validator;

class MediaController extends Controller
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
        $getModul = Media::orderBy('id', 'desc')->paginate(20)->onEachSide(2);

        return view('panel.media.index', ['data' => $getModul]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('panel.media.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $media = $request->file('filemedia');
        if ($media != '') {
            foreach ($media as $value) {
                $newPicture = new Media;
                $ext = $value->guessClientExtension();
                $mimeType = $value->getClientMimeType();
                $newdate = date('YmdHis');
                $origName = preg_replace('/\\.[^.\\s]{3,4}$/', '', $value->getClientOriginalName());
                $path = $value->storeAs('foto', Str::slug($origName.'-'.$newdate).'.'.$ext, 'uploadfile');
                $newPicture->path = $path;
                $newPicture->mime = $mimeType;

                $image = Image::make(public_path('files/'.$path));
                $image->resize(220, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $new220Pic = Str::slug($origName.'_'.$newdate.'-resize-220');
                $image->save(public_path('files/foto/'.$new220Pic.'.'.$ext));
                $newPicture->path_220 = 'foto/'.$new220Pic.'.'.$ext;
                $newPicture->save();
            }
        }

        return redirect()->route('media.index')->with('message', 'File telah ditambah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $modul = Media::find($id);
        $image_path = public_path('files/'.$modul->path);
        if ($modul->delete()) {
            if (File::exists($image_path)) {
                File::delete($image_path);

                return redirect()->back()->with('message', 'Gambar telah dihapus');
            }
        }
    }

    public function ajaxStore(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            ['files' => 'nullable|image|mimes:jpeg,png,jpg,gif']
        );
        $dataFailImage = [];
        $dataFailImage['status'] = 0;
        $dataFailImage['message'] = 'Upload Failed, File Tidak diizinkan!';
        $dataFailImage['imageId'] = null;
        $dataFailImage['path'] = null;
        if ($validator->fails()) {
            return response()->json($dataFailImage, 200);
        }
        $modul = new Media;
        $media = $request->file('files');
        if ($media != '') {
            $ext = $media->guessClientExtension();
            $mimeType = $media->getClientMimeType();
            $newdate = date('YmdHis');
            $origName = preg_replace('/\\.[^.\\s]{3,4}$/', '', $media->getClientOriginalName());
            $origName = str_replace(' ', '-', $origName);
            $path = $media->storeAs('foto', $origName.'_'.$newdate.'.'.$ext, 'uploadfile');
            $modul->path = $path;
            $modul->mime = $mimeType;

            $image = Image::make(public_path('files/'.$path));
            $image->resize(220, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $image->save(public_path('files/foto/'.$origName.'_'.$newdate.'-resize-220'.'.'.$ext));
            $modul->path_220 = 'foto/'.$origName.'_'.$newdate.'-resize-220'.'.'.$ext;
        }
        $dataReturn = [];
        if ($modul->save()) {
            $dataReturn['status'] = 1;
            $dataReturn['message'] = 'Upload Succes';
            $dataReturn['imageId'] = $modul->id;
            $dataReturn['path'] = $modul->path;
        } else {
            $dataReturn['status'] = 0;
            $dataReturn['message'] = 'Upload Failed';
            $dataReturn['imageId'] = null;
            $dataReturn['path'] = null;
        }

        return $dataReturn;
    }

    public function modalshow()
    {
        $getModul = Media::orderBy('id', 'desc')->paginate(18)->onEachSide(2);

        return view('panel.media.modal', ['data' => $getModul]);
    }

    public function modalShowGallery(Request $request)
    {
        $getModul = Media::orderBy('id', 'desc')->paginate(18)->onEachSide(2);

        return view('panel.media.modal_gallery', ['data' => $getModul, 'container' => $request->mediaIds]);
    }
}
