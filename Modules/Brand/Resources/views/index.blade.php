@extends('dashboard::layouts.master')

@section('title','Quản lý thương hiệu')
@section('content')
@includeIf('dashboard::layouts.page_title', [
    'pageTitle'=>'Danh sách thương hiệu',
    'link'=>asset('admin/brand/add'),
    'title'=> 'Thêm mới',
    'icon'=>'<i class="fa fa-plus" aria-hidden="true"></i>'
    ])
<form method="GET" action="{{ route('brand.index') }}" accept-charset="UTF-8">
    <div class="card mb-3">
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
                   <button type="submit" class="btn btn-primary form-control"><i class="fa fa-search"></i> Tìm kiếm</button>
                </div>
             </div>
          </div>
       </div>
    </div>
 </form>
 {{-- {{ Widget::run('Alert') }} --}}
<div class="card card-outline card-info"  id="brand_main">
    <div class="card-body p-3">
       <table class="table table-bordered table-striped table-hover table-sm">
          <thead>
             <tr height="45">
                <th width="5%"><input type="checkbox" /></th>
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
                    <td><input type="checkbox"/></td>
                    {{-- {{ @$limit*20 + $key + 1 }} --}}
                    <td><img src="{{ $image }}" width="60" height="60"/></td>
                    <td>{{ $value->name }}</td>
                    <td>{{ $value->type }}</td>
                    <td><a onclick="return confirm('Bạn có chắc chắn thay đổi trạng thái không ?')" href="{{ route('brand.status', @$value->id) }}" class="btnGray {{ $active }}"  title="Kích hoạt menu"><i class="font12 fas fa-toggle-{{ $tmp }}"></i></a></td>
                    <td>
                    <a href="{{ route('brand.edit', @$value->id)  }}" class="btn btn-warning btn-xs"><i class="fas fa-edit"></i></a>
                    <a onclick="return confirm('Bạn có chắc chắn xóa không ?')" href="{{ route('brand.delete', $value->id) }}" class="btn btn-danger btn-xs"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                    </td>
                </tr>
            @endforeach
          </tbody>
       </table>
       <br>
       <div class="text-center pagination__link">
        {{ @$list->appends(['_token'=>@$_GET['_token'], 'name' => @$_GET['name'], 'type' => @$_GET['type'], 'status' => @$_GET['status']])->links() }}
       </div>
    </div>
 </div>
@endsection
