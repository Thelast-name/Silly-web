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

    $db->table = "users";
    $db->field = "user_name";
    if(isset($_POST['search'])){
        $search = $_POST['search'];
        $db->condition = "WHERE user_name LIKE '%{$search}%'";
    }
    $query = $db->select();

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
    </div>
</body>