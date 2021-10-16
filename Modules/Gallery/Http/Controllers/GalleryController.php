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
        $path = 'upload/tmp';
        $arrExtra = [];
        // dd($altExtra);
        foreach ($fileObj as $key => $value) {
            // if(!empty($fileObj['tmp_name'][$key])){

                $this->removeFile(@$imgOld[$key]['image']);  // remove image old

                $fileNameExtra = $this->randomFileName($fileObj[$key]);
                // move_uploaded_file($fileObj['tmp_name'][$key], PATH_UPLOAD . $fileNameExtra['image']);
                $item = new Gallery;
                $item->url = 'upload/files/'. $fileNameExtra;
                $item->alt = @$altExtra[$key];
                $item->sha1_text = md5($fileNameExtra);
                $item->module = $module;
                if($item->save())
                {
                    copy('upload/tmp/'. $value, 'upload/files/'. $fileNameExtra);
                }

                $arrExtra[$key]['image'] = $fileNameExtra;
            // }else{
            //     $arrExtra[$key]['image'] = !empty($imgOld[$key]['image']) ? $imgOld[$key]['image'] : '';
            // }
            $arrExtra[$key]['alt']      = !empty($altExtra[$key]) ? $altExtra[$key] : '';
        }


    }

    public function postAdd(Request $request)
    {
        // return $request->all();
        $id = null;
        $product = null;
        $name = @$_POST['name'];
        $price = @$_POST['price'];
        $alts = @$_POST['alts'];
        $description = @$_POST['description'];
        $images = @$_POST['images'];
        $module = $request->module;
        // dd($module);
        // $arrDeleteImg = [];
        // if(isset($_POST['image_delete'])){
        //     foreach ($_POST['image_delete'] as $key => $value) {
        //         $arrDeleteImg[$value] = $product['images'][$value];
        //     }
        // }
        // $arrNew = array_diff_key($product['images'], $arrDeleteImg);

        // $imageOld = array_values($arrNew);

        $arrImage    = $this->uploadMultiFile($images, $alts, null, $module);  // upload image extra
        return redirect('admin/gallery');
        $item = [
            'id' => $id,
            'name' => $name,
            'price' => $price,
            'description' => $description,
            'images' => $arrImage,
        ];

        // if($type == 'edit'){
        //     $obj->update($item);
        //     $_SESSION['message']['success'] = 'Cập nhật sản phẩm thành công!';
        // }else{
        //     $obj->add($item);
        //     $_SESSION['message']['success'] = 'Thêm mới sản phẩm thành công!';
        // }
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
        $path = 'upload/tmp';
        $fileName   = $path . $fileName;
        if(file_exists($fileName)){
            @unlink($fileName);
        }
    }

    public function handleUpload()
    {
            // define absolute folder path
            $storeFolder = 'upload/tmp/';
            // if folder doesn't exists, create it
            if(!file_exists($storeFolder) && !is_dir($storeFolder)) {
                mkdir($storeFolder);
            }

            // upload files to $storeFolder
            if (!empty($_FILES)) {

                /**
                 *  uploadMultiple = false
                 *  When uploading file by file, upload on fly
                 *
                 */
                // $tempFile = $_FILES['file']['tmp_name'];
                // $targetFile =  $storeFolders . $_FILES['file']['name'];
                // move_uploaded_file($tempFile,$targetFile);

            /**
                 *  uploadMultiple = true
                 *  When uploading multiple files in a single request.
                 *  Way to go if using dropzone in a form with other fields,
                 *  and when uploading files on form submit via button... myDropzone.processQueue();
                 *
                 *  $_FILES['file']['tmp_name'] is an array so have to use loop
                 *
                 */
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
            $file = $request->file('files');
            $location = "upload/files";
            $file->move($location, $file->getClientOriginalName());
            $item = new Gallery;
            $item->url = $location. '/'. $file->getClientOriginalName();
            $item->alt = md5($file->getClientOriginalName());
            $item->sha1_text = md5($file->getClientOriginalName());
            $item->module = $request->md;
            $item->save();

            return json_encode(true);
        }else{
            return json_encode(false);
        }
    }

    public function sort(Request $request)
    {
        $positions = $request->positions;
        $page = $request->page;
        $limit = $request->limit;
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
