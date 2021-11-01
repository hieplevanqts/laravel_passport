@extends('dashboard::layouts.master')
@php
    use Illuminate\Support\Facades\Config;
    $heading = $title = "Quản lý huyện";
$menu = [
        ['label' => 'Danh sách', 'url' => url('category/index'),'options' => ['class' => 'btn btn-info']],
        ['label' => 'Thêm mới','url' => url('category/create'),'options' => ['class' => 'btn btn-info']]
    ];
$breadcrumb =[
    ['label' => "Trang chủ", 'url' => url('/admin')],
    ['label' => $heading, 'url' => url('/admin/district')],
    ['label' => "Danh sách", 'url' => ''],

];
Config::set(['app.breadcrumb'=>$breadcrumb]);

@endphp
@section('title', 'Danh sách huyện')


@section('content')
@includeIf('dashboard::layouts.page_title', ['pageTitle'=>'Danh sách huyện'])
<div class="row text-right mb-3">
    <div class="col-md-12">


        @if (session('mess'))
        <div class="alert alert-success alert-dismissible fade show" role="alert" id="alert_success">
            {{ session('mess') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif

        @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert" id="alert_success">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif

        <form action="{{ route('district.index') }}" method="get" id="district_filter">
            @csrf
            <div class="card card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="text" class="form-control" name="name" placeholder="Tìm theo tên" value="{{ @$_GET['name'] }}" onchange="district_filter()">
                        </div>
                        <div class="form-group">
                            <select name="province" id="" class="form-control" onchange="district_filter()">
                                <option value="">Chọn tỉnh</option>
                                @if ($provinces)
                                    @foreach ($provinces as $item)
                                        <option value="{{ $item->id }}" {{ @$item->id==@$_GET['province'] ? 'selected' : '' }}>{{ $item->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary form-control"><i class="fa fa-search" aria-hidden="true"></i> Tìm kiếm</button>
                        </div>
                    </div>
                    <div class="col-md-4">

                    </div>
            </div>
        </div>

    </form>
    </div>
    {{-- <div class="col-md-4">
        <button class="btn btn-primary" onclick="addDistrict()"><i class="fas fa-plus"></i> Thêm</button>
    </div> --}}

</div>
    <div class="card card-outline card-info" id="district_main">
        <div class="card-body p-3">
            <table class="table table-bordered table-striped table-hover table-sm">
                <thead>
                   <tr height="45">
                      <th width="5%"><input type="checkbox" /></th>
                      <th>
                        Name
                      </th>
                      <th>
                        Tỉnh
                      </th>
                      <th>
                        Vùng
                      </th>
                      <th>
                         Actions
                      </th>
                   </tr>

                </thead>
                <tbody>
                    @if ($list)
                        @foreach ($list as $key => $item)
                        @php
                            if(@$_GET['page']){
                                $limit = @$_GET['page']-1 == 0 ? 0 : @$_GET['page']-1;
                            }else{
                                $limit = 0;
                            }

                        @endphp
                                <tr>
                                    <td><input type="checkbox" name="ids"/></td>
                                    {{-- {{ @$limit*20 + $key + 1 }} --}}
                                    <td>{{ @$item->name }}</td>
                                    <td>{{ @$item->province->name }}</td>
                                    <td>{{ @$item->province->region }}</td>
                                    <td>
                                        <a onClick="editProvice({{ $item->id }})" href="javascript:void(0)" class="btn btn-warning btn-xs"><i class="fas fa-edit"></i></a>
                                        <a onclick="return confirm('Bạn có chắc chắn xóa không ?')" href="{{ URL::to('/admin/district/delete') }}/{{ @$item->id }}" class="btn btn-danger btn-xs"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                    </td>
                                </tr>
                        @endforeach
                   @endif
                </tbody>
                <tfoot>

                </tfoot>
             </table>
             <br>
            <div class="text-center pagination__link"> {{ @$list->appends(['_token'=>@$_GET['_token'], 'province' => @$_GET['province'], 'name' => @$_GET['name']])->links() }}</div>
        </div>
    </div>
    @include('local::local.district.modal')
@endsection

@section('script')
@parent
    <script>

        var base = $("#base").attr('content')
        function editProvice(id){
            $("#editProvinceModal select").empty()
            $.ajax({
                type: "get",
                url: base + "/admin/district/edit/" + id,
                success: function (response) {
                    console.log(response);
                    if(response.status==200)
                    {
                        $("#editProvinceModalLabel").text(response.result.action)
                        $("#editProvinceModal input[name='name']").val(response.result.item.name)
                        response.result.provinces.forEach(el => {
                            var selected = el.id==response.result.item.province.id?'selected':''
                            $("#editProvinceModal select").append("<option value='"+el.id+"' "+selected+" >"+el.name+"</option>")
                            $("#updateProvince").attr("onClick", "update_Province("+response.result.item.id+")")
                        });
                    }
                    console.log(response);
                }
            });
            $("#editProvinceModal").modal("show")
        }

        function update_Province(id=null)
        {
            var name = $("#editProvinceModal input[name='name']").val()
            var area = $("#editProvinceModal select").val()
            var token = $("input[name='_token']").val()
            if(id==null){
                var data = {name: name, province_id: area, _token: token}
            }else{
                var data = {id : id, name: name, province_id: area, _token: token}
            }

            console.log(data);
            $.ajax({
                type    :"POST",
                url: base + "/admin/district/postEdit",
                data: data,
                success: function (response) {
                    window.location.reload();
                }
            });
        }

        function district_filter()
        {
            $("#district_filter").submit()
        }

        function addDistrict()
        {
            $("#editProvinceModalLabel").text("Thêm quận/huyện")
            $("#editProvinceModal select").empty()
            $("#editProvinceModal select").append("<option value=''>Chọn tỉnh</option>")
            $.ajax({
                type: "get",
                url: base + "/admin/district/province/list",
                success: function (response) {
                    console.log(response);
                        response.result.forEach(el => {
                            if(response.status==200)
                                {
                                    $("#editProvinceModal select").append("<option value='"+el.id+"'>"+el.name+"</option>")
                                }
                        });
                }
            });
            $("#editProvinceModal").modal("show")

        }
    </script>


@endsection
