@extends('dashboard::layouts.master')


@section('title','Thêm thương hiệu')
@section('content')
@includeIf('dashboard::layouts.page_title', [
    'pageTitle'=>'Danh sách thương hiệu',
    'link'=>asset('admin/brand'),
    'icon'=>'<i class="fa fa-bars" aria-hidden="true"></i>',
    'title'=>'Danh sách',
    'list'=>false
    ])
<section class="content">
    <div class="container-fluid">
            <div class="row justify-content-center">
<div class="col-lg-8">
<form method="POST" action="{{ route('brand.add') }}" accept-charset="UTF-8" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="edit" value="{{ @$edit->id }}">
    <div class="card">
        <div class="card-body">

            <div class="form-group">
                <label for="name" class="col-form-label"><b>Tên thương hiệu</b> <span class="text-danger">*</span></label>
                <input id="name" type="text" name="name" value="{{ @$edit->name }}" class="form-control" placeholder="Nhập tên thương hiệu" required>
            </div>
            <div class="form-group">
                <label for="name" class="col-form-label"><b>Mô tả</b> <span class="text-danger">*</span></label>
                <textarea name="description" id="description" cols="30" rows="3" class="form-control" placeholder="Mô tả ngắn...">{{ @$edit->description }}</textarea>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-lg-6">
                        <label for="type" class="col-form-label"><b>Loại</b></label>
                        <select class="form-control" id="type" name="type" required>
                            <option value="">-- Chọn --</option>
                            @foreach ($data_type as $value)
                            <option value="{{ $value['type'] }}" {{ @$_GET['type']==@$value['type'] || @$value['type']==@$edit->type ? 'selected' : ''  }}>{{ $value['name'] }}</option>
                          @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-group form-check">
                <input type="checkbox" name="status" class="form-check-input" id="status" {{ @$edit->status == 1 ? "checked" : ""  }}>
                <label class="form-check-label" for="status"><b>Kích hoạt</b></label>
            </div>
            <br>
            <div class="form-group">
                <button type="submit" class="btn btn-info"><i class="fa fa-save"></i>  {{ @$edit ? 'Cập nhật' : 'Thêm mới' }} </button>
            </div>

        </div>
    </div>

</div>
<div class="col-lg-4">
    <div class="card">
        <div class="card-title bg-info p-2 rounded-top">Logo</div>
        <div class="card-body">
            <div class="row">
                <div class="form-group col-md-12">
                    @php
                    $arr = explode('http', @$edit->image);
                    if(count($arr)>1)
                    {
                        $image = @$edit->image;
                    }else{
                        $image = asset(@$edit->image);
                    }
                    $url = count($arr)>1 || @$edit ? $image : "https://via.placeholder.com/640x480.png/00dd99?text=consequatur";
                @endphp
                    <img src="{{ $url }}" alt="..." class="img-thumbnail" width="200" height="200">
                </div>
                <div class="form-group col-md-12">
                    <input type="file" name="image">
                </div>
            </div>
        </div>
    </div>
</div>
</div>
    </div>
</form>
</section>
@endsection







