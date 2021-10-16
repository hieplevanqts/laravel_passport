<?php
require_once 'connect.php';

$product = $obj->get($_GET['id']);
$name = $product['name'];
$price = $product['price'];
$description = $product['description'];
$imgMain = $product['image_main']['image'];
$altMain = @$product['image_main']['alt'];
$imgExtra = $product['image_extra'];

$arrOrdering = [];
for ($i=0; $i < count($imgExtra); $i++) { 
    if(!empty($imgExtra[$i]['ordering'])){
        $arrOrdering[$i] = $imgExtra[$i]['ordering'];
    }
}

$sortImgExtra = array_combine($arrOrdering, $imgExtra);

ksort($sortImgExtra); // sắp xếp các phần tử trong mảng dựa vào key

$xhtml = '';
$xhtml = '
<div class="col-md-7 col-sm-7">
    <div class="demo">
        <ul id="lightSlider">
            <li data-thumb="'.PATH_UPLOAD.$imgMain.'">
                <img src="'.PATH_UPLOAD.$imgMain.'" alt="'.$altMain.'"/>
            </li>
        ';
            foreach ($sortImgExtra as $key => $value) {
                if(!empty($value['image'])){
                    $xhtml .= '
                    <li data-thumb="'.PATH_UPLOAD.$value['image'].'">
                        <img src="'.PATH_UPLOAD.$value['image'].'" alt="'.$value['alt'].'"/>
                    </li>
                    ';
                }
            }

            $xhtml .= '
        </ul>
    </div>
</div>
<div class="col-md-5 col-sm-5 " style="border:0px solid #e5e5e5;">
    <h3 class="prod_title">'.$name.'</h3>
    <p>'.$description.'</p>
    <div class="product_price">
        <h1 class="price">'.number_format($price).'đ</h1>
    </div>
</div>
';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once 'html/head.php' ?>
</head>
<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            <?php require_once 'html/sidebar.php' ?>

            <?php require_once 'html/top-nav.php' ?>
            
            <!-- page content -->
            <div class="right_col" role="main" style="min-height: 2436px;">
                <?php require_once 'html/page-header.php' ?>
                
                <div class="clearfix"></div>
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="x_panel">
                            <?php require_once 'html/x-title.php' ?>
                        <div class="x_content">
                            <?= $xhtml ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /page content -->

        <?php require_once 'html/footer.php' ?>                                            
            
        </div>
        
        <?php require_once 'html/script.php' ?> 
</body>
</html> 