<?php
    session_start();
    include "data.php";
    $db = new Database();
    $db_check = new Database();
   

    if(isset($_POST['register'])) {
    $arr_err = array();
    $user_name = $_POST['user_name'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $is_pri = $_POST['is_pri'];
    $check_empty = array($user_name, $email, $pass, $is_pri);

    // เช็คค่าว่าง
    $arrlength = count($check_empty);
    for ($x = 0; $x < $arrlength; $x++) {
        if (empty($check_empty[$x])) {
            array_push($arr_err, "กรุณากรอกให้ครบทุกช่องด้วย!!");
        }
    }

    // validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($arr_err, "email address ไม่ถูกต้อง");
    }

    // เช็คชื่อซ้ำ
    $db_check->table = "users";
    $db_check->condition = "WHERE user_name ='{$user_name}' or user_email ='{$email}'";
    $q = $db_check->select();
    $r = mysqli_fetch_assoc($q);

    if (!is_null($r)) {
        array_push($arr_err, "ชื่อนี้มีแล้วเอาชื่ออื่น!!");
    }

    // เช็คจำนวน error
    if (count($arr_err) == 0) {
        //hash password
        $hash_pwd = md5($pass);
        $db->table = "users";
        $db->field = "user_name, user_email, user_passowrd, is_pri";
        $db->val = "'{$user_name}','{$email}', '{$hash_pwd}', '{$is_pri}'";
        $query = $db->insert();

        if ($query) {
            header("location: login.php");
            exit();
        }
    } else {
        $_SESSION['error'] = array_unique($arr_err);
        header("location: register.php");
        exit();
    }

}