<?php
    session_start();
    include "layout/header.php";
?>
<head>
    <title>Login</title>
</head>
<body>
    <div class="container" style="margin-top: 5rem;">
        <h3 class="text-center">Login to Silly web</h3>
        <div style="margin:5rem">
            <div class="w-50 m-auto">
                <form action="login_db.php" method="post" class="text-center">
                    <?php 
                        if(isset($_SESSION['error'])){ ?>
                            <div class="w-30 m-auto">
                                <div class="p-1 mb-2 bg-danger text-white">
                                <p class="text-center"><?php echo $_SESSION['error'];?></p> 
                                    <?php unset($_SESSION['error']); ?>
                                </div>
                            </div>

                    <?php } ?>
                    <div class="mb-3 row">
                        <label for="" class="col-sm-3 col-form-label">User name</label>
                        <div class="col-sm-8">
                            <input type="text" name="user_name" id="" class="form-control">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="" class="col-sm-3 col-form-label">Passowrd</label>
                        <div class="col-sm-8">
                            <input type="password" name="pass" id="" class="form-control">
                        </div>
                    </div>
                    <p class="text-end text-lowercase"><a href="forgot_pwd.php">Forgot password?</a></p>
                    <button type="submit" class="btn btn-success px-3 py-2" name="login">login</button>
                    <p class="mt-3">I don't have account? <a href="register.php">create account</a></p>
                </form>
            </div>
        </div>
    </div>
</body>