<?php
    session_start();
    if(isset($_SESSION['username'])){
        header("Location: login.php ");
    }
    if($_SESSION['is_admin'] != 1) {
        header("Location: login.php ");
    }
    include "layout/header.php";
    include "layout/navbar.php";
?>
<body>
    <div class="container">
        <h3>Welcome to Silly web</h3>
    </div>
</body>