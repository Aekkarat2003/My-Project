<?php 

    session_start();
    require_once 'config/db.php';
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/admin.css">
    <title>Document</title>
</head>
<body class="body">
    <?php include('navbarl.php') ?>
    <div class="container ms-auto content-container">
                <div class="orange-bar">
                    <h2 class="am">จัดการข้อมูลนักเรียน</h2>
                </div>
</div>
    
</body>
</html>