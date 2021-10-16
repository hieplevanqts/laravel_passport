<?php

class Upload{

    public function uploadFile($fileObj, $altMain, $imgOld = null){
        if(!empty($fileObj['tmp_name'])){
            
            $this->removeFile(@$imgOld['image']);  // remove image old

            $fileNameMain['image'] = $this->randomFileName($fileObj['name']);
            $fileNameMain['alt']   = $altMain;
            move_uploaded_file($fileObj['tmp_name'], PATH_UPLOAD . $fileNameMain['image']);
        }else{
            $fileNameMain['image'] = !empty($imgOld['image']) ? $imgOld['image'] : '';
            $fileNameMain['alt']   = $altMain;
        }
        // echo '<pre style="color:red">';
        // print_r($fileNameMain);
        // echo '</pre>';
        // die('This is a test');
        return $fileNameMain;
    }
    
    public function uploadFileMulty($fileObj, $altExtra, $ordering, $imgOld = null){
        $arrExtra = [];
        foreach ($fileObj['name'] as $key => $value) {
            if(!empty($fileObj['tmp_name'][$key])){

                $this->removeFile(@$imgOld[$key]['image']);  // remove image old
                
                $fileNameExtra['image'] = $this->randomFileName($fileObj['name'][$key]);
                move_uploaded_file($fileObj['tmp_name'][$key], PATH_UPLOAD . $fileNameExtra['image']);
                $arrExtra[$key]['image'] = $fileNameExtra['image'];
            }else{
                $arrExtra[$key]['image'] = !empty($imgOld[$key]['image']) ? $imgOld[$key]['image'] : '';
            }
            $arrExtra[$key]['ordering'] = !empty($ordering[$key]) ? $ordering[$key] : $key + 1;
            $arrExtra[$key]['alt']      = !empty($altExtra[$key]) ? $altExtra[$key] : '';
        }
        return $arrExtra;
    }

    public function randomFileName($fileName, $length = 9){
        $arrCharacter = array_merge(range('A', 'Z'), range('a', 'z'), range(0, 9));
        $arrCharacter = implode('', $arrCharacter);
        $arrCharacter = str_shuffle($arrCharacter);

        $extension = '.' . pathinfo($fileName, PATHINFO_EXTENSION);
        $result = substr($arrCharacter, 0, $length) . $extension;

        return $result;
    }

    public function removeFile($fileName){
        $fileName = PATH_UPLOAD . $fileName;
        if(file_exists($fileName)){
            unlink($fileName);
        }
    }

}