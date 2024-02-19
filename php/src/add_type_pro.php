<?php
    session_start();
    if(isset($_SESSION['username'])){
        header("Location: login.php ");
    }
    if(isset($_SESSION['is_admin']) != 1) {
        header("Location: login.php ");
    }
    include "data.php";
    include "layout/header.php";
    include "layout/navbar.php";
?>
<body>
    <div class="container">
        <h3 class="text-center">เพิ่มประเภทสินค้า</h3>
        <form action="type_product.php" method="post" class="mt-5 text-center">
            <div>
                <div class="w-25 m-auto">
                    <?php if(!empty($_SESSION['error'])) { ?>
                        <div class="p-1 mb-2 bg-danger text-white">
                            <p class="text-center">
                                <?php 
                                    echo $_SESSION['error'];
                                    unset($_SESSION['error']);
                                ?>
                            </p>
                        </div>
                    <?php } ?>
                </div>
                <label for="tyep_name">ชื่อประเภทสินค้า</label>
                <input type="text" name="type_name" id="type_name">
            </div>
            <button type="submit" class="btn btn-success mt-4" name="add_type">บันทึก</button>
        </form>
    </div>
</body>