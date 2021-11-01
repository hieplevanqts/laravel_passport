@extends('dashboard::layouts.master')
@section('title','Thư viện ảnh')

@php
    // use Illuminate\Support\Facades\Config;
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


@section('content')
@includeIf('dashboard::layouts.page_title', [
    'pageTitle'=>'Thư viện ảnh',
    'link'=>asset('admin/gallery/add'),
    'title'=> 'Thêm mới',
    'icon'=>'<i class="fa fa-plus" aria-hidden="true"></i>'
    ])
@push('styles')
<link href="{{ Module::asset('dashboard:css/fix_style.css') }} " rel="stylesheet">
<link href="{{ Module::asset('gallery:css/fancy-file-uploader/fancy_fileupload.css') }} " rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"/>
<link rel="stylesheet" href="{{ asset('css/viewbox.css') }}">
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
@endpush
<form method="GET" action="" accept-charset="UTF-8">
    <div class="card mb-2">
       <div class="card-body">
          <div class="row">
             <div class="col-lg-4">
                <div class="form-group">
                   <select class="form-control" id="status" name="status" onchange="submit()">
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
                <div class="form-group">
                    <button type="submit" class="btn btn-primary form-control"><i class="fa fa-search"></i> Tìm kiếm</button>
                </div>
             </div>
             <div class="col-lg-4">

             </div>
             <div class="col-lg-4">

             </div>
          </div>
       </div>
    </div>
 </form>
 <div class="card">
    <div class="card-body">
        <input type="hidden" name="page" value="{{ request()->get('page') ? request()->get('page') : 1 }}">
        <input type="hidden" name="limit" value="{{ request()->get('limit') ? request()->get('limit') : 20 }}">
	    <div class="row" id="sortable">
            @foreach ($list as $value)
                @php
                    $arr = explode('http', @$value->url);
                    if(count($arr) > 1)
                    {
                        $link = @$value->url;
                    }else{
                        $link = URL::to('/').'/'.$value->url;
                    }

                @endphp
            <div class="col-lg-3 col-md-4 col-xs-6 thumb mt-3" data-index="{{ @$value->id }}" data-position="{{ @$value->sort }}">
                    <div class="wraper-action">
                        <a href="{{  URL::to('/').'/'.$value->url }}" class="image-link"><i class="fa fa-eye" aria-hidden="true"></i></a>
                        <i onclick="deleteGalleryItem(this, {{ @$value->id }})" class="fa fa-trash" aria-hidden="true"></i>
                    </div>
                    <img src="{{  @$link }}" alt="{{ $value->alt }}">

            </div>
            @endforeach
</div>
<div class="modal fade" id="image-gallery" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="image-gallery-title"></h4>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span>
                </button>
            </div>
            <div class="modal-body">
                <img id="image-gallery-image" class="img-responsive col-md-12" src="">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary float-left" id="show-previous-image"><i class="fa fa-arrow-left"></i>
                </button>

                <button type="button" id="show-next-image" class="btn btn-secondary float-right"><i class="fa fa-arrow-right"></i>
                </button>
            </div>
        </div>
    </div>
</div>
<div class="clearfix"></div>
<div class="text-center pagination__link">
    {{ @$list->appends(['_token'=>@$_GET['_token'], 'module' => @$_GET['module']])->links() }}

</div>
</div>
</div>

@endsection

@section('script')
@parent
<script src="{{ Module::asset('gallery:js/jquery.fancy-fileupload.js') }}"></script>
<script src="{{ asset('js/jquery.viewbox.min.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
<script>
    let modalId = $('#image-gallery');
    var page = $('input[name="page"]').val();
    var limit = $('input[name="limit"]').val();
    var base = $("#base").val()
    var token = $("meta[name='csrf-token']").attr('content');

    $(function(){
        $( "#sortable" ).sortable({
            opacity: 0.6,
            cursor: 'move',
            update: function(event, ui) {
                var order = $(this).sortable("serialize") + '&action=updateRecordsListings';
                $(this).children().each(function(index){
                    if($(this).attr('data-position') != (index + 1))
                    {
                        $(this).attr('data-position', (index + 1)).addClass('updated')
                    }
                });
                saveNewPosition();
            }
        })
    });

    function saveNewPosition() {
        var positions = [];
        $('.updated').each(function(){
            positions.push([$(this).attr('data-index'), $(this).attr('data-position')])
            $(this).removeClass('updated');
        })
        console.log(positions);
        $.ajax({
            type: "post",
            url: base + "/admin/gallery/sort",
            data: {positions: positions, page : page, limit: limit, _token : token},
            success: function (response) {
                console.log(response);
            }
        });
    }
$(document)
  .ready(function () {

    $(function(){
	    $('.image-link').viewbox();
    });

    $(function(){
        $('.image-link').viewbox({
            setTitle: true,
            margin: 20,
            resizeDuration: 300,
            openDuration: 200,
            closeDuration: 200,
            closeButton: true,
            navButtons: true,
            closeOnSideClick: true,
            nextOnContentClick: true
        });
    });

    loadGallery(true, 'a.thumbnail');

    //This function disables buttons when needed
    function disableButtons(counter_max, counter_current) {
      $('#show-previous-image, #show-next-image')
        .show();
      if (counter_max === counter_current) {
        $('#show-next-image')
          .hide();
      } else if (counter_current === 1) {
        $('#show-previous-image')
          .hide();
      }
    }

    /**
     *
     * @param setIDs        Sets IDs when DOM is loaded. If using a PHP counter, set to false.
     * @param setClickAttr  Sets the attribute for the click handler.
     */

    function loadGallery(setIDs, setClickAttr) {
      let current_image,
        selector,
        counter = 0;

      $('#show-next-image, #show-previous-image')
        .click(function () {
          if ($(this)
            .attr('id') === 'show-previous-image') {
            current_image--;
          } else {
            current_image++;
          }

          selector = $('[data-image-id="' + current_image + '"]');
          updateGallery(selector);
        });

      function updateGallery(selector) {
        let $sel = selector;
        current_image = $sel.data('image-id');
        $('#image-gallery-title')
          .text($sel.data('title'));
        $('#image-gallery-image')
          .attr('src', $sel.data('image'));
        disableButtons(counter, $sel.data('image-id'));
      }

      if (setIDs == true) {
        $('[data-image-id]')
          .each(function () {
            counter++;
            $(this)
              .attr('data-image-id', counter);
          });
      }
      $(setClickAttr)
        .on('click', function () {
          updateGallery($(this));
        });
    }
  });

// build key actions
$(document)
  .keydown(function (e) {
    switch (e.which) {
      case 37: // left
        if ((modalId.data('bs.modal') || {})._isShown && $('#show-previous-image').is(":visible")) {
          $('#show-previous-image')
            .click();
        }
        break;

      case 39: // right
        if ((modalId.data('bs.modal') || {})._isShown && $('#show-next-image').is(":visible")) {
          $('#show-next-image')
            .click();
        }
        break;

      default:
        return; // exit this handler for other keys
    }
    e.preventDefault(); // prevent the default action (scroll / move caret)
  });

  function deleteGalleryItem(element, id)
  {
    if(confirm("Bạn có chắc chắn xóa không ?"))
    {
        $.ajax({
            type: "get",
            url: base + "/admin/gallery/delete/" + id,
            success: function (response) {
                if(response.status==200)
                {
                    // toastr.success(response.result)
                    $(element).parent().parent().fadeOut(500)
                }else{
                    // toastr.error(response.result)
                }
            }
        });
    }
  }

</script>

@endsection
