<?php

namespace Modules\Store\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Store\Entities\Store;
use Illuminate\Support\Str;
use Auth;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {

        $input = $request->all();
        $where = [];
        foreach($input as $key => $value)
        {
            if($value == null)
            {
                unset($input[$key]);
            }
        }

        if($input)
        {
            if(@$input['name'])
            {
                if(isset($input['status']) && $input["status"] != 'all')
                {
                    $data['list'] = Store::where('name', 'like', '%'.$input["name"] . '%')
                    ->where('status', $input['status'])
                    ->orWhere('email', $input['name'])
                    ->orWhere('phone', $input['name'])
                    ->orderBy("id", "desc")
                    ->paginate(20);
                }else{
                    $data['list'] = Store::where('name', 'like', '%' . $input["name"] . '%')
                    ->orWhere('email', $input['name'])
                    ->orWhere('phone', $input['name'])
                    ->orderBy("id", "desc")
                    ->paginate(20);
                }
            }else{
                if(isset($input['status']) && @$input['status'] != 'all')
                {
                    $data['list'] = Store::orderBy("id", "desc")
                    ->where('status', $input['status'])->paginate(20);
                }else{
                    $data['list'] = Store::orderBy("id", "desc")->paginate(20);
                }

            }


        }else{
            $data['list'] = Store::orderBy("id", "desc")->paginate(20);
        }

        return view('store::index', $data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create(Request $request)
    {
        if($request->all())
        {
            $path = 'upload/stores/';
            if(@$request->edit)
            {
                $store = Store::findOrFail(@$request->edit);
                $store->name = $request->name;
                $store->phone = $request->phone;
                $store->email = $request->email;
                $store->address_google = $request->address_google;
                $store->address = $request->address;
                $store->description = $request->description;
            }else{
                $store = new Store($request->all());
            }
            $store->status = $request->status ?  1 : 0 ;
            $store->slug = Str::slug($request->name, '-');
            $store->user_id = Auth::user()->id;

            if($request->file('avatar')){
                $file = $request->avatar;
                $file_name = Str::slug($_FILES['avatar']['name']).'.'.$request->file('avatar')->getClientOriginalExtension();
                $file->move($path ,$file_name);
                $store->avatar = $path.$file_name;
            }

            if($request->file('banner')){
                $file = $request->banner;
                $file_name = Str::slug($_FILES['banner']['name']).'.'.$request->file('banner')->getClientOriginalExtension();
                $file->move($path ,$file_name);
                $store->banner = $path.$file_name;
            }

            $store->save();
            $request->session()->flash("success", "Thêm gian hàng thành công");
            return redirect(route('store.index'));
        }

        return view('store::add');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function status($id)
    {
        $item = Store::findOrFail($id);
        if($item->status==1)
        {
            $item->status = 0;
        }else{
            $item->status = 1;
        }
        $item->save();
        return redirect(route('store.index'))->with("success", "Cập nhật trạng thái thành công");
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show(Request $request, $id)
    {
        $item = Store::findOrFail($id);
        if($item)
        {
            return response()->json(["status"=>200, "message"=>"Thành công", "result"=>$item]);
        }else{
            return response()->json(["status"=>201, "message"=>"Thất bại", "result"=>"Không tồn tại"]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $data['edit'] = Store::findOrFail($id);
        return view('store::add', $data);
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
    public function destroy(Request $request, $id)
    {
        $item = Store::findOrFail($id);
        if($item)
        {
            if(file_exists($item->avatar))
            {
                unlink($item->avatar);
            }

            if(file_exists($item->banner))
            {
                unlink($item->banner);
            }

            $item->delete();
            $request->session()->flash("success", "Xóa gian hàng thành công !");
            return redirect(route('store.index'));
        }else{
            $request->session()->flash("danger", "Gian hàng không tồn tại !");
            return redirect(route('store.index'));
        }
    }
}
