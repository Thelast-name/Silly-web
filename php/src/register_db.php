<?php
    include "data.php";
    $db = new Database();

    if(isset($_POST['register'])) {
        $user_name = $_POST['user_name'];
        $email = $_POST['email'];
        $pass = $_POST['pass'];
        $is_pri = $_POST['is_pri'];

        $db->table = "users";
        $db->field = "user_name, user_email, user_passowrd, is_pri";
        $db->val = "'{$user_name}','{$email}', '{$pass}', '{$is_pri}'";
        $query = $db->insert();

        if($query) {
            header("location: login.php");
        }
    }