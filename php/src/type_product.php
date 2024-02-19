<?php
    session_start();
    include "data.php";
    $db = new Database();
    
    if(isset($_POST['add_type'])){
        if(!empty($_POST['type_name'])){
            $type_name = $_POST['type_name'];
            $db->table = "product_type";
            $db->field = "type_name";
            $db->val = "'{$type_name}'";
            $query = $db->insert();

            if($query) {
                header("location: manage_type.php");
            }
        }else{
            $_SESSION['error'] = "กรุณากรอกชื่อประเภทสินค้าด้วย!!"; 
            header("location:add_type_pro.php");
        }
    }

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
