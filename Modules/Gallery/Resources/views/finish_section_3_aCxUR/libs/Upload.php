<?php

class Upload{
    
    public function uploadFileMulty($fileObj, $alts, $ordering, $imgOld = null){
        $arrImage = [];
        foreach ($fileObj['name'] as $key => $value) {
            if(!empty($fileObj['tmp_name'][$key])){
              
                $this->removeFile(@$imgOld[$key]['image']);               // remove image old

                $fileNameImage['image'] = $this->randomFileName($fileObj['name'][$key]);
                move_uploaded_file($fileObj['tmp_name'][$key], PATH_UPLOAD . $fileNameImage['image']);
                $arrImage[$key]['image'] = $fileNameImage['image'];
            }else{
                $arrImage[$key]['image'] = !empty($imgOld[$key]['image']) ? $imgOld[$key]['image'] : '';
            }

            $arrImage[$key]['ordering'] = !empty($ordering[$key]) ? $ordering[$key] : $key + 1;
            $arrImage[$key]['alt'] = !empty($alts[$key]) ? $alts[$key] : '';
        }
        // echo '<pre style="color:red">';
        // print_r($arrImage);
        // echo '</pre>';
        // die('This is a test');
        return $arrImage;
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
        $fileName   = PATH_UPLOAD . $fileName;
        if(file_exists($fileName)){
            @unlink($fileName);
        }
    }

}