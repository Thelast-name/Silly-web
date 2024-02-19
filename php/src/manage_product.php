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
    $db_1 = new Database();
    $db = new Database();
?>
<body>
    <div class="container">
        <h3 class="text-center">การจัดการสินค้า</h3>
        <div class="d-flex justify-content-center">
            <a href="add_product.php" class="btn btn-outline-success">เพิ่มสินค้า</a>
            <form action="?" method="get" class="ms-auto">
                <div>
                    <label for="search">ค้นหาสินค้า</label>
                    <input type="text" name="search" id="search" class="mx-2 px-1">
                    <button type="submit" class="btn btn-success">ค้นหา</button>
                </div>
            </form>
        </div>
        <table class="table">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">ชื่อสินค้า</th>
                <th scope="col">img</th>
                <th scope="col">การจัดการ</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $limit = 10;
                    $cur_page = isset($_GET['page']) ? $_GET['page'] : 1;
                    $start = ($cur_page - 1) * $limit;

                    $search = "";
                    $db->table = "product";
                    $db->condition = " LIMIT {$start}, {$limit}";
                    if(isset($_GET['search'])){
                        $search = $_GET['search'];
                        $db->condition = "WHERE pro_name LIKE '%{$search}%'";
                    }
                    $n = 0;
                    $query = $db->select();

                    $db_1->field = "count(pro_id) AS pro_id";
                    $db_1->table = "product";
                    $q = $db_1->select();
                    $r = mysqli_fetch_assoc($q);
                    $total = $r['pro_id'];
                    $page = ceil($total / $limit);

                    while($i=mysqli_fetch_assoc($query)){ 
                    $n += 1;
                ?>
                <tr>
                <th scope="row"><?php echo $n; ?></th>
                <td><?php echo $i['pro_name'];?></td>
                <td><img src="<?php echo $i['pro_img'];?>" height="100px"></td>
                <td>
                    <a href="edit_product.php?id=<?php echo $i['pro_id']; ?>" class="btn btn-warning">แก้ไข</a>
                    <a href="product.php?id=<?php echo $i['pro_id']; ?>" class="btn btn-danger" onclick="return confirm('ต้องการลบข้อมูลนี้ใช่หรือไม่ ?');">ลบ</a>
                </td>
                <?php } ?>
            </tbody>
        </table>
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-end">
                <?php if($cur_page > 1) { ?>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?php echo $cur_page-1;?>">Previous</a>
                    </li>
                <?php } ?>
                <?php for($i=1; $i<= $page; $i++){ ?>
                <li class="page-item"><a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                <?php } ?>
                <?php if($page != $cur_page){ ?>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?php echo $cur_page+1; ?>">Next</a>
                    </li>
                <?php } ?>
            </ul>
        </nav>
    </div>

</body>