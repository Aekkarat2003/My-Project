<?php

    session_start();
    require_once 'config/db.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/forms.css">
</head>
<body>

        <?php include('nav.php'); ?>
        
    <div class="container">
        <h3 class="mt-4">สมัครสมาชิก</h3>
        <hr>
        <form action="register_db.php" id="registerform" method="post">
            <?php if(isset($_SESSION['error'])) { ?>
                <div class="alert alert-danger" role="alert">
                    <?php 
                        echo $_SESSION['error'];
                        unset($_SESSION['error']);
                    ?>
                </div>
            <?php } ?>
            <?php if(isset($_SESSION['success'])) { ?>
                <div class="alert alert-success" role="alert">
                    <?php 
                        echo $_SESSION['success'];
                        unset($_SESSION['success']);
                    ?>
                </div>
            <?php } ?>
            <?php if(isset($_SESSION['warning'])) { ?>
                <div class="alert alert-warning" role="alert">
                    <?php 
                        echo $_SESSION['warning'];
                        unset($_SESSION['warning']);
                    ?>
                </div>
            <?php } ?>

            <div class="mb-3">
                <label for="firstname" class="form-label">First name</label>
                <input type="text" class="form-control" name="firstname" aria-describedby="firstname">
            </div>
            <div class="mb-3">
                <label for="lastname" class="form-label">Last name</label>
                <input type="text" class="form-control" name="lastname" aria-describedby="lastname">
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" name="username" aria-describedby="username">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" aria-describedby="email">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" id="r_password" class="form-control" name="r_password">
            </div>
            <div class="mb-3">
                <label for="confirm password" class="form-label">Confirm Password</label>
                <input type="password" id="c_password" class="form-control" name="c_password">
            </div>
            <div class="checkbox mb-3">
                <label>
                    <input type="checkbox"  onclick="showPass()"> Show password
                </label>
            </div>
            <button type="submit" name="signup" class="btn btn-primary">Sign Up</button>
        </form>
        <hr>
        <p>เป็นสมาชิกแล้วใช่ไหม คลิ๊กที่นี่เพื่อ <a href="login.php">เข้าสู่ระบบ</a></p>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        function showPass() {
            let rPassword = document.getElementById('r_password');
            let cPassword = document.getElementById('c_password');

            if (rPassword.type === "password") {
                rPassword.type = "text";
                cPassword.type = "text";
            } else {
                rPassword.type = "password";
                cPassword.type = "password";
            }
        }

        $(document).ready(function () {
            $("#registerform").submit(function (e) {
                e.preventDefault();

                let formUrl = $(this).attr("action");
                let reqMethod = $(this).attr("method");
                let formData = $(this).serialize();

                $.ajax({
                    url: formUrl,
                    type: reqMethod,
                    data: formData, 
                    success: function(data) {

                        let result = JSON.parse(data);
                        
                        if (result.status == "success") {
                            
                            console.log("Success", result)
                            Swal.fire("Success!", result.msg, result.status).then(function reload() {
                            window.location.href = "register.php"
                        });
                        }else{
                            console.log("Error", result)
                            Swal.fire("Error!", result.msg, result.status);
                        }
                    }

                })
            })
        })
    </script>
</body>
</html>