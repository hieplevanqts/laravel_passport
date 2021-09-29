<?php

namespace Modules\Local\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;
use Modules\Local\Entities\Ward;
use Modules\Local\Entities\Province;
use Modules\Local\Entities\District;


class WardController extends Controller
{
    public function index(Request $request)
    {
        if($request->district=='')
        {
            $request->district = $request->district_hidden;
        }


        if($request->district)
        {
            if($request->name)
            {
                $data['list'] = Ward::where("district_id", @$request->district)->where("name", 'like', "%$request->name%")->paginate(20);
            }else{
                $data['list'] = Ward::where("district_id", @$request->district)->paginate(20);
            }
        }
        if($request->name)
        {
            if($request->district)
            {
                $data['list'] = Ward::where("district_id", @$request->district)->where("name", 'like', "%$request->name%")->paginate(20);
            }else{
                $data['list'] = Ward::where("name", 'like', "%$request->name%")->paginate(20);
            }
        }

        if(!$request->name && !$request->district)
        {
            $data['list'] = Ward::paginate(20);
        }

        $data['provinces'] = Province::all();
        $data['districts'] = District::all();

        return view("local::local.ward.list", $data);
    }

    public function edit($id)
    {
        $data['item'] = Ward::findOrFail($id);
        $data['provinces'] = Province::all();
        $data['action'] = 'Sửa xã/phường';
        return response()->json(["status"=>200, "message"=>"Thành công", "result"=>$data]);
    }

    public function postEdit(Request $request)
    {
        if($request->id)
        {
            $item = Ward::findOrFail($request->id);
            if($item!=='')
            {
                $item->name = $request->name;
                $item->slug = Str::of($request->name)->slug('-');
                // $item->district_id  = (int)$request->district;
                $item->save();
                $request->session()->flash('mess', "Cập nhật thành công");
                return response()->json(["status"=>200, "message"=>"Cập nhật thành công", "result"=>$item]);
            }else{
                $request->session()->flash('mess', "Cập nhật thất bại");
                return response()->json(["status"=>201, "message"=>"Cập nhật thất bại", "result"=>"Không tồn tại !"]);
            }
        }else{
            $ward = new Ward($request->all());
            $ward->slug = Str::of($request->name)->slug('-');
            $ward->save();
            $request->session()->flash('mess', "Thêm thành công");
            return response()->json(["status"=>200, "message"=>"Thêm thành công", "result"=>$ward]);
        }

    }

    public function delete($id)
    {
        $item = Ward::findOrFail($id);
        if($item)
        {
            $item->delete();
            return redirect('admin/ward')->with('mess', 'Xóa thành công');
        }else{
            return redirect('admin/ward')->with('error', 'Xóa thất bại');
        }
    }
}
