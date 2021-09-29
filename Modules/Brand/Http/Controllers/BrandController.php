<?php

namespace Modules\Brand\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Brand\Entities\Brand;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $input = $request->all();
        foreach($input as $key => $value)
        {
            if($value == null)
            {
                unset($input[$key]);
            }
        }

        if($input)
        {
            $where = [];
            if($request->status=='true')
            {
                $request->status_new = 1;
            }else{
                $request->status_new = 0;
            }


            $where = $request->type ? array_merge($where, ["type"=>$request->type]) : $where;

            if($request->status=='all')
            {

            }else{
                $where =  array_merge($where, ["status"=>$request->status_new]) ;
            }
            $data['list'] = $request->name ? Brand::where($where)->where('name', 'like', "%$request->name%")->orderBy('id','DESC')->paginate(20) : Brand::where($where)->orderBy('id','DESC')->paginate(20);

        }else{
            $data['list'] = Brand::orderBy('id','DESC')->paginate(20);
        }
        $data['data_type'] = config('data_type_vn', []);
        return view('brand::index', $data);
    }

    public function delete(Request $request, $id)
    {
        $brand = Brand::findOrFail($id);
        if(file_exists($brand->image))
        {
            unlink($brand->image);
        }
        $brand->delete();
        $request->session()->flash("success", "Xóa thành công");
        return redirect('admin/brand');
    }

    public function add(Request $request)
    {
        $id = $request->edit;
        if($id!=null)
        {
            $brand = Brand::findOrFail($id);
            $brand->name = $request->name;
            $brand->description = $request->description;
            $brand->type = $request->type;
        }else{
            $brand = new Brand($request->all());
        }

        if($request->all())
        {
            $path = 'upload/brands/';

            $brand->slug = Str::of($request->name)->slug('-');
            $brand->status = $request->status == true ? 1 : 0 ;
            if($request->file('image')){
                $file = $request->image;
                $file_name = Str::slug($_FILES['image']['name']).'.'.$request->file('image')->getClientOriginalExtension();
                $file->move($path ,$file_name);
                $brand->image = $path.$file_name;
            }
            $brand->save();
            $title = @$id ? 'Cập nhật' : 'Thêm';
            $request->session()->flash("success", $title . " thành công");
            return redirect("admin/brand");
        }
        $data['btn'] = @$id ? 'Cập nhật' : 'Thêm mới';
        $data['data_type'] = config('data_type_vn', []);
        // $data['data_type'] = Config::get('Brand.data_type_vn');
        // dd($data['data_type']);
        return view("brand::add", $data);
    }

    public function edit($id)
    {
        $data['edit'] = Brand::findOrFail($id);
        $data['data_type'] = config('data_type_vn', []);
        return view("brand::add", $data);
    }

    public function status($id)
    {
        $item = Brand::findOrFail($id);
        if($item->status==1)
        {
            $item->status = 0;
        }else{
            $item->status = 1;
        }
        $item->save();
        return redirect(route('brand.index'))->with("success", "Cập nhật trạng thái thành công");
    }
}
