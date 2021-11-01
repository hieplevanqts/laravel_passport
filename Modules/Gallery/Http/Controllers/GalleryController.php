<?php

namespace Modules\Gallery\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Gallery\Entities\Gallery;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $data['list'] = Gallery::orderBy('sort', 'asc')->paginate(20);
        return view('gallery::index', $data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('gallery::add');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('gallery::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('gallery::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $item = Gallery::findOrFail($id);
        if(@$item)
        {
            if(file_exists(@$item->url))
            {
                $arr = explode("http", @$item->url);
                if(count($arr) > 1)
                {

                }else{
                    unlink(@$item->url);
                }
            }
            $item->delete();
            return response()->json(["status"=>200, "message"=>"Thành công", "result"=>"Xóa thành công"]);
        }else{
            return response()->json(["status"=>201, "message"=>"Thất bại", "result"=>"Xóa thất bại"]);
        }
    }

    public function uploadMultiFile($fileObj, $altExtra, $imgOld = null, $module)
    {
        $path = 'upload/tmp/';
        $path_after = 'upload/files/';
        $arrExtra = [];

        foreach ($fileObj as $key => $value) {
                $this->removeFile(@$imgOld[$key]['image']);
                $fileNameExtra = $this->randomFileName($fileObj[$key]);
                $item = new Gallery;
                $item->url = $path_after . $fileNameExtra;
                $item->alt = @$altExtra[$key];
                $item->sha1_text = md5($fileNameExtra);
                $item->module = $module;
                if($item->save())
                {
                    copy($path . $value, $path_after . $fileNameExtra);
                }
                $arrExtra[$key]['image'] = $fileNameExtra;
                $arrExtra[$key]['alt']      = !empty($altExtra[$key]) ? $altExtra[$key] : '';
        }


    }

    public function postAdd(Request $request)
    {
        $alts           = $request->alts;
        $images         = $request->images;
        $module         = $request->module;

        $arrImage    = $this->uploadMultiFile($images, $alts, null, $module);
        return redirect('admin/gallery');
    }

    public function randomFileName($fileName, $length = 9){
        $arrCharacter = array_merge(range('A', 'Z'), range('a', 'z'), range(0, 9));
        $arrCharacter = implode('', $arrCharacter);
        $arrCharacter = str_shuffle($arrCharacter);
        $extension = '.' . pathinfo($fileName, PATHINFO_EXTENSION);
        $result = substr($arrCharacter, 0, $length) . $extension;

        return $result;
    }

    public function removeFile($fileName){
        $path       = 'upload/tmp/';
        $fileName   = $path . $fileName;
        if(file_exists($fileName)){
            @unlink($fileName);
        }
    }

    public function handleUpload()
    {

            $storeFolder = 'upload/tmp/';
            if(!file_exists($storeFolder) && !is_dir($storeFolder)) {
                mkdir($storeFolder);
            }

            if (!empty($_FILES)) {

                foreach($_FILES['file']['tmp_name'] as $key => $value) {
                    $tempFile = $_FILES['file']['tmp_name'][$key];
                    $targetFile =  $storeFolder. $_FILES['file']['name'][$key];
                    move_uploaded_file($tempFile,$targetFile);
                }
            }

    }

    public function uploadImg()
    {
        if($request->hasFile('files'))
        {
            $file               = $request->file('files');
            $location           = "upload/files";
            $file->move($location, $file->getClientOriginalName());
            $item = new Gallery;
            $item->url          = $location. '/'. $file->getClientOriginalName();
            $item->alt          = md5($file->getClientOriginalName());
            $item->sha1_text    = md5($file->getClientOriginalName());
            $item->module       = $request->md;
            $item->save();
            return json_encode(true);
        }else{
            return json_encode(false);
        }
    }

    public function sort(Request $request)
    {
        $positions  = $request->positions;
        $page       = $request->page;
        $limit      = $request->limit;
        foreach ($positions as $key => $value) {
            if($page==1)
                {
                    $sort = $positions[$key][1];
                }else{
                    $sort = $page * $limit + $positions[$key][1];
                }
                $gallery = Gallery::findOrFail($positions[$key][0]);
                $gallery->sort = $sort;
                $gallery->save();
        }
        return true;
    }

}
