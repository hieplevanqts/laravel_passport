<?php
// echo $_SERVER['PHP_SELF'];
$currentFile = pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME);
if($currentFile == 'index'){
    $xhtmlBtn = '<a href="form.php" class="btn btn-success"><i class="fa fa-plus-circle"></i> Thêm mới</a>';
}else{
    $xhtmlBtn = '<a href="index.php" class="btn btn-success"><i class="fa fa-arrow-left"></i> Quay về</a>';
}

?>



<div class="page-title">
    <div class="title_left">
        <h3>Quản lý sản phẩm</h3>
    </div>
    <div class="title_right">
        <div class="col-md-5 col-sm-5 form-group pull-right top_search text-right">
            <?= $xhtmlBtn ?>
        </div>
    </div>
    
</div>