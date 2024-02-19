<?php
    session_start();
    include "data.php";
    $db_check = new Database();
    $db = new Database();
    
    // เพิ่มประเภทสินค้า
    if(isset($_POST['add_type'])){
        $type_name = $_POST['type_name'];
        $arr_err = array();
        if(empty($type_name)){
            array_push($arr_err, "กรุณากรอกชื่อประเภทสินค้าด้วย!!"); 
        }

        $db_check->table = "product_type";
        $db_check->field = "type_name";
        $db_check->condition = "WHERE type_name='{$type_name}'";
        $q = $db_check->select();
        $r = mysqli_fetch_assoc($q);
        // เช็คชื่อซ้ำ
        if(!is_null($r)){
            array_push($arr_err,"ชื่อนี้มีแล้วเอาชื่ออื่น!!");            
        }
        // เช็คจำนวน error
        if(count($arr_err) == 0){
            $db->table = "product_type";
            $db->field = "type_name";
            $db->val = "'{$type_name}'";
            $query = $db->insert();

            if($query) {
                header("location: manage_type.php");
                exit;
            }
        }else{
            $_SESSION['error'] = array_unique($arr_err);
            header("location:add_type_pro.php");
            exit;
        }
            
    }

    // แก้ไขประเภทสินค้า
    if(isset($_POST['edit_type'])){
        $id = $_POST['id'];
        $type_name = $_POST['type_name'];
        

        $db->table = "product_type";
        $db->val = "type_name='{$type_name}'";
        $db->condition = "WHERE type_id={$id}";
        $query = $db->update();

        if($query){
            header('location: manage_type.php');
        }
    }

    // ลบประเภทสินค้า
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $db->table = "product_type";
        $db->condition = " WHERE type_id=" . $id;
        $query = $db->delete();
        
        if($query){
            header('location: manage_type.php');
        }
    }
?>
