<?php 

session_start();
require_once 'config/db.php';
$minLength = 8;


// if (isset($_POST['signin'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (!$username) {
        echo json_encode(array("status" => "error", "msg" => "กรุณากรอกชื่อผู้ใช้"));
    } else if (!$password) {
        echo json_encode(array("status" => "error", "msg" => "กรุณากรอกรหัสผ่าน"));
    } else if (strlen($password) > 20 || strlen($password) < 5) {
        echo json_encode(array("status" => "error", "msg" => "รหัสผ่านต้องมีความยาวระหว่าง 5 ถึง 20 ตัวอักษร"));
    } else {
        try {
            $check_data = $conn->prepare("SELECT * FROM users WHERE username = :username");
            $check_data->bindParam(":username", $username);
            $check_data->execute();
            $row = $check_data->fetch(PDO::FETCH_ASSOC);
    
            if ($check_data->rowCount() > 0) {
                if ($username == $row['username']) {
                    if (password_verify($password, $row['password'])) {
                        if ($row['Status'] == 'admin') {
                            $_SESSION['admin_login'] = $row['id'];
                            echo json_encode(array("status" => "success", "Status" => "admin", "msg" => "Admin เข้าสู่ระบบสำเร็จ!"));
                        } else {
                            $_SESSION['user_login'] = $row['id'];
                            echo json_encode(array("status" => "success", "Status" => "user", "msg" => "User เข้าสู่ระบบสำเร็จ!"));
                        }
                    } else {
                        echo json_encode(array("status" => "error", "msg" => "รหัสผ่านไม่ถูกต้อง"));
                    }
                } else {
                    echo json_encode(array("status" => "error", "msg" => "อีเมลผิด"));
                }
            } else {
                echo json_encode(array("status" => "error", "msg" => "ไม่มีข้อมูลในระบบ"));
            }
        } catch(PDOException $e) {
            echo json_encode(array("status" => "error", "msg" => "Something went wrong, please try again!"));
        }
    }


?>
