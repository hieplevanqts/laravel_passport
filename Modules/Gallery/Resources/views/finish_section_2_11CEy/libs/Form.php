<?php

class Form{

public static function showButtonAction($url, $class, $title, $icon){
    $xhtml = null;
    $xhtml .= sprintf('<a href="%s" type="button" class="btn btn-icon btn-%s"
            data-toggle="tooltip" data-placement="top"
            data-original-title="%s">
            <i class="fa fa-%s"></i>
        </a>', $url, $class, $title, $icon);

    return $xhtml;
}

public static function label($name, $required = true){
    $xhtml = null;
    $xhtmlRequired = '';
    if($required == true){
        $xhtmlRequired = '<span class="required">*</span>';
    }
    $xhtml .= sprintf('
    <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">%s %s
    </label>
    ', $name, $xhtmlRequired);

    return $xhtml;
}

public static function input($type, $name, $value = null, $class = null, $placeholder = null, $required = true){
    $xhtml = null;
    $xhtmlRequired = '';
    if($required == true){
        $xhtmlRequired = 'required';
    }
    $xhtml .= sprintf('
        <input type="%s" name="%s" value="%s" class="form-control %s" placeholder="%s"  %s>
    ', $type, $name, $value, $class, $placeholder, $xhtmlRequired);

    return $xhtml;
}

public static function imageOld($value = null, $id = null){
    $xhtml = null;
    if(isset($id) && !empty($value)){
        $xhtml .= sprintf('
            <img src="'.PATH_UPLOAD.'%s" alt="img_old" class="img-old">
        ', $value);
    }

    return $xhtml;
}

public static function textArea($name, $value = null){
    $xhtml = null;
    $xhtml .= sprintf('
        <textarea name="%s" class="form-control" id="description" cols="10" rows="5">%s</textarea>
    ', $name, $value);

    return $xhtml;
}

public static function inputImage($name){
    $xhtml = null;
    $xhtml .= sprintf('
        <input type="file" id="image_main" name="%s" class="form-control col-md-6 image-upload">
    ', $name);

    return $xhtml;
}

public static function button($name){
    $xhtml = null;
    $xhtml .= sprintf('
        <button type="submit" name="submit" class="btn btn-success">%s</button>
    ', $name);

    return $xhtml;
}

public static function show($elements){
    $xhtml = null;
    foreach ($elements as $key => $value) {
        $type = isset($value['type']) ? $value['type'] : "input";
        if($type == 'input'){
            $xhtml .= sprintf('
            <div class="item form-group">
                %s
                <div class="col-md-6 col-sm-6 input-wrapper">
                    %s
                </div>
            </div>
            ', $value['label'], $value['element']);
        }else{
            $xhtml .= sprintf('
            <div class="ln_solid"></div>
            <div class="item form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 offset-md-3">
                    %s
                </div>
            </div>
            ', $value['element']);
        }
    }

    return $xhtml;
}


}