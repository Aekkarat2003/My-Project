<?php 

    session_start();
    require_once 'config/db.php';
    if (!isset($_SESSION['admin_login'])) {
        $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ!';
        header('location: login.php');
    }
    $stmt = $conn->query("SELECT * FROM projects");
    $projects = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/admin.css">
</head>
<body class="body">
    <?php include('navbarl.php'); ?>
        
            <div class="container ms-auto content-container">
                <div class="orange-bar">
                    <h2 class="am">โครงงาน</h2>
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
                    <th scope="col">ดาวน์โหลด</th>
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
                        <td><a href="download_project.php?project_id=<?php echo $project['project_id']; ?>" target="_blank">ดาวน์โหลด</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>