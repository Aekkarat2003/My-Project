<?php 

session_start();
require_once 'config/db.php';
$minLength = 8;

// if (isset($_POST['signup'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $r_password = $_POST['r_password'];
    $c_password = $_POST['c_password'];
    $Status = 'user';

    if (!$firstname) {
        echo json_encode(array("status" => "error", "msg" => "กรุณากรอกชื่อ"));
        // $_SESSION['error'] = 'กรุณากรอกชื่อ';
        // header("location: register.php");
    } else if (!$lastname) {
        echo json_encode(array("status" => "error", "msg" => "กรุณากรอกนามสกุล"));
        // $_SESSION['error'] = 'กรุณากรอกนามสกุล';
        // header("location: register.php");
    } else if (!$username) {
        echo json_encode(array("status" => "error", "msg" => "กรุณากรอกชื่อผู้ใช้"));

    } else if (!$email) {
        echo json_encode(array("status" => "error", "msg" => "กรุณากรอกอีเมล"));
        // $_SESSION['error'] = 'กรุณากรอกอีเมล';
        // header("location: register.php");
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(array("status" => "error", "msg" => "รูปแบบอีเมลไม่ถูกต้อง"));
        // $_SESSION['error'] = 'รูปแบบอีเมลไม่ถูกต้อง';
        // header("location: register.php");
    } else if (!$r_password) {
        echo json_encode(array("status" => "error", "msg" => "กรุณากรอกรหัสผ่าน"));
        // $_SESSION['error'] = 'กรุณากรอกรหัสผ่าน';
        // header("location: register.php");
    } else if (strlen($_POST['r_password']) > 20 || strlen($_POST['r_password']) < 5) {
        echo json_encode(array("status" => "error", "msg" => "รหัสผ่านต้องมีความยาวระหว่าง 5 ถึง 20 ตัวอักษร"));
        // $_SESSION['error'] = 'รหัสผ่านต้องมีความยาวระหว่าง 5 ถึง 20 ตัวอักษร';
        // header("location: register.php");
    } else if (!$c_password) {
        echo json_encode(array("status" => "error", "msg" => "กรุณายืนยันรหัสผ่าน"));
        // $_SESSION['error'] = 'กรุณายืนยันรหัสผ่าน';
        // header("location: register.php");
    } else if ($r_password != $c_password) {
        echo json_encode(array("status" => "error", "msg" => "รหัสผ่านไม่ตรงกัน"));
        // $_SESSION['error'] = 'รหัสผ่านไม่ตรงกัน';
        // header("location: register.php");
    } else {

        $stmt = $conn->prepare('SELECT COUNT(*) FROM users WHERE email = ?');
        $stmt->execute([$email]);
        $userExists = $stmt->fetchColumn();
    
        if ($userExists) {
            echo json_encode(array("status" => "error", "msg" => "มีอีเมลอยู่แล้ว"));
            // $_SESSION['error'] = 'Email already exists.';
            // Redirect the email to the registration page or display an error message
            // header('Location: register.php');
            // exit;
    } else {

        $hashedPassword = password_hash($r_password, PASSWORD_DEFAULT);

        try {
            $stmt = $conn->prepare("INSERT INTO users (firstname, lastname, username, email, password, Status) VALUES (?, ?, ?, ?, ?, ?)");
            $result = $stmt->execute([$firstname, $lastname, $username, $email, $hashedPassword, $Status]);
            if ($result){
            echo json_encode(array("status" => "success", "msg" => "Registration successfully!"));
            }else{
                echo json_encode(array("status" => "error", "msg" => "error"));
            }
            // $_SESSION['success'] = "Registration successfully!";
            // header('location: register.php');
        } catch (PDOException $e) {
            echo json_encode(array("status" => "error", "msg" => "Something went wrong, please try again!"));
        
            // $_SESSION['error'] = "Something went wrong, please try again!";
            // echo "Registration failed: " . $e->getMessage();
            // header('location: register.php');
        }
    }
// }
    }


?>