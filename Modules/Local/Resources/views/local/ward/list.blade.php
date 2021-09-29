@extends('layouts.main')
@php
    use Illuminate\Support\Facades\Config;
    $heading = $title = "Quản lý xã";
$menu = [
        ['label' => 'Danh sách', 'url' => url('category/index'),'options' => ['class' => 'btn btn-info']],
        ['label' => 'Thêm mới','url' => url('category/create'),'options' => ['class' => 'btn btn-info']]
    ];
$breadcrumb =[
    ['label' => "Trang chủ", 'url' => url('/admin')],
    ['label' => $heading, 'url' => url('/admin/ward')],
    ['label' => "Danh sách", 'url' => ''],

];
Config::set(['app.breadcrumb'=>$breadcrumb]);

@endphp




@section('content')
<div class="row text-right mb-3">
    <div class="col-md-8">
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

        <form action="{{ route('ward.index') }}" method="get" id="ward_filter">
            @csrf
        <div class="row">
                <div class="col-md-3"><input type="text" class="form-control" name="name" value="{{ @$_GET['name'] }}" placeholder="Tìm theo tên" onchange="ward_filter()"></div>
                <div class="col-md-3">
                    <select name="province" id="" class="form-control" onchange="get_district(this)">
                        <option value="">Chọn tỉnh</option>
                        @if ($provinces)
                            @foreach ($provinces as $item)
                                <option value="{{ $item->id }}" {{ @$item->id==@$_GET['province'] ? 'selected' : '' }}>{{ $item->name }}</option>
                            @endforeach
                        @endif
                    </select>
                    <input type="hidden" value="{{ @$_GET['province'] }}" id="province_hidden" name="province_hidden">
                </div>
                <div class="col-md-3">
                    <select name="district" id="district" class="form-control" onchange="ward_filter()">
                        <option value="">Chọn huyện</option>
                    </select>
                    <input type="hidden" value="{{ @$_GET['district'] }}" id="district_hidden" name="district_hidden">
                </div>
                <div class="col-md-2"><button type="submit" class="btn btn-default">Tìm kiếm</button></div>
        </div>
    </form>
    </div>
    <div class="col-md-4">
        <button class="btn btn-primary" onclick="addWard()"><i class="fas fa-plus"></i> Thêm</button>
    </div>

</div>
    <div class="card card-outline card-info" id="ward_main">
        <div class="card-body p-0">

            <table class="table table-bordered table-striped table-hover table-sm">
                <thead>
                   <tr height="45">
                      <th width="5%">#</th>
                      <th>
                        Name
                      </th>
                      <th>Huyện</th>
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
                                    <td>{{ @$limit*20 + $key + 1 }}</td>
                                    <td>{{ @$item->name }}</td>
                                    <td>{{ @$item->district->name }}</td>
                                    <td>{{ @$item->district->province->name }}</td>
                                    <td>{{ @$item->district->province->region }}</td>
                                    <td>
                                        <a onClick="editWard({{ $item->id }})" href="javascript:void(0)" class="btn btn-warning btn-xs"><i class="fas fa-edit"></i></a>
                                        <a onclick="return confirm('Bạn có chắc chắn xóa không ?')" href="{{ URL::to('/admin/ward/delete') }}/{{ @$item->id }}" class="btn btn-danger btn-xs"><i class="far fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                        @endforeach
                   @endif
                </tbody>
                <tfoot>

                </tfoot>
             </table>
             <br>
            <div class="text-center pagination__link"> {{ @$list->appends(['_token'=>@$_GET['_token'], 'province' => @$_GET['province'], 'district' => @$_GET['district'], 'name' => @$_GET['name']])->links() }}</div>
        </div>
    </div>
    @include('local::local.ward.modal')
@endsection

@section('script')
@parent
    <script>
        var base = $("#base").attr('content')
        function editWard(id){
            $("#editWardModal select").empty()
            $.ajax({
                type: "get",
                url: base + "/admin/ward/edit/" + id,
                success: function (response) {
                    console.log(response);
                    if(response.status==200)
                    {
                        $("#editWardModalLabel").text(response.result.action)
                        $("#editWardModal input[name='name']").val(response.result.item.name)
                        response.result.provinces.forEach(el => {
                            var selected = el.id==response.result.item.district.province.id?'selected':''
                            $("#editWardModal select#sl_province").append("<option value='"+el.id+"' "+selected+" >"+el.name+"</option>")
                            $("#updateWard").attr("onClick", "update_Ward("+response.result.item.id+")")
                        });
                        $("#editWardModal select#sl_district").append("<option value='"+ response.result.item.district_id +"' selected >"+ response.result.item.district.name +"</option>")
                    }
                    console.log(response);
                }
            });
            $("#editWardModal").modal("show")
            var provinceId = $("#sl_province").val();
            getDistrictById(provinceId)
        }

        function update_Ward(id=null)
        {
            var name = $("#editWardModal input[name='name']").val()
            var district = $("#sl_district").val()
            var token = $("input[name='_token']").val()
            if(id==null)
            {
                var data = {name: name, district_id: district, _token: token}
            }else{
                var data = {id : id, name: name, district: district, _token: token}
            }

            $.ajax({
                type    :"POST",
                url: base + "/admin/ward/postEdit",
                data: data,
                success: function (response) {
                    if(response.status==200)
                    {
                        window.location.reload();
                    }else{
                        alert("Không được thay đổi tỉnh, huyện của xã !")
                    }

                }
            });
        }

        function ward_filter()
        {
            $("#ward_filter").submit()
        }

        function get_district(e)
        {
            $("#district").empty()
            $("#sl_district").empty()
            var id = e.value

            var district_hidden = $("#district_hidden").val()

            $.ajax({
                type: "get",
                url: base + "/admin/district/list/" + id,
                success: function (response) {
                    console.log(response);
                    if(response.status==200)
                    {
                        response.result.forEach(element => {
                            var selected = element.id== district_hidden ? 'selected' : '';
                            $("#district").append("<option value='"+element.id+"' "+selected+">"+element.name+"</option>")
                            $("#sl_district").append("<option value='"+element.id+"' "+selected+">"+element.name+"</option>")
                        });

                    }
                    localStorage.setItem("districts", JSON.stringify(response.result));
                }
            });
        }

        function getDistrictById(provinceId)
        {
            $.ajax({
                type: "get",
                url: base + "/admin/district/list/" + province_id,
                success: function (response) {
                    console.log(response);

                    if(response.status==200)
                    {
                        response.result.forEach(element => {
                            var selected = element.id== district_hidden ? 'selected' : '';
                            $("#sl_district").append("<option value='"+element.id+"' "+selected+">"+element.name+"</option>")
                        });

                    }
                    localStorage.setItem("districts", JSON.stringify(response.result));
                }
            });
        }

        $(document).ready(function(){
            if($("#district_hidden").val()!='')
            {
                $("#district").val($("#district_hidden").val())
            }
            if(JSON.parse(localStorage.getItem("districts")) !='')
            {
                JSON.parse(localStorage.getItem("districts")).forEach(element => {
                    var selected = element.id== district ? 'selected' : '';
                    $("#district").append("<option value='"+element.id+"' "+selected+">"+element.name+"</option>")
                });
            }
        })

        function addWard()
        {
            $("#editWardModalLabel").text("Thêm xã/phường")
            $("#editWardModal select#sl_province").empty()
            $("#editWardModal select#sl_province").append("<option value=''>Chọn tỉnh</option>")
            $.ajax({
                type: "get",
                url: base + "/admin/district/province/list",
                success: function (response) {
                    console.log(response);
                        response.result.forEach(el => {
                            if(response.status==200)
                                {
                                    $("#editWardModal select#sl_province").append("<option value='"+el.id+"'>"+el.name+"</option>")
                                }
                        });
                }
            });
            $("#editWardModal").modal("show")
        }

    </script>


@endsection
