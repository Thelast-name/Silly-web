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
    $db = new Database();
?>
<body>
    <div class="container">
        <h3 class="text-center">แก้ไขประเภทสินค้า</h3>
        <form action="type_product.php" method="post" class="mt-5 text-center">
        <?php 
            $id = $_GET['id'];
            $db->table = "product_type";
            $db->condition = "WHERE type_id=" . $id;
            $query = $db->select();
            $i=mysqli_fetch_assoc($query)     
        ?>
            <div>
                <label for="tyep_name">ชื่อประเภทสินค้า</label>
                <input type="text" name="type_name" id="type_name" value="<?php echo $i['type_name'];?>">
            </div>
            <input type="hidden" name="id" value="<?php echo $i['type_id']; ?>">
            <button type="submit" class="btn btn-success mt-4" name="edit_type">บันทึก</button>
        </form>
    </div>
</body>