<?php
    session_start();
    include "data.php";
    $db_check = new Database();
    $db = new Database();

    // เพิ่มข้อมูล product
    if(isset($_POST['add_product'])){
        $arr_err = array();
        $pro_name = $_POST['product_name'];
        $pro_detail = $_POST['product_detail'];
        $pro_price = $_POST['product_price'];
        $pro_unit = $_POST['product_unit'];
        $fileupload = $_FILES['img'];
        $type_product = $_POST['type_product'];
        $check_empty =array($pro_name, $pro_detail, $pro_price, $pro_unit,  $type_product);

        // เช็คค่าว่าง
        $arrlength=count($check_empty);
        for($x=0;$x<$arrlength;$x++)
        {
            if(empty($check_empty[$x])){
                array_push($arr_err, "กรุณากรอกให้ครบทุกช่องด้วย!!");
            }
        }
        if($_FILES['img']['size'] == 0){
            array_push($arr_err, "กรุณาอัปโหลดรูปด้วย!!");
        }
        // เช็คชื่อซ้ำ
        $db_check->table = "product";     
        $db_check->condition = "WHERE pro_name='{$pro_name}'";
        $q = $db_check->select();
        $r = mysqli_fetch_assoc($q);
        if(!is_null($r)){
            array_push($arr_err, "ชื่อนี้มีแล้วเอาชื่ออื่น!!");
        }
        // เช็คจำนวน error
        if(count($arr_err) == 0) {
            // upload image
             if($fileupload <> ''){
                $path = "uploads/" . uniqid() . "_{$type_product}_" . ".jpg";
                move_uploaded_file($_FILES['img']['tmp_name'], $path);
             }
            $db->table = "product";
            $db->field = "pro_name, pro_detail, pro_price, pro_unit, pro_img, type_id ";
            $db->val = "'{$pro_name}','{$pro_detail}', '{$pro_price}', '{$pro_unit}', '{$path}' ,'{$type_product}'";
            $query = $db->insert();

            if($query) {
                header("location: manage_product.php");
                exit();
            }
        }else {
            $_SESSION['error'] = array_unique($arr_err);
            header("location:add_product.php");
            exit();
        }
        
    }

    // แก้ไขข้อมูล product
    if(isset($_POST['edit_product'])){
        $arr_err = array();
        $id = $_POST['id'];
        $pro_name = $_POST['product_name'];
        $pro_detail = $_POST['product_detail'];
        $pro_price = $_POST['product_price'];
        $pro_unit = $_POST['product_unit'];
        $fileupload = $_FILES['img'];
        $type_product = $_POST['type_product'];

        $check_empty =array($pro_name, $pro_detail, $pro_price, $pro_unit,  $type_product);
        // เช็คค่าว่าง
        $arrlength=count($check_empty);
        for($x=0;$x<$arrlength;$x++)
        {
            if(empty($check_empty[$x])){
                array_push($arr_err, "กรุณากรอกให้ครบทุกช่องด้วย!!");
            }
        }
        if($_FILES['img']['size'] == 0){
            // เช็คจำนวน error
            if(count($arr_err) == 0) {
                $db->table = "product";
                $db->val = "pro_name='{$pro_name}',pro_detail='{$pro_detail}',pro_price='{$pro_price}', pro_unit='{$pro_unit}', type_id='{$type_product}'";
                $db->condition = "WHERE pro_id={$id}";
                $query = $db->update();

                if($query) {
                    header("location: manage_product.php");
                }
            }else {
                $_SESSION['error'] = array_unique($arr_err);
                header("location: edit_product.php?id=$id");
                exit();
            }
        }else{
            // upload image
            if($fileupload <> ''){
                $path = "uploads/" . uniqid() . "_{$type_product}_" . ".jpg";
                move_uploaded_file($_FILES['img']['tmp_name'], $path);
             }
             $db->table = "product";
             $db->val = "pro_name='{$pro_name}',pro_detail='{$pro_detail}',pro_price='{$pro_price}', pro_unit='{$pro_unit}', pro_img='{$path}' , type_id='{$type_product}'";
             $db->condition = "WHERE pro_id={$id}";
             $query = $db->update();

             if($query) {
                 header("location: manage_product.php");
                 exit();
             }
        }        
    }

    // ลบข้อมูล product
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $db->table = "product";
        $db->condition = " WHERE pro_id=" . $id;
        $query = $db->delete();
        
        if($query){
            header('location: manage_product.php');
            exit();
        }
    }