<?php
session_start();
require_once 'config/db.php';

// ตรวจสอบว่ามีการรับค่า ID ผู้ใช้หรือไม่
if (isset($_GET['id'])) {
    $userId = $_GET['id'];
    

    // ดึงข้อมูลผู้ใช้จากฐานข้อมูล
    $stmt = $conn->prepare("SELECT * FROM users WHERE id = :id");
    $stmt->bindParam(':id', $userId);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        // ถ้าไม่พบข้อมูลผู้ใช้ในฐานข้อมูล
        echo 'User not found.';
        exit;
    }
} else {
    // ถ้าไม่ได้รับค่า ID ผู้ใช้
    echo 'Invalid user ID.';
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/admin.css">
    <title>แก้ไขข้อมูลผู้ใช้</title>
</head>
<body class="body">
    <?php include('navbarl.php') ?>
    
    <div class="container ms-auto content-container">
        <div class="orange-bar">
            <h2 class="am">แก้ไขข้อมูลผู้ใช้</h2>
        </div>
        <!-- แสดงแบบฟอร์มแก้ไขข้อมูลผู้ใช้ -->
        <form action="update_user.php" method="post">
            <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
            <div class="mb-3">
                <label for="firstname" class="form-label">ชื่อ</label>
                <input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo $user['firstname']; ?>">
            </div>
            <div class="mb-3">
                <label for="lastname" class="form-label">นามสกุล</label>
                <input type="text" class="form-control" id="lastname" name="lastname" value="<?php echo $user['lastname']; ?>">
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">ชื่อผู้ใช้</label>
                <input type="text" class="form-control" id="username" name="username" value="<?php echo $user['username']; ?>">
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">สถานะ</label>
                <input type="text" class="form-control" id="status" name="status" value="<?php echo $user['Status']; ?>">
            </div>
            <button type="submit" class="btn btn-primary">บันทึก</button>
        </form>
    </div>
</body>
</html>
