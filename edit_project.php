<?php 

    session_start();
    require_once 'config/db.php';
    $stmt = $conn->query("SELECT * FROM projects");
    $projects = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
                    <h2 class="am">จัดการข้อมูลโครงงาน</h2>
                </div>
        <!-- Display Projects in a Table -->
        <table class="table mt-4">
            <thead>
                <tr>
                    <th scope="col">จำนวนโครงงาน</th>
                    <th scope="col">ชื่อโครงงาน</th>
                    <th scope="col">ชื่อผู้จัดทำ</th>
                    <th scope="col">ครูที่ปรึกษา</th>
                    <th scope="col">สาขา</th>
                    <th scope="col">ปีพ.ศ.</th>
                    <th scope="col">แก้ไข</th>
                    <th scope="col">ลบ</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($projects as $project) : ?>
                    <tr>
                        <th scope="row"><?php echo $project['project_id']; ?></th>
                        <td><?php echo $project['project_name']; ?></td>
                        <td><?php echo $project['project_author']; ?></td>
                        <td><?php echo $project['project_advisor']; ?></td>
                        <td><?php echo $project['project_branch']; ?></td>
                        <td><?php echo $project['project_year']; ?></td>
                        <td><a href="edit_project.php?id=<?php echo $project['project_id']; ?>" class="btn btn-primary">แก้ไข</a></td>
                        <td><a href="delete_project.php?id=<?php echo $project['project_id']; ?>" class="btn btn-danger">ลบ</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="mt-3">
    <a href="add_project.php" class="btn btn-success">เพิ่มโครงงาน</a>
</div>
    </div>
</div>
    
</body>
</html>