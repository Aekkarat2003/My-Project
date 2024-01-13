<?php
session_start();
require_once 'config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // รับข้อมูลจากฟอร์ม
    $userId = $_POST['id'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $username = $_POST['username'];
    $status = $_POST['status'];

    // อัปเดตข้อมูลผู้ใช้ในฐานข้อมูล
    $stmt = $conn->prepare("UPDATE users SET firstname = :firstname, lastname = :lastname, username = :username, Status = :status WHERE id = :id");
    $stmt->bindParam(':id', $userId);
    $stmt->bindParam(':firstname', $firstname);
    $stmt->bindParam(':lastname', $lastname);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':status', $status);

    if ($stmt->execute()) {
        // หากอัปเดตสำเร็จ ให้ redirect กลับไปที่หน้าที่มา
        header("Location: edit_user.php?id=$userId"); // เปลี่ยน "edit_user.php" เป็นชื่อไฟล์ที่มา
        exit;
        
    } else {
        // กรณีที่อัปเดตไม่สำเร็จ
        echo 'การอัปเดตข้อมูลล้มเหลว.';
        exit;
        
    }
    
} else {
    // กรณีที่ไม่ได้ submit ข้อมูลผ่านวิธี POST
    header("Location: home.php"); // เปลี่ยน "home.php" เป็นหน้าหลักที่ต้องการ
    exit;
    
}


?>
