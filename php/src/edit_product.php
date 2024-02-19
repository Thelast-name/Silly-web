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
    $db_2 = new Database();

?>
<body>
    <div class="container">
        <h3 class="text-center">แก้ไขสินค้า</h3>
        <?php 
            $id = $_GET['id'];
            $db->table = "product";
            $db->condition = "WHERE pro_id=" . $id;
            $query = $db->select();
            $i=mysqli_fetch_assoc($query)
                
        ?>
        <form action="product.php" method="post" class="mt-5 text-center" enctype="multipart/form-data">
            <div class="mb-3 row">
                <label for="" class="col-sm-2 col-form-label">ชื่อสินค้า</label>
                <div class="col-sm-10">
                    <input type="text" name="product_name" id="" class="form-control" value="<?php echo $i['pro_name']; ?>">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="" class="col-sm-2 col-form-label">รายละเอียด</label>
                <div class="col-sm-10">
                    <textarea name="product_detail" id="" cols="3" class="form-control"><?php echo $i['pro_detail']; ?></textarea>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="" class="col-sm-2 col-form-label">ราคา</label>
                <div class="col-sm-10">
                    <input type="text" name="product_price" id="" class="form-control" value="<?php echo $i['pro_price']; ?>">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="" class="col-sm-2 col-form-label">หน่วย</label>
                <div class="col-sm-10">
                    <input type="text" name="product_unit" id="" class="form-control" value="<?php echo $i['pro_unit']; ?>">
                </div>
            </div>
            <div class="mb-3 row">
                <div class="col-sm-10">
                    <input type="file" name="img" id="" value="<?php echo $i['pro_img']; ?>">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="" class="col-sm-2 col-form-label">ประเภทสินค้า</label>
                <div class="col-sm-10">

                    <select name="type_product" id="" class="form-select">
                        <?php
                            $db_2->table = "product_type";
                            $q = $db_2->select();
                            while($r=mysqli_fetch_assoc($q)){ 
                        ?>
                            <option value="<?php echo $r['type_id']; ?>"><?php echo $r['type_name'];?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <input type="hidden" name="id" value="<?php echo $i['pro_id']; ?>">
            <button type="submit" class="btn btn-success mt-4" name="edit_product">บันทึก</button>
        </form>
    </div>
</body>