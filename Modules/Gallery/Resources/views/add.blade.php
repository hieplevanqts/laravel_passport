@extends('dashboard::layouts.master')
@section('title','Thêm ảnh')

@php
    use Illuminate\Support\Facades\Config;
    $heading = $title = "Thư viện ảnh";
$menu = [
        ['label' => 'Danh sách', 'url' => url('admin/gallery'),'options' => ['class' => 'btn btn-info', 'icon'=>'<i class="fa fa-list-alt"></i>']],
        ['label' => 'Thêm mới','url' => url('admin/gallery/add'),'options' => ['class' => 'btn btn-info', 'icon'=>'<i class="fa fa-plus"></i>']]
    ];
$breadcrumb =[
    ['label' => "Trang chủ", 'url' => url('/admin')],
    ['label' => "Thư viện ảnh", 'url' => url('/admin/gallery')],
    ['label' => "Danh sách", 'url' => ''],

];
Config::set(['app.menu'=>$menu, 'app.breadcrumb'=>$breadcrumb]);
@endphp
@push('styles')
    <link href="{{ Module::asset('gallery:css/fancy-file-uploader/fancy_fileupload.css') }} " rel="stylesheet">
@endpush

@section('content')


<div class="row justify-content-center">
   <div class="col-md-8">



    <div class="card">
        <div class="card-body">
            <form action="{{ route('gallery.postAdd') }}" method="post" enctype="multipart/form-data">
                @csrf
            <div class="form-group">
                <label for="name" class="col-form-label">Chọn module <span class="text-danger">*</span></label>
                <select name="module" id="module" class="form-control">
                    <option value="all">--Module--</option>
                    <option value="product">Sản phẩm</option>
                    <option value="news">Tin tức</option>
                    <option value="banner">Banner</option>
                    <option value="category">Danh mục</option>
                    <option value="menu">Menu</option>
                    <option value="contact">Liên hệ</option>
                    <option value="store">Gian hàng</option>
                    <option value="other">Khác</option>
                </select>
            </div>
            <input type="hidden" id="md" name="md" value=""/>
            <input id="files" type="file" name="files" accept=".jpg, .png, image/jpeg, image/png" multiple>
            <br />
            <div class="form-group">
                <button type="submit" class="btn btn-info"><i class="fa fa-save"></i> Thêm mới</button>
            </div>
        </form>
        </div>
    </div>


   </div>



</div>



@endsection

@section('script')
@parent
<script src="{{ Module::asset('gallery:js/jquery.ui.widget.js') }}  "></script>
<script src="{{ Module::asset('gallery:js/jquery.fileupload.js') }}"></script>
<script src="{{ Module::asset('gallery:js/jquery.iframe-transport.js') }}"></script>
<script src="{{ Module::asset('gallery:js/jquery.fancy-fileupload.js') }}"></script>
<script>
var files = $("input[name='files']").val();
var md = $("#module").val()
var token = $("input[name='_token']").val()

$('#files').FancyFileUpload({
    'url' : base + '/admin/gallery/postadd',
    'params' : {files : files, md: md, _token: token},
    'edit' : false,
    'maxfilesize' : 1000000,
    autoUpload:false,
    maxChunkSize: 10000000,
        maxFileSize: 1000000000,
        singleFileUploads: false,
    'uploadcompleted' :function(e, data) {
        console.log(data);
  },

});

</script>

@endsection
