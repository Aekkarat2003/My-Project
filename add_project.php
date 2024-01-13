<?php
session_start();
require_once 'config/db.php';

if (!isset($_SESSION['admin_login'])) {
    $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ!';
    header('location: login.php');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $projectName = $_POST['project_name'];
    $projectAuthor = $_POST['project_author'];
    $projectAdvisor = $_POST['project_advisor'];
    $projectBranch = $_POST['project_branch'];
    $projectYear = $_POST['project_year'];

    if (empty($projectName) || empty($projectAuthor) || empty($projectAdvisor) || empty($projectBranch) || empty($projectYear)) {
        echo json_encode(array("status" => "error", "msg" => "กรุณากรอกข้อมูลทุกช่อง!"));
    } else {
        $stmt = $conn->prepare("INSERT INTO projects (project_name, project_author, project_advisor, project_branch, project_year) VALUES (:name, :author, :advisor, :branch, :year)");
        $stmt->bindParam(':name', $projectName);
        $stmt->bindParam(':author', $projectAuthor);
        $stmt->bindParam(':advisor', $projectAdvisor);
        $stmt->bindParam(':branch', $projectBranch);
        $stmt->bindParam(':year', $projectYear);

        if ($stmt->execute()) {
            echo json_encode(array("status" => "success", "msg" => "เพิ่มโครงงานเรียบร้อยแล้ว!"));
        } else {
            echo json_encode(array("status" => "error", "msg" => "มีบางอย่างผิดพลาด!"));
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Project</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/admin.css">
</head>
<body class="body">
    <?php include('navbarl.php'); ?>

    <div class="container ms-auto content-container">
        <div class="orange-bar mb-3">
            <h2 class="am">เพิ่มโครงงาน</h2>
        </div>

        

        <form method="POST" action="add_project.php" id="addProjectForm">
            <div class="mb-3">
                <label for="project_name" class="form-label">ชื่อโครงงาน</label>
                <input type="text" class="form-control" id="project_name" name="project_name" required>
            </div>
            <div class="mb-3">
                <label for="project_author" class="form-label">ชื่อผู้จัดทำ</label>
                <input type="text" class="form-control" id="project_author" name="project_author" required>
            </div>
            <div class="mb-3">
                <label for="project_advisor" class="form-label">ครูที่ปรึกษา</label>
                <input type="text" class="form-control" id="project_advisor" name="project_advisor" required>
            </div>
            <div class="mb-3">
                <label for="project_branch" class="form-label">สาขา</label>
                <input type="text" class="form-control" id="project_branch" name="project_branch" required>
            </div>
            <div class="mb-3">
                <label for="project_year" class="form-label">ปีพ.ศ.</label>
                <input type="text" class="form-control" id="project_year" name="project_year" required>
            </div>
            <button type="submit" class="btn btn-success">เพิ่มโครงงาน</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        $(document).ready(function () {
    $("#addProjectForm").submit(function (e) {
        e.preventDefault(); // ป้องกันฟอร์มจากการส่งในวิธีปกติ

        let formUrl = $(this).attr("action");
        let formData = $(this).serialize();

        $.ajax({
            type: "POST",
            url: formUrl, // ที่อยู่ของไฟล์ PHP ที่เพิ่มโครงงาน
            data: formData,
            success: function (response) {
                if (response.status == "success") {
                    console.log("Success", response);
                    Swal.fire("Success!", response.msg, response.status).then(function reload() {
                        window.location.href = "add_project.php";
                    });
                } else {
                    console.log("Eerror", response);
                    Swal.fire("Error!", response.msg, response.status);
                }
            },
        });
    });
});

    </script>
</body>

</html>
