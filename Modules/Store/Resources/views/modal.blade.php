<!-- Modal -->
<div class="modal fade" id="modal_store_detail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Chi tiết gian hàng</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md 8">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-12">

                                <div class="form-group">
                                    <label for="name" class="col-form-label">Tên gian hàng <span class="text-danger"></span></label><input id="name" type="text" name="name" class="form-control" placeholder="Nhập tên gian hàng..." required="" disabled/>
                                </div>
                                <div class="form-group">
                                    <label for="name" class="col-form-label">Số điện thoại <span class="text-danger"></span></label><input id="phone" type="text" name="phone" class="form-control" placeholder="Nhập số điện thoại..." required="" disabled/>
                                </div>
                                <div class="form-group">
                                    <label for="name" class="col-form-label">Email <span class="text-danger"></span></label><input id="email" type="text" name="email" class="form-control" placeholder="Nhập email..." required="" disabled/>
                                </div>
                                <div class="form-group">
                                    <label for="name" class="col-form-label">Chọn địa chỉ (google)<span class="text-danger"></span></label><input id="address_google" type="text" name="address_google" class="form-control" placeholder="Chọn địa chỉ (google)..." required="" disabled/>
                                </div>
                                <div class="form-group">
                                    <label for="name" class="col-form-label">Địa chỉ (Tùy chọn)<span class="text-danger"></span></label>
                                    <textarea name="address" id="address" cols="30" rows="3" class="form-control" placeholder="Nhập địa chỉ (Tùy chọn)..." disabled></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="name" class="col-form-label">Mô tả ngắn<span class="text-danger"></span></label>
                                    <textarea name="description" id="description" cols="30" rows="3" class="form-control" placeholder="Nhập mô tả ngắn..." disabled></textarea>
                                </div>
                                <div class="form-group form-check"><input type="checkbox" name="status" class="form-check-input" id="status" disabled/><label class="form-check-label" for="status">Kích hoạt</label></div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-title bg-info p-2 rounded-top">Logo</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-12"><img id="md_logo" src="https://via.placeholder.com/640x480.png/00dd99?text=consequatur" alt="..." class="img-thumbnail md_logo_ok" width="200" height="200" /></div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-title bg-info p-2 rounded-top">Banner</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-12"><img id="md_banner" src="https://via.placeholder.com/640x480.png/00dd99?text=consequatur" alt="..." class="img-thumbnail" width="200" height="200" /></div>
                        </div>
                    </div>
                </div>

            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
