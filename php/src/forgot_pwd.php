<?php
    include "layout/header.php";
    include "data.php";
    $db_1 = new Database();
    $db = new Database();

    if(isset($_POST['fpwd'])){
        $fpwd = $_POST['fpwd'];
        $db_1->table = "users";
        $db_1->condition = "WHERE user_name = '{$fpwd}' OR user_email = '{$fpwd}'";
        $q = $db_1->select();
        $row = mysqli_fetch_assoc($q);
        $userEmail = $row['user_email'];

        $token = bin2hex(random_bytes(32));
        $date_expires = date('Y-m-d H:i:s', strtotime('+1 hour'));
        $db->table = "password_reset_tokens";
        $db->field = "user_email, token, expires_at";
        $db->val = "'{$userEmail}', '{$token}', '{$date_expires}'";
        $db->insert();

        // Send the token email
        $subject = "Password Reset";
        $message = "To reset your password, click on link: http://localhost:8000/reset_password.php?token=$token";
        $headers = "From: admin@example.com";
        mail($userEmail, $subject, $message, $headers);
    }
?>
<body>
    <div class="container">
        <h3 class="text-center">Reset Password</h3>
        <div class="w-50 m-auto">
            <p class="text-center">กรุณาใส่ emial หรือ usernmae รีเซ็ตรหัสผ่าน</p>
            <form action="?" method="post" class="text-center">
                <div class="mb-3 row">
                    <label for="" class="col-sm-3 col-form-label">user or email</label>
                    <div class="col-sm-8">
                        <input type="text" name="fpwd" id="" class="form-control">
                    </div>
                </div>
                <button type="submit" class="btn btn-success">Reset password</button>
            </form>
        </div>
    </div>
</body>