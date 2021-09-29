

  <!-- Modal -->
  <div class="modal fade" id="editWardModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editWardModalLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('province.postEdit') }}" method="post">
                @csrf
            <div class="row">

                <div class="form-group col-md-12">
                    <label for="">Chọn tỉnh</label>
                    <select name="province" id="sl_province" class="form-control" onchange="get_district(this)">
                        <option value="">Chọn tỉnh</option>

                    </select>
                </div>
                <div class="form-group col-md-12">
                    <label for="">Chọn huyện</label>
                    <select name="district" id="sl_district" class="form-control">
                        <option value="">Chọn huyện</option>

                    </select>
                </div>
                <div class="form-group col-md-12">
                    <label for="">Nhập xã</label>
                    <input type="text" name="name" value="" class="form-control" placeholder="Nhập xã ...">
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button onClick="update_Ward()" id="updateWard" type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </form>
    </div>
  </div>
