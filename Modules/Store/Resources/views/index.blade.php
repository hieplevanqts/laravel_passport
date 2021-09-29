@extends('layouts.main')
@section('title','Quản lý gian hàng')

@php
    use Illuminate\Support\Facades\Config;
    $heading = $title = "Quản lý gian hàng";
$menu = [
        ['label' => 'Danh sách', 'url' => url('admin/store'),'options' => ['class' => 'btn btn-info', 'icon'=>'<i class="fa fa-list-alt"></i>']],
        ['label' => 'Thêm mới','url' => url('admin/store/add'),'options' => ['class' => 'btn btn-info', 'icon'=>'<i class="fa fa-plus"></i>']]
    ];
$breadcrumb =[
    ['label' => "Trang chủ", 'url' => url('/admin')],
    ['label' => $heading, 'url' => url('/admin/store')],
    ['label' => "Danh sách", 'url' => ''],

];
Config::set(['app.menu'=>$menu, 'app.breadcrumb'=>$breadcrumb]);
@endphp


@section('content')
<form method="GET" action="" accept-charset="UTF-8">
    <div class="card">
       <div class="card-body">
          <div class="row">
             <div class="col-lg-4">
                <div class="form-group "><input class="form-control" value="{{ @$_GET['name'] }}" placeholder="Tìm theo tên, email hoặc số điện thoại..." name="name" type="text"></div>
                <div class="form-group mb-0">
                   <select class="form-control" id="status" name="status" onchange="submit()">
                      <option value="all"  {{ @$_GET['status'] == 'all' ? 'selected' : '' }}>--Trạng thái--</option>
                      <option value="1" {{ @$_GET['status'] == '1' ? 'selected' : '' }}>Active</option>
                      <option value="0" {{ @$_GET['status'] == '0' ? 'selected' : '' }}>Inactive</option>
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

 <div class="card card-outline card-info" id="store_main">
    <div class="card-body p-0">
       <table class="table table-bordered table-striped table-hover table-sm">
          <thead>
             <tr height="45">
                <th width="5%">#</th>
                <th>Logo</th>
                <th>Gian hàng</th>
                <th>Chủ shop</th>
                <th>Số điện thoại</th>
                <th>Địa chỉ</th>
                <th>Trạng thái</th>
                <th>Actions</th>
             </tr>
          </thead>
          <tbody>
              @foreach ($list as $key => $value)
                @php
                    $arr = explode('http', $value->avatar);
                    if(count($arr)>1)
                    {
                        $image = $value->avatar;
                    }else{
                        $image = asset($value->avatar);
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
                    <td><img src="{{ @$image }}" width="60" height="60"></td>
                    <td>{{ @$value->name }}</td>
                    <td>{{ @$value->user->name }}</td>
                    <td>{{ @$value->phone }}</td>
                    <td>{{ @$value->address }}</td>
                    <td>
                        {{-- <input type="checkbox" {{ @$value->status==1 ? "checked" : "" }} data-toggle="toggle" data-onstyle="info"> --}}
                        <a onclick="return confirm('Bạn có chắc chắn thay đổi trạng thái không ?')" href="{{ route('store.status', @$value->id) }}" class="btnGray {{ $active }}"  title="Kích hoạt menu"><i class="font12 fas fa-toggle-{{ $tmp }}"></i></a>

                    </div>
                    </td>
                    <td>
                        <a onClick="showStoreItem(this, {{ @$value->id }})" href="javascript:void(0)" class="btn btn-default btn-xs"><i class="fas fa-eye"></i></a>
                        <a href="{{ route('store.edit',  @$value->id) }}" class="btn btn-warning btn-xs"><i class="fas fa-edit"></i></a>
                        <a onclick="return confirm('Bạn có chắc chắn xóa không ?')" href="{{ route('store.delete',  @$value->id) }}" class="btn btn-danger btn-xs"><i class="far fa-trash-alt"></i></a>
                    </td>
                </tr>
             @endforeach
          </tbody>
          <tfoot></tfoot>
       </table>
       <br>
       <div class="text-center pagination__link">
        {{ @$list->appends(['_token'=>@$_GET['_token'], 'name' => @$_GET['name'], 'type' => @$_GET['type'], 'status' => @$_GET['status']])->links() }}
       </div>
    </div>
 </div>
 @include('store::modal')
@endsection

@section('script')
@parent

<script>

    function showStoreItem(element, id)
    {
        $.ajax({
            type: "get",
            url: base + "/admin/store/detail/" + id,
            success: function (response) {
                if(response.status==200)
                {
                    console.log(response.result);
                    $("input[name='name']").val(response.result.name);
                    $("input[name='phone']").val(response.result.phone);
                    $("input[name='email']").val(response.result.email);
                    $("#address").val(response.result.address);
                    $("#description").val(response.result.description);

                    var tmp = response.result.avatar.split('http')
                    if(tmp[1])
                    {
                        $(".md_logo_ok").attr("src", response.result.avatar);
                    }else{
                        $(".md_logo_ok").attr("src", base + '/' + response.result.avatar);
                    }

                    var str = response.result.banner.split('http')
                    if(str[1])
                    {
                        $("#md_banner").attr("src", response.result.banner);
                    }else{
                        $("#md_banner").attr("src", base + '/' + response.result.banner);
                    }

                    if(response.result.status==1)
                    {
                        $("input[name='status']").attr("checked", "checked")
                    }
                    $("#modal_store_detail").modal("show")
                }else{
                    toastr.success(response.message)
                }

            }
        });
    }
</script>

@endsection
