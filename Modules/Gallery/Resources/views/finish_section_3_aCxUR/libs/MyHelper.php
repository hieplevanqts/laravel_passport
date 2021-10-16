<?php

class MyHelper{

public static function showNotify(){
    $xhtml = null;


    if (!empty($_SESSION['message'])) {
        if(!empty($_SESSION['message']['success'])){
            $msg = $_SESSION['message']['success'];
            $class = 'primary';
            $notify = 'Thật tuyệt! ';
        }else{
            $msg = $_SESSION['message']['error'];
            $class = 'danger';
            $notify = 'Lỗi rồi! ';
        }
        $xhtml .= sprintf('
            <div class="alert alert-%s alert-dismissible fade show" role="alert">
                <strong>%s</strong>%s
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        ',$class, $notify, $msg);
    }
    unset($_SESSION['message']);

    return $xhtml;
}

public static function redirect($link){
    header("location: $link");
    exit();
}


}