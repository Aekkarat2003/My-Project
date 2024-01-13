<?php
session_start();
require_once 'config/db.php';

// ตรวจสอบว่ามีการรับค่า ID ผู้ใช้หรือไม่
if (isset($_GET['id'])) {
    $userId = $_GET['id'];

    // ทำการลบข้อมูลผู้ใช้จากฐานข้อมูล
    $stmt = $conn->prepare("DELETE FROM users WHERE id = :id");
    $stmt->bindParam(':id', $userId);

    try {
        $stmt->execute();
        $response = ['success' => true];
    } catch (PDOException $e) {
        $response = ['success' => false, 'error' => $e->getMessage()];
    }
} else {
    $response = ['success' => false, 'error' => 'Invalid user ID'];
}

// ส่ง JSON response กลับไปยัง JavaScript
header('Content-Type: application/json');
echo json_encode($response);
?>
