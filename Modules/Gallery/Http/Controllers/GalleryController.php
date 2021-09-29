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
        $data['list'] = Gallery::paginate(20);
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

    public function postAdd(Request $request)
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
}
