<?php 

    session_start();
    require_once 'config/db.php';

    $stmt = $conn->query("SELECT * FROM users");
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/admin.css">
    <title>จัดการข้อมูลผู้ใช้</title>
</head>
<body class="body">
    <?php include('navbarl.php') ?>
    <div class="container ms-auto content-container">
                <div class="orange-bar">
                    <h2 class="am">จัดการข้อมูลผู้ใช้</h2>
                </div>
                 <!-- แสดงข้อมูลผู้ใช้ในรูปแบบตาราง -->
        <table class="table mt-4">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">ชื่อ</th>
                    <th scope="col">นามสกุล</th>
                    <th scope="col">ชื่อผู้ใช้</th>
                    <th scope="col">สถานะ</th>
                    <th scope="col">จัดการ</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user) : ?>
                    <tr>
                        <th scope="row"><?php echo $user['id']; ?></th>
                        <td><?php echo $user['firstname']; ?></td>
                        <td><?php echo $user['lastname']; ?></td>
                        <td><?php echo $user['username']; ?></td>
                        <td><?php echo $user['Status']; ?></td>
                        <td>
                        <a href="update_user.php?id=<?php echo $user['id']; ?>" class="">
                            <i class="fa-solid fa-pen-to-square me-3"></i>
                        </a>
                            <i class="fa-solid fa-trash" onclick="deleteUser(<?php echo $user['id']; ?>, this.parentNode.parentNode)"></i>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="mt-3">
    <a href="add_user.php" class="btn btn-primary">เพิ่มผู้ใช้</a>
</div>

</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
        // Function สำหรับลบผู้ใช้และแสดง SweetAlert2
        function deleteUser(userId, row) {
        // ตรวจสอบว่าต้องการลบหรือไม่
        Swal.fire({
            title: 'คุณแน่ใจหรือไม่?',
            text: "คุณจะไม่สามารถกู้คืนข้อมูลนี้ได้!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'ใช่, ลบ!'
        }).then((result) => {
            if (result.isConfirmed) {
                // ทำการลบผู้ใช้
                const deleteUrl = `dl_user.php?id=${userId}`;

                fetch(deleteUrl, { method: 'GET' })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire(
                                'Deleted!',
                                'ลบผู้ใช้สำเร็จแล้ว.',
                                'success'
                            ).then(() => {
                                // ลบแถวที่มีข้อมูลผู้ใช้ออกจากตาราง
                                row.remove();
                            });
                        } else {
                            Swal.fire(
                                'เกิดข้อผิดพลาด!',
                                'มีบางอย่างผิดพลาดในขณะลบผู้ใช้.',
                                'error'
                            );
                        }
                    })
                    .catch(error => {
                        console.error('Error deleting user:', error);
                    });
                }
            });
        }
    </script>
    
</body>
</html>