<?php

namespace Modules\Local\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Routing\Controller;
use Modules\Local\Entities\Province;

class ProvinceController extends Controller
{
    public function index(Request $request)
    {
        if($request->name)
        {
            if($request->area)
            {
                $data["list"] = $request->_token ? Province::where("region", $request->area)->where("name", 'like', "%$request->name%")->paginate(20) : Province::paginate(20);
            }else{
                $data["list"] = $request->_token ? Province::where("name", 'like', "%$request->name%")->paginate(20) : Province::paginate(20);
            }
        }

        if($request->area)
        {
            if($request->name)
            {
                $data["list"] = $request->_token ? Province::where("region", $request->area)->where("name", 'like', "%$request->name%")->paginate(20) : Province::paginate(20);
            }else{
                $data["list"] = $request->_token ? Province::where("region", $request->area)->paginate(20) : Province::paginate(20);
            }
        }
        if(!$request->name && !$request->area)
        {
            $data["list"] = Province::paginate(20);
        }

        return view('local::local.province.list', $data);
    }

    public function edit($id)
    {
        $data['item'] = Province::findOrFail($id);
        $data['action'] = 'Sửa tỉnh/tp';
        return response()->json(["status"=>200, "message"=>"Thành công", "result"=>$data]);
    }

    public function postEdit(Request $request)
    {
        if($request->id)
        {
            $item = Province::findOrFail($request->id);
            if($item!=='')
            {
                $item->name = $request->name;
                $item->slug = Str::of($request->name)->slug('-');
                $item->region = (int)$request->region;
                $item->save();
                $request->session()->flash('mess', "Cập nhật thành công");
                return response()->json(["status"=>200, "message"=>"Cập nhật thành công", "result"=>$item]);
            }else{
                $request->session()->flash('error', "Cập nhật thất bại");
                return response()->json(["status"=>201, "message"=>"Cập nhật thất bại", "result"=>"Không tồn tại !"]);
            }
        }else{
            $province = new Province($request->all());
            $province->slug = Str::of($request->name)->slug('-');
            $province->save();
            $request->session()->flash('mess', "Thêm thành công");
            return response()->json(["status"=>200, "message"=>"Thêm thành công", "result"=>$province]);
        }

    }

    public function delete($id)
    {
        Province::findOrFail($id)->delete();
        return redirect('admin/province')->with("mess", "Xóa thành công");
    }
}
