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
        <h3 class="text-center">เพิ่มสินค้า</h3>
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
        <form action="product.php" method="post" class="mt-5 text-center" enctype="multipart/form-data">
            <div class="mb-3 row">
                <label for="" class="col-sm-2 col-form-label">ชื่อสินค้า</label>
                <div class="col-sm-10">
                    <input type="text" name="product_name" id="" class="form-control">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="" class="col-sm-2 col-form-label">รายละเอียด</label>
                <div class="col-sm-10">
                    <textarea name="product_detail" id=""  rows="3" class="form-control"></textarea>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="" class="col-sm-2 col-form-label">ราคา</label>
                <div class="col-sm-10">
                    <input type="text" name="product_price" id="" class="form-control">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="" class="col-sm-2 col-form-label">หน่วย</label>
                <div class="col-sm-10">
                    <input type="text" name="product_unit" id="" class="form-control">
                </div> 
            </div>
            <div class="mb-3 row">
                <div class="col-sm-10">
                    <input type="file" name="img" id="">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="" class="col-sm-2 col-form-label">ประเภทสินค้า</label>
                <div class="col-sm-10">
                    <select name="type_product" id="" class="form-select">
                        <?php
                            $db->table = "product_type";
                            $query = $db->select();
                            while($r=mysqli_fetch_assoc($query)){ 
                        ?>
                        <option value="<?php echo $r['type_id']; ?>"><?php echo $r['type_name'];?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-success mt-4" name="add_product">บันทึก</button>
        </form>
    </div>
</body>