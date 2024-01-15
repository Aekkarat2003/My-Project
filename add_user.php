<?php
session_start();
require_once 'config/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $status = $_POST['status'];

    // ตรวจสอบว่ามีชื่อผู้ใช้นี้อยู่แล้วหรือไม่
    $stmtCheckUser = $conn->prepare("SELECT COUNT(*) FROM users WHERE username = :username");
    $stmtCheckUser->bindParam(':username', $username);
    $stmtCheckUser->execute();
    $userCount = $stmtCheckUser->fetchColumn();

    if ($userCount > 0) {
        // ถ้ามีชื่อผู้ใช้นี้อยู่แล้ว
        header('Content-Type: application/json');
        echo json_encode(array("status" => "error", "msg" => "ชื่อผู้ใช้นี้มีอยู่แล้ว"));
    } else {
        // ถ้าไม่มีชื่อผู้ใช้นี้อยู่
        $stmt = $conn->prepare("INSERT INTO users (firstname, lastname, username, password, Status) VALUES (:firstname, :lastname, :username, :password, :status)");
        $stmt->bindParam(':firstname', $firstname);
        $stmt->bindParam(':lastname', $lastname);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':status', $status);

        if ($stmt->execute()) {
            // เพิ่มผู้ใช้เรียบร้อย
            header('Content-Type: application/json');
            echo json_encode(array("status" => "success", "msg" => "เพิ่มผู้ใช้เรียบร้อยแล้ว!"));
        } else {
            // ให้ข้อมูลผิดพลาด
            $errorInfo = $stmt->errorInfo();
            header('Content-Type: application/json');
            echo json_encode(array("status" => "error", "msg" => "มีบางอย่างผิดพลาด: " . $errorInfo[2]));
        }
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/admin.css">
    <title>เพิ่มผู้ใช้</title>
</head>
<body class="body">
    <?php include('navbarl.php') ?>
    <div class="container ms-auto content-container">
        <div class="orange-bar mb-3">
            <h2 class="am">เพิ่มผู้ใช้</h2>
        </div>
        <!-- แบบฟอร์มเพิ่มผู้ใช้ -->
        <form action="add_user.php" method="post" onsubmit="submitForm(); return false;">
            <div class="mb-3">
                <label for="firstname" class="form-label">ชื่อ</label>
                <input type="text" class="form-control" id="firstname" name="firstname" required>
            </div>
            <div class="mb-3">
                <label for="lastname" class="form-label">นามสกุล</label>
                <input type="text" class="form-control" id="lastname" name="lastname" required>
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">ชื่อผู้ใช้</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">รหัสผ่าน</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">สถานะ</label>
                <input type="text" class="form-control" id="status" name="status" required>
            </div>
            <button type="submit" class="btn btn-primary">บันทึก</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Function สำหรับเรียกใช้ SweetAlert2
    function showAlert(status, message) {
        Swal.fire({
            icon: status,
            title: message,
        });
    }

    // Function สำหรับ submit form และแสดง SweetAlert2
    function submitForm() {
        // ส่วนที่เหลือของโค้ด AJAX
        // ...

        // เรียกใช้ showAlert ในส่วนที่ต้องการแสดง SweetAlert2
        showAlert("success", "เพิ่มผู้ใช้เรียบร้อยแล้ว!");
        // หรือ showAlert("error", "ข้อความผิดพลาดที่ต้องการแสดง");
        document.forms[0].submit();
    }
</script>
</body>


</html>
