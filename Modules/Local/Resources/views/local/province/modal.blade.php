

  <!-- Modal -->
  <div class="modal fade" id="editProvinceModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editProvinceModalLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('province.postEdit') }}" method="post">
                @csrf
            <div class="row">
                <div class="form-group col-md-12">
                    <label for="">Tên</label>
                    <input type="text" name="name" value="" class="form-control" placeholder="Nhập tên ...">
                </div>
                <div class="form-group col-md-12">
                    <label for="">Vùng</label>
                    <select name="area" id="" class="form-control">
                        <option value="">Chọn vùng</option>
                        <option value="1">Vùng 1</option>
                        <option value="2">Vùng 2</option>
                        <option value="3">Vùng 3</option>
                        <option value="4">Vùng 4</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button onClick="update_Province()" id="updateProvince" type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </form>
    </div>
  </div>
