@extends('layouts.main')
@section('title','Thêm gian hàng')

@php
    use Illuminate\Support\Facades\Config;
    $heading = $title = "Thêm gian hàng";
$menu = [
        ['label' => 'Danh sách', 'url' => url('admin/store'),'options' => ['class' => 'btn btn-info', 'icon'=>'<i class="fa fa-list-alt"></i>']],
        ['label' => 'Thêm mới','url' => url('admin/store/add'),'options' => ['class' => 'btn btn-info', 'icon'=>'<i class="fa fa-plus"></i>']]
    ];
$breadcrumb =[
    ['label' => "Trang chủ", 'url' => url('/admin')],
    ['label' => "Danh sách gian hàng", 'url' => url('/admin/store')],
    ['label' => "Thêm mới", 'url' => ''],

];
Config::set(['app.menu'=>$menu, 'app.breadcrumb'=>$breadcrumb]);
@endphp

@section('content')

    <form method="POST" action="{{ route('store.postAdd') }}" accept-charset="UTF-8" enctype="multipart/form-data">
    <div class="container-fluid" id="store_main">
       <section class="content">
          <div class="container-fluid">
             <div class="row justify-content-center">
                <div class="col-lg-8">

                      @csrf
                      <input type="hidden" name="edit" value="{{ @$edit->id }}">
                      <div class="card">
                         <div class="card-body">
                            <div class="form-group"><label for="name" class="col-form-label">Tên gian hàng <span class="text-danger">*</span></label><input id="name" type="text" name="name" class="form-control" placeholder="Nhập tên gian hàng..." value="{{ @$edit->name }}" required></div>
                            <div class="form-group"><label for="name" class="col-form-label">Số điện thoại <span class="text-danger">*</span></label><input id="phone" type="number" name="phone" class="form-control" placeholder="Nhập số điện thoại..." value="{{ @$edit->phone }}" required></div>
                            <div class="form-group"><label for="name" class="col-form-label">Email <span class="text-danger">*</span></label><input id="email" type="email" name="email" class="form-control" placeholder="Nhập email..." value="{{ @$edit->email }}" required></div>
                            <div class="form-group"><label for="name" class="col-form-label">Chọn địa chỉ (google)<span class="text-danger"></span></label><input id="address_google" type="text" name="address_google" class="form-control" value="{{ @$edit->address_google }}" placeholder="Chọn địa chỉ (google)..." ></div>
                            <div class="form-group"><label for="name" class="col-form-label">Địa chỉ (Tùy chọn)<span class="text-danger">*</span></label><textarea name="address" id="address" cols="30" rows="3" class="form-control" value="{{ @$edit->address }}" placeholder="Nhập địa chỉ (Tùy chọn)..."></textarea></div>
                            <div class="form-group"><label for="name" class="col-form-label">Mô tả ngắn<span class="text-danger">*</span></label><textarea name="description" id="description" cols="30" rows="3" class="form-control" value="{{ @$edit->description }}" placeholder="Nhập mô tả ngắn..."></textarea></div>
                            <div class="form-group form-check"><input type="checkbox" name="status" class="form-check-input" id="status" {{ @$edit->status == 1 ? "checked" : "" }}><label class="form-check-label" for="status">Kích hoạt</label></div>
                            <br>
                            <div class="form-group"><button type="submit" class="btn btn-info"><i class="fa fa-save"></i> {{ @$edit ? "Cập nhật" : "Thêm mới" }} </button></div>
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
                                    $avatar = @$edit->avatar ? asset(@$edit->avatar) : 'https://via.placeholder.com/640x480.png/00dd99?text=consequatur';
                                @endphp
                                <img src="{{ $avatar }}" alt="..." class="img-thumbnail" width="200" height="200">
                            </div>
                            <div class="form-group col-md-12">
                                <input type="file" name="avatar">
                            </div>
                         </div>
                      </div>
                   </div>

                   <div class="card">
                    <div class="card-title bg-info p-2 rounded-top">Banner</div>
                    <div class="card-body">
                       <div class="row">
                          <div class="form-group col-md-12">
                              @php
                                  $banner = @$edit->banner ? asset(@$edit->banner) : 'https://via.placeholder.com/640x480.png/00dd99?text=consequatur';
                              @endphp
                              <img src="{{ @$banner }}" alt="..." class="img-thumbnail" width="200" height="200">
                          </div>
                          <div class="form-group col-md-12">
                              <input type="file" name="banner">
                          </div>
                       </div>
                    </div>
                 </div>


                </div>

             </div>
          </div>
       </section>
    </div>
</form>


 @endsection
