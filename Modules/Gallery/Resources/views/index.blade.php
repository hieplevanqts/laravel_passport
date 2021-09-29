@extends('dashboard::layouts.master')
@section('title','Thư viện ảnh')

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


@section('content')
@push('styles')
<link href="{{ Module::asset('dashboard:css/fix_style.css') }} " rel="stylesheet">
@endpush
<form method="GET" action="" accept-charset="UTF-8">
    <div class="card">
       <div class="card-body">
          <div class="row">
             <div class="col-lg-4">
                <div class="form-group mb-0">
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
             </div>
             <div class="col-lg-4">
                <div class="form-group mb-0"><button type="submit" class="btn btn-info"><i class="fa fa-search"></i> Tìm kiếm</button></div>
             </div>
          </div>
       </div>
    </div>
 </form>
 <div class="card">
    <div class="card-body">
	<div class="row">
		<div class="row">
            @foreach ($list as $value)
            <div class="col-lg-3 col-md-4 col-xs-6 thumb mt-3">
                <a class="thumbnail" href="#" data-image-id="{{ @$value->id }}" data-toggle="modal" data-title=""
                   data-image="{{ $value->url }}"
                   data-target="#image-gallery">
                    <img class="img-thumbnail"
                         src="{{ $value->url }}"
                         alt="Another alt text">
                </a>
                <div class="background_above">
                    <a class="thumbnail" href="javascript:void(0)" data-toggle="modal" data-title="" data-image="{{ $value->url }}" data-target="#image-gallery"><i class="far fa-eye"></i></a>
                    <a onclick="deleteGalleryItem(this, {{ @$value->id }})" href="javascript:void(0)">
                        <i class="fas fa-times"></i>
                    </a>
                </div>
            </div>
            @endforeach



        </div>
        <div class="clearfix"></div>
        <div class="text-center pagination__link">
            {{ @$list->appends(['_token'=>@$_GET['_token'], 'module' => @$_GET['module']])->links() }}
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
</div>

</div>
</div>

@endsection

@section('script')
@parent
<script src="{{ Module::asset('gallery:js/jquery.fancy-fileupload.js') }}"></script>
<script>
    let modalId = $('#image-gallery');

$(document)
  .ready(function () {

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
