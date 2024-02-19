<?php 
    session_start();
    if(isset($_SESSION['username'])){
        header("Location: login.php ");
    }
    if(isset($_SESSION['is_admin']) != 0) {
        header("Location: login.php ");
    }
    include "data.php";
    include "layout/header.php";
    include "layout/user_navbar.php";
    $db = new Database();
    $db_2 = new Database();
?>
<body>
    <div class="container">
        <div class="text-end">
            <form action="search.php" method="post">
                <div>
                    <label for="">ค้นหาสินค้า</label>
                    <input type="text" name="search" id="" class="mx-2 px-1">
                    <button type="submit" name="search" class="btn btn-success">ค้นหา</button>
                </div>
            </form>
        </div>
        <div class="row">
            <h3>สินค้า</h3>
            <?php
                $db->table = "product";
                $query = $db->select();
                while($i=mysqli_fetch_assoc($query)){ 
            ?>
            <div class="col">
                <div class="card" style="width: 18rem;">
                    <img src="<?php echo $i['pro_img']; ?>" class="card-img-top">
                    <div class="card-body">
                    <h5 class="card-title"><?php echo $i['pro_name']; ?></h5>
                    <p class="card-text"><?php echo $i['pro_detail']; ?></p>
                    <p><?php echo "ราคา " . $i['pro_price']; ?></p>
                    <a href="#" class="btn btn-primary">ซื้อสินค้า</a>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</body>