<?php
    session_start();
    include "layout/header.php";
?>
<body>
    <div class="container">
        <h3 class="text-center mt-5">Register for Free</h3>
        <div class="w-50 m-auto">
        <?php if(!empty($_SESSION['error'])) { ?>
            <div class="w-25 m-auto">
                <div class="p-1 mb-2 bg-danger text-white">
                    <?php
                        foreach ($_SESSION['error'] as $x) { 
                    ?>
                            <p class="text-center"><?php echo $x; ?></p>
                            <?php 
                                }
                                unset($_SESSION['error']);
                            ?> 
                </div>
            </div>
        <?php } ?>
            <form action="register_db.php" method="post" class="text-center mt-4">
                <div class="mb-3 row">
                    <label for="" class="col-sm-3 col-form-label">user name</label>
                    <div class="col-sm-8">
                        <input type="text" name="user_name" id="" class="form-control">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="" class="col-sm-3 col-form-label">email</label>
                    <div class="col-sm-8">
                        <input type="email" name="email" id="" class="form-control">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="" class="col-sm-3 col-form-label">password</label>
                    <div class="col-sm-8">
                        <input type="password" name="pass" id="" class="form-control">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="" class="col-sm-3 col-form-label">เลือกผู้ใช้</label>
                    <div class="col-sm-8">
                        <select name="is_pri" id="" class="form-select">
                            <option value="1">ร้านค้า</option>
                            <option value="0">ผู้ใช้</option>
                        </select>
                    </div>
                </div>
                <button type="submit" name="register" class="btn btn-success">register</button>
                <p class="mt-2">I have an account? <a href="login.php">login</a></p>
            </form>
        </div>
    </div>
</body>