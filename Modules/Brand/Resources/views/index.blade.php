@extends('layouts.main')

@php
    use Illuminate\Support\Facades\Config;
    $heading = $title = "Quản lý thương hiệu";
$menu = [
        ['label' => 'Danh sách', 'url' => url('admin/brand'),'options' => ['class' => 'btn btn-info', 'icon'=>'<i class="fa fa-list-alt"></i>']],
        ['label' => 'Thêm mới','url' => url('admin/brand/add'),'options' => ['class' => 'btn btn-info', 'icon'=>'<i class="fa fa-plus"></i>']]
    ];
$breadcrumb =[
    ['label' => "Trang chủ", 'url' => url('/admin')],
    ['label' => $heading, 'url' => url('/admin/brand')],
    ['label' => "Danh sách", 'url' => ''],

];
Config::set(['app.menu'=>$menu, 'app.breadcrumb'=>$breadcrumb]);

@endphp
@section('title','Quản lý thương hiệu')
@section('content')
<form method="GET" action="{{ route('brand.index') }}" accept-charset="UTF-8">
    <div class="card">
       <div class="card-body">
          <div class="row">
             <div class="col-lg-4">
                <div class="form-group">
                   <select class="form-control" id="type" onchange="submit()" name="type">
                      <option value="">--Phân loại--</option>
                      @foreach ($data_type as $value)
                        <option value="{{ $value['type'] }}" {{ @$_GET['type']==@$value['type'] ? 'selected' : ''  }}>{{ $value['name'] }}</option>
                      @endforeach


                   </select>
                </div>
                <div class="form-group mb-0">
                   <select class="form-control" id="status" name="status" onchange="submit()">
                      <option value="all">--Trạng thái--</option>
                      <option value=true {{ @$_GET['status']=='true' ? 'selected' : ''  }}>Active</option>
                      <option value=false {{ @$_GET['status']=='false' ? 'selected' : ''  }}>Inactive</option>
                   </select>
                </div>
             </div>
             <div class="col-lg-4">
                <div class="form-group ">
                   <input class="form-control" placeholder="Tìm theo tên..." name="name" type="text" value="{{ @$_GET['name'] }}">
                </div>
                <div class="form-group mb-0">
                   <button type="submit" class="btn btn-info"><i class="fa fa-search"></i> Tìm kiếm</button>
                </div>
             </div>
          </div>
       </div>
    </div>
 </form>
 {{-- {{ Widget::run('Alert') }} --}}
<div class="card card-outline card-info"  id="brand_main">
    <div class="card-body p-0">
       <table class="table table-bordered table-striped table-hover table-sm">
          <thead>
             <tr height="45">
                <th width="5%">#</th>
                <th>Logo</th>
                <th>Tên</th>
                <th>Phân loại</th>
                <th>Trạng thái</th>
                <th>Actions</th>
             </tr>
          </thead>
          <tbody>
            @foreach ($list as $key => $value)
                @php
                    $arr = explode('http', $value->image);
                    if(count($arr)>1)
                    {
                        $image = $value->image;
                    }else{
                        $image = asset($value->image);
                    }

                    if(@$_GET['page']){
                        $limit = @$_GET['page']-1 == 0 ? 0 : @$_GET['page']-1;
                    }else{
                        $limit = 0;
                    }
                    $tmp = @$value->status==1 ? "on" : "off";
                    $active = @$value->status==1 ? "active text-info" : "";
                @endphp


                <tr>
                    <td>{{ @$limit*20 + $key + 1 }}</td>
                    <td><img src="{{ $image }}" width="60" height="60"/></td>
                    <td>{{ $value->name }}</td>
                    <td>{{ $value->type }}</td>
                    <td><a onclick="return confirm('Bạn có chắc chắn thay đổi trạng thái không ?')" href="{{ route('brand.status', @$value->id) }}" class="btnGray {{ $active }}"  title="Kích hoạt menu"><i class="font12 fas fa-toggle-{{ $tmp }}"></i></a></td>
                    <td>
                    <a href="{{ route('brand.edit', @$value->id)  }}" class="btn btn-warning btn-xs"><i class="fas fa-edit"></i></a>
                    <a onclick="return confirm('Bạn có chắc chắn xóa không ?')" href="{{ route('brand.delete', $value->id) }}" class="btn btn-danger btn-xs"><i class="far fa-trash-alt"></i></a>
                    </td>
                </tr>
            @endforeach


          </tbody>
          <tfoot>
          </tfoot>
       </table>
       <br>
       <div class="text-center pagination__link">
        {{ @$list->appends(['_token'=>@$_GET['_token'], 'name' => @$_GET['name'], 'type' => @$_GET['type'], 'status' => @$_GET['status']])->links() }}
       </div>
    </div>
 </div>
@endsection
