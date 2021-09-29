@extends('layouts.main')
@php
    use Illuminate\Support\Facades\Config;
    $heading = $title = "Quản lý tỉnh";
$menu = [
        ['label' => 'Danh sách', 'url' => url('category/index'),'options' => ['class' => 'btn btn-info']],
        ['label' => 'Thêm mới','url' => url('category/create'),'options' => ['class' => 'btn btn-info']]
    ];
$breadcrumb =[
    ['label' => "Trang chủ", 'url' => url('/admin')],
    ['label' => $heading, 'url' => url('/admin/province')],
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

        <form action="{{ route('province.index') }}" method="get" id="province_filter">
            @csrf
        <div class="row">
            <div class="col-md-3"><input type="text" class="form-control" name="name" placeholder="Tìm theo tên" onchange="province_filter()" value="{{ @$_GET['name'] }}"></div>
            <div class="col-md-3">
                <select name="area" id="" class="form-control" onchange="province_filter()">
                    <option value="">Chọn vùng</option>
                    <option value="1" {{ @$_GET['area']==1 ? "selected":"" }}>Vùng 1</option>
                    <option value="2" {{ @$_GET['area']==2 ? "selected":"" }}>Vùng 2</option>
                    <option value="3" {{ @$_GET['area']==3 ? "selected":"" }}>Vùng 3</option>
                    <option value="4" {{ @$_GET['area']==4 ? "selected":"" }}>Vùng 4</option>
                </select>
            </div>
            <div class="col-md-2"><button class="btn btn-default">Tìm kiếm</button></div>
        </div>
    </form>
    </div>
    <div class="col-md-4">
        <button class="btn btn-primary" onclick="addProvince()"><i class="fas fa-plus"></i> Thêm</button>
    </div>

</div>
    <div class="card card-outline card-info" id="province_main">
        <div class="card-body p-0">

            <table class="table table-bordered table-striped table-hover table-sm">
                <thead>
                   <tr height="45">
                      <th width="5%">#</th>
                      <th>
                        Name
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
                                    <td>{{ @$item->region }}</td>
                                    <td>
                                        <a onClick="editProvice({{ $item->id }})" href="javascript:void(0)" class="btn btn-warning btn-xs"><i class="fas fa-edit"></i></a>
                                        <a onclick="return confirm('Bạn có chắc chắn xóa không ?')" href="{{ URL::to('/admin/province/delete') }}/{{ @$item->id }}" class="btn btn-danger btn-xs"><i class="far fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                        @endforeach
                   @endif
                </tbody>
                <tfoot>

                </tfoot>
             </table>
             <br>
            <div class="text-center pagination__link"> {{ $list->appends(['_token'=>@$_GET['_token'], 'name' => @$_GET['name'], 'area' => @$_GET['area']])->links() }}</div>
        </div>
    </div>
    @include('local::local.province.modal')
@endsection

@section('script')
@parent
    <script>

        var base = $("#base").attr('content')
        function editProvice(id){
            $.ajax({
                type: "get",
                url: base + "/admin/province/edit/" + id,
                success: function (response) {
                    if(response.status==200)
                    {
                        $("#editProvinceModalLabel").text(response.result.action)
                        $("#editProvinceModal input[name='name']").val(response.result.item.name)
                        $("#editProvinceModal select option").each(function (arrayIndex, el) {
                            if($(el).attr("value")==response.result.item.region)
                            {
                                $(this).attr("selected", "selected");
                                $("#updateProvince").attr("onClick", "update_Province("+response.result.item.id+")")
                            }
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
            var data = {id : id, name: name, region: area, _token: token}
            if(id==null)
            {
                var data = {name: name, region: area, _token: token}
            }
            console.log(data);
            $.ajax({
                type    :"POST",
                url: base + "/admin/province/postEdit",
                data: data,
                success: function (response) {
                    window.location.reload();
                }
            });
        }

        function province_filter()
        {
            $("#province_filter").submit()
        }

        function addProvince()
        {
            $("#editProvinceModalLabel").text("Thêm tỉnh/tp")
            $("#editProvinceModal").modal("show")
        }


    </script>


@endsection
