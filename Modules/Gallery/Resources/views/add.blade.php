@extends('dashboard::layouts.master')
@section('title','Thêm ảnh')

@push('styles')
    <link href="{{ Module::asset('gallery:css/fancy-file-uploader/fancy_fileupload.css') }} " rel="stylesheet">
    <link href="{{ Module::asset('gallery:css/dropzone.min.css') }} " rel="stylesheet">
@endpush

@section('content')
@includeIf('dashboard::layouts.page_title', [
    'pageTitle'=>'Thư viện ảnh',
    'link'=>asset('admin/gallery'),
    'title'=> 'Thư viện ảnh',
    'icon'=>'<i class="fa fa-bars" aria-hidden="true"></i>'
    ])

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
            <div class="dropzone" id="dropzone"></div>
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
<script src="{{ Module::asset('gallery:js/dropzone.min.js') }}"></script>
<script>

    var base = $("#base").attr('content');
    var token = $("input[name='_token']").val()

    var myDropzone = new Dropzone("div#dropzone", {
        url : base + "/admin/gallery/handle-upload",
        paramName: "file",
        maxFiles: 10,
        maxFilesize: 2,
        uploadMultiple: true,
        parallelUploads: 100,
        acceptedFiles: ".jpg, .jpeg, .png, .gif, .pdf",
        addRemoveLinks: true,
        dictFileTooBig: "File is to big ",
        dictInvalidFileType: "Invalid File Type",
        dictCancelUpload: "Cancel",
        dictRemoveFile: "Remove",
        dictMaxFilesExceeded: "",
        dictDefaultMessage: "Drop files here to upload",
        params: {
                '_token': token,
            },
    });
    myDropzone.on("addedfile", function(file){
        console.log(file.size);
        caption = file.caption == undefined ? "" : file.caption;
        file._captionBox = Dropzone.createElement("<input type='text' name='alts[]' value="+file.name+" >");
        file._image = Dropzone.createElement("<input type='hidden' name='images[]' value="+file.name+" >");
        file._size = Dropzone.createElement("<input type='hidden' name='size[]' value="+file.size+" >");
        file.previewElement.appendChild(file._captionBox);
        file.previewElement.appendChild(file._image);
        file.previewElement.appendChild(file._size);
    })

</script>

@endsection
