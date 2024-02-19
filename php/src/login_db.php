<?php
    session_start();
    include "data.php";
    $db = new Database();

    if(isset($_POST['login'])){
        $user_name = $_POST['user_name'];
        $pass = $_POST['pass'];
        $db->table = "users";
        $db->field = "user_name, user_passowrd,is_pri";
        $db->condition = "WHERE user_name='{$user_name}' AND user_passowrd='{$pass}'";
        $q = $db->select();
        $i=mysqli_fetch_assoc($q);
        if(!empty($i)){
            if($i['is_pri'] == '1'){
                $_SESSION['user_name'] = $i['user_name'];
                $_SESSION['is_admin'] = $i['is_pri'];
                header("location: admin.php");
            }else {
                $_SESSION['user_name'] = $i['user_name'];
                header("location: user_index.php");
            }
        }else{
            $_SESSION['error'] = "ไม่พบ username หรือ password"; 
            header("location: login.php");
        }
    }