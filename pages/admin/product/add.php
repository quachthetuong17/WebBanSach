<?php
session_start();
require_once '../../../controllers/ProductController.php';

$request=[];
$action=!empty($_POST['action']) ? $_POST['action'] : null;
$input_name=!empty($_POST['input_name']) ? $_POST['input_name'] : null;
$input_des=!empty($_POST['input_des']) ? $_POST['input_des'] : null;
$price=!empty($_POST['price']) ? $_POST['price'] : null;
$image=!empty($_FILES['image']) ? $_FILES['image'] : null;
if(!empty($_POST['categori_id']))
{
    $categori_id=$_POST['categori_id'];
}
else{
    $categori_id=1;
}
if(!empty($_POST['special'])){
    if($_POST['special']=='true'){
        $special=1;
    }else{
        $special=-1;
    }
}else{
    $special=0;
}

$request=['action'=>$action,'input_name'=>$input_name,'input_des'=>$input_des,
    'price'=>$price,'image'=>$image,'categori_id'=>$categori_id,'special'=>$special];
//if(!empty($_POST['input_name'])&&!empty($_POST['input_des'])&&!empty($_POST['price'])&&!empty($_POST['image'])&&!empty($_POST['categori_id'])){
//    $input_name=$_POST['input_name'];
//    $input_des=$_POST['input_des'];
//    $price=$_POST['price'];
//    $image=$_POST['image'];
//    $categori_id=$_POST['categori_id'];
//    if($_POST['special']=='true'){
//        $special=1;
//    }else{
//        $special=-1;
//    }
//    $request=['input_name'=>$input_name,'input_des'=>$input_des,'price'=>$price,'image'=>$image,'categori_id'=>$categori_id,'special'=>$special];
//}
//else{
//    $request=[];
//}

$product=new ProductController();
$product->add($request);


