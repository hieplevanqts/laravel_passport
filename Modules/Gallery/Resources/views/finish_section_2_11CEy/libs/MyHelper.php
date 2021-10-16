<?php

class MyHelper{

public static function showNotify(){
    $xhtml = null;


    if (!empty($_SESSION['message'])) {
        $msg = $_SESSION['message'];
        $xhtml .= sprintf('
            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                <strong>Thật tuyệt!</strong>%s
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        ', $msg);
    }
    unset($_SESSION['message']);

    return $xhtml;
}

public static function redirect($link){
    header("location: $link");
    exit();
}


}