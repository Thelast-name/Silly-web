<?php 
    session_start();
    if(isset($_SESSION['username'])){
        header("Location: login.php ");
    }
    if(isset($_SESSION['is_admin']) != 0) {
        header("Location: login.php ");
    }
    include "data.php";
    include "validate.php";
    include "layout/header.php";
    include "layout/user_navbar.php";
    $db = new Database();
    $db_1 = new Database();
    $vali = new Validate();
?>
<body>
    <div class="container">
        <div class="text-end">
            <form action="?" method="get">
                <div>
                    <label for="">ค้นหาสินค้า</label>
                    <input type="text" name="search" id="" class="mx-2 px-1">
                    <button type="submit" class="btn btn-success">ค้นหา</button>
                </div>
            </form>
        </div>
        <h3>สินค้า</h3>
        <div class="d-flex align-content-start flex-wrap" style="gap: 15px">
            <?php
                $limit = 10;
                $cur_page = isset($_GET['page']) ? $_GET['page'] : 1;
                $start = ($cur_page - 1) * $limit;

                $db->table = "product";
                $db->field = "*, CONCAT(LEFT(pro_name, 15),'...') AS New_name";
                $db->condition = " LIMIT {$start}, {$limit}";
                //ค้นหา
                if(isset($_GET['search'])){
                    $search = $_GET['search'];
                    $v = $vali->validate_string($search);
                    if($v != false){ 
                        $db->condition = "WHERE pro_name LIKE '%{$v}%'";
                    }
                }
                $query = $db->select();

                $db_1->field = "count(pro_id) AS pro_id";
                $db_1->table = "product";
                $q = $db_1->select();
                $r = mysqli_fetch_assoc($q);
                $total = $r['pro_id'];
                $page = ceil($total / $limit);

                while($i=mysqli_fetch_assoc($query)){ 
            ?>
            <div class="card" style="width: 200px;height: 250px">
                <img src="<?php echo $i['pro_img']; ?>" class="card-img-top" width="80px" height="80px" style="object-fit: contain;">
                <div class="card-body">
                <h5 class="card-text"><?php echo $i['New_name']; ?></h5>
                <p><?php echo "ราคา " . $i['pro_price']; ?></p>
                <a href="#" class="btn btn-primary">ซื้อสินค้า</a>
                </div>
            </div>
            <?php } ?>
        </div>
        <nav aria-label="Page navigation" style="margin-top: 2rem">
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
    <hr class="mt-5">
    <div class="container">
        <div>
            <p><?php echo date('Y'); ?> ©Copyright by Silly web</p>
            <p>Tell me, are you gonna bark or bite?</p>
        </div>
    </div>
</body>