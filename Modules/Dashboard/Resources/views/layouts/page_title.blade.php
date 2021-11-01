<div class="app-page-title">
    <div class="page-title-wrapper">
       <div class="page-title-heading">
          <div class="page-title-icon">
             <i class="pe-7s-car icon-gradient bg-mean-fruit">
             </i>
          </div>
          <div>
             {{ $pageTitle }}
             <div class="page-title-subheading">
             </div>
          </div>
       </div>
       <div class="page-title-actions">
          <div class="d-inline-block">
             {!! @$list == true ? '<button type="button" aria-haspopup="true" aria-expanded="false" class=" btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i> Xóa tất cả</button>' : '' !!}
             <a href="{{ @$link }}" class="btn btn-primary">{!! @$icon !!}  {{ @$title }}</a>
          </div>
       </div>
    </div>
 </div>
