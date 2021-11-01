@extends('dashboard::layouts.master')
@section('title','Thêm ảnh')

@push('styles')
    <link href="{{ Module::asset('gallery:css/fancy-file-uploader/fancy_fileupload.css') }} " rel="stylesheet">
    <link href="{{ Module::asset('gallery:css/dropzone.min.css') }} " rel="stylesheet">
@endpush

@section('content')
@includeIf('dashboard::layouts.page_title', [
    'pageTitle'=>'Thêm mới sản phẩm',
    'link'=>asset('admin/product'),
    'title'=> 'Danh sách',
    'icon'=>'<i class="fa fa-bars" aria-hidden="true"></i>'
    ])
<div class="row">
    <div class="col-sm-8">
        <div class="card card-body p-3">
            <div class="form-group">
                <label for=""><b>Tên sản phẩm</b></label>
                <input type="text" class="form-control" name="name" placeholder="Nhập tên sản phẩm ..."/>
            </div>
            <div class="form-group">
                <label for=""><b>Đường dẫn</b></label>
                <input type="text" class="form-control" name="slug" placeholder="..."/>
            </div>
            <div class="form-group">
                <label for=""><b>Hình ảnh sản phẩm</b></label>
                <div class="dropzone" id="dropzone"></div>
            </div>
            <div class="form-group">
                <label for=""><b>Mô tả</b></label>
                <textarea class="form-control" name="description" rows="5" placeholder="..."></textarea>
            </div>
            <div class="form-group">
                <label for=""><b>Chi tiết</b></label>
                <textarea class="form-control" name="detail" rows="5" placeholder="..."></textarea>
            </div>
            <div class="form-group">
                <label for=""><b>Tiêu đề seo</b></label>
                <input class="form-control" class="form-control" name="title_seo" placeholder="..."/>
            </div>
            <div class="form-group">
                <label for=""><b>Từ khóa seo</b></label>
                <input class="form-control" class="form-control" name="keyword_seo" placeholder="..."/>
            </div>
            <div class="form-group">
                <label for=""><b>Tags</b></label>
                <input class="form-control" class="form-control" name="keyword_seo" placeholder="..."/>
            </div>
            <div class="form-group">
                <label for=""><b>Mô tả seo</b></label>
                <textarea class="form-control" name="description_seo" rows="5" placeholder="..."></textarea>
            </div>
            <div class="form-group text-right">
                <label for=""></label>
                <button class="btn btn-primary" name="btnAdd"><i class="fa fa-plus" aria-hidden="true"></i> Thêm mới</button>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="card mb-3">
            <div class="card-title bg-info p-2 rounded-top">
                Avatar
            </div>
            <div class="card-body">
                <img src="https://via.placeholder.com/640x480.png/00dd99?text=consequatur" width="100%" height="250" alt="" class="mb-3">
                <button class="btn btn-danger"><i class="fa fa-plus" aria-hidden="true"></i> Chọn</button>
            </div>
        </div>
        <div class="card mb-3">
            <div class="card-title bg-info p-2 rounded-top">
                Danh mục
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-check mb-1">
                            <input class="form-check-input" type="checkbox" value="" id="">
                            <label class="form-check-label" for="defaultCheck1">Ẩm thực</label>
                        </div>
                        <div class="form-check mb-1">
                            <input class="form-check-input" type="checkbox" value="" id="">
                            <label class="form-check-label" for="defaultCheck2">Thời trang</label>
                        </div>
                        <div class="form-check mb-1">
                            <input class="form-check-input" type="checkbox" value="" id="">
                            <label class="form-check-label" for="defaultCheck2">Du lịch</label>
                        </div>
                        <div class="form-check mb-1">
                            <input class="form-check-input" type="checkbox" value="" id="">
                            <label class="form-check-label" for="defaultCheck2">Giáo dục</label>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-check mb-1">
                            <input class="form-check-input" type="checkbox" value="" id="">
                            <label class="form-check-label" for="defaultCheck1">Ẩm thực</label>
                        </div>
                        <div class="form-check mb-1">
                            <input class="form-check-input" type="checkbox" value="" id="">
                            <label class="form-check-label" for="defaultCheck2">Thời trang</label>
                        </div>
                        <div class="form-check mb-1">
                            <input class="form-check-input" type="checkbox" value="" id="">
                            <label class="form-check-label" for="defaultCheck2">Du lịch</label>
                        </div>
                        <div class="form-check mb-1">
                            <input class="form-check-input" type="checkbox" value="" id="">
                            <label class="form-check-label" for="defaultCheck2">Giáo dục</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mb-3">
            <div class="card-title bg-info p-2 rounded-top">
                Trạng thái
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-check mb-1">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="status">
                                <label class="custom-control-label" for="status"></label>
                                <label class="form-check-label" for="defaultCheck1">Kích hoạt</label>
                            </div>
                        </div>
                        <div class="form-check mb-1">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="home">
                                <label class="custom-control-label" for="home"></label>
                                <label class="form-check-label" for="defaultCheck2">Trang chủ</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-check mb-1">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="focus">
                                <label class="custom-control-label" for="focus"></label>
                                <label class="form-check-label" for="defaultCheck1">Nổi bật</label>
                            </div>
                        </div>
                        <div class="form-check mb-1">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="hot">
                                <label class="custom-control-label" for="hot"></label>
                                <label class="form-check-label" for="defaultCheck2">Hot</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mb-3">
            <div class="card-title bg-info p-2 rounded-top">
                Giá sản phẩm
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="inputGroup-sizing-default">Giá sale</span>
                            </div>
                            <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" placeholder="...">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="inputGroup-sizing-default">Giá thường</span>
                            </div>
                            <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" placeholder="...">
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="card mb-3">
            <div class="card-title bg-info p-2 rounded-top">
                Mã sản phẩm
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="inputGroup-sizing-default">Code</span>
                            </div>
                            <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" placeholder="...">
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="card mb-3">
               <div class="card-body">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                      <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Kích thước</a>
                      <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Màu sắc</a>
                      <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Xuất xứ</a>
                    </div>
                  </nav>
                  <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">Kích thước</div>
                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">Màu sắc</div>
                    <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">Xuất xứ</div>
                  </div>
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
