<?php

namespace Modules\Local\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;
use Modules\Local\Entities\District;
use Modules\Local\Entities\Province;

class DistrictController extends Controller
{
    public function index(Request $request)
    {
        if($request->name)
        {
            if($request->province)
            {
                $data['list'] = District::where("province_id", @$request->province)->where("name", 'like', "%$request->name%")->paginate(20);
            }else{
                $data['list'] = District::where("name", 'like', "%$request->name%")->paginate(20);
            }
        }

        if(@$request->province)
        {
            if($request->name)
            {
                $data['list'] = District::where("province_id", @$request->province)->where("name", 'like', "%$request->name%")->paginate(20);
            }else{
                $data['list'] = District::where("province_id", @$request->province)->paginate(20);
            }
        }

        if(!@$request->name && !$request->province)
        {
            $data['list'] = District::paginate(20);
        }
        $data['provinces'] = Province::all();
        return view('local::local.district.list', $data);
    }

    public function edit($id)
    {
        $data['item'] = District::findOrFail($id);
        $data['action'] = 'Sửa quận/huyện';
        $data['provinces'] = Province::all();
        return response()->json(["status"=>200, "message"=>"Thành công", "result"=>$data]);

    }

    public function postEdit(Request $request)
    {
        if($request->id)
        {
            $item = District::findOrFail($request->id);
            if($item!=='')
            {
                $item->name = $request->name;
                $item->province_id = (int)$request->province_id;
                $item->slug = Str::of($request->name)->slug('-');
                $item->save();
                $request->session()->flash('mess', "Cập nhật thành công");
                return response()->json(["status"=>200, "message"=>"Cập nhật thành công", "result"=>$item]);
            }else{
                $request->session()->flash('mess', "Cập nhật thất bại");
                return response()->json(["status"=>201, "message"=>"Cập nhật thất bại", "result"=>"Không tồn tại !"]);
            }
        }else{
            $district = new District($request->all());
            $district->slug = Str::of($request->name)->slug('-');
            $district->save();
            $request->session()->flash('mess', "Thêm thành công");
            return response()->json(["status"=>200, "message"=>"Thêm thành công", "result"=>$district]);
        }

    }

    public function delete($id)
    {
        $district = District::findOrFail($id);
        $district->delete();
        return redirect('admin/district')->with('mess', 'Xóa thành công');
    }

    public function listByProvince($province_id)
    {
        $list = District::where("province_id", $province_id)->get();
        return response()->json(["status"=>200, "message"=>"Thành công", "result"=>$list]);
    }

    public function allProvince()
    {
        $list = Province::all();
        return response()->json(["status"=>200, "message"=>"Thành công", "result"=>$list]);
    }
}
