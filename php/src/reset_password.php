<?php
    if(empty($_GET['token'])){
        header("location: login.php");
    }
    include "layout/header.php";
    include "data.php";

    $db_1 = new Database();
    $db = new Database();

    if(isset($_POST['new_password'])){
        $new_password = $_POST['new_password'];
        $token = $_POST['token'];
        $db->table = "users";
        $db->val = "user_passowrd='{$new_password}'";
        $db->condition = "WHERE user_email = (SELECT user_email FROM password_reset_tokens WHERE token = '{$token}')";
        $db->update();

        // delete token in database
        $db_1->table = "password_reset_tokens";
        $db_1->condition = "WHERE token = '{$token}'";
        $r = $db_1->delete();
    }
?>
<head>
    <title>New Password</title>
</head>
<body>
    <div class="contaier">
        <h3 class="text-center">New Password</h3>
        <div class="w-50 m-auto">
            <form action="?" method="post" class="text-center">
                <div class="mb-3 row">
                    <label for="new_password" class="col-sm-3 col-form-label">New Passowrd</label>
                    <div class="col-sm-8">
                        <input type="password" name="new_password" id="new_password" class="form-control">
                    </div>
                </div>
                <input type="hidden" name="token" value="<?php echo $token = $_GET['token']; ?>">
                <button type="submit" class="btn btn-success">New Password</button>
            </form>
        </div>
    </div>
</body>