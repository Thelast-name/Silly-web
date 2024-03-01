<?php
    session_start();
    if(isset($_SESSION['username'])){
        header("Location: login.php ");
    }
    if(isset($_SESSION['is_admin']) != 1) {
        header("Location: login.php ");
    }
    include "data.php";
    include "validate.php";
    include "layout/header.php";
    include "layout/navbar.php";
    $db = new Database();
    $db_1 = new Database();
    $vali = new Validate();

    $limit = 10;
    $cur_page = isset($_GET['page']) ? $_GET['page'] : 1;
    $start = ($cur_page - 1) * $limit;

    $db->table = "users";
    $db->field = "user_name";
    $db->condition = " LIMIT {$start}, {$limit}";
    if(isset($_POST['search'])){
        $search = $_POST['search'];
        $v = $vali->validate_string($search);
        if($v != false){
            $db->condition = "WHERE user_name LIKE '%{$search}%'";
        }
    }
    $query = $db->select();
    $db_1->field = "count(user_id) AS user_id";
    $db_1->table = "users";
    $q = $db_1->select();
    $r = mysqli_fetch_assoc($q);
    $total = $r['user_id'];
    $page = ceil($total / $limit);

?>
<body>
    <div class="container">
        <div class="text-end">
            <form action="?" method="post">
                <label for="">ค้นหาสินค้า</label>
                <input type="text" name="search" id="" class="mx-2 px-1">
                <button type="submit" name="ss" class="btn btn-success">ค้นหา</button>
            </form>
        </div>
        <table class="table">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">user name</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $n = 0;
                    while($i=mysqli_fetch_assoc($query)){ 
                    $n += 1;
                ?>
                <tr>
                <th scope="row"><?php echo $n; ?></th>
                <td><?php echo $i['user_name'];?></td>
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