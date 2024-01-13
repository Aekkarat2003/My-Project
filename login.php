<?php

session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration System PDO</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/forms.css">
</head>
<body>

        <?php include('nav.php'); ?>

    <div class="container">
        <h3 class="mt-4">เข้าสู่ระบบ</h3>
        <hr>
        <form action="login_db.php" id="loginform" method="post">
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
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" name="username" aria-describedby="username">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" id="password" class="form-control" name="password">
            </div>
            <div class="checkbox mb-3">
                <label>
                    <input type="checkbox"  onclick="showPass()"> Show password
                </label>
            </div>
            <button type="submit" name="signin" class="btn btn-primary">Sign In</button>
        </form>
        <hr>
        <p>ยังไม่เป็นสมาชิกใช่ไหม คลิ๊กที่นี่เพื่อ <a href="register.php">สมัครสมาชิก</a></p>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        function showPass() {
            let Password = document.getElementById('password');

            if (Password.type === "password") {
                Password.type = "text";
            } else {
                Password.type = "password";
            }
        }

            $(document).ready(function() {
                $("#loginform").submit(function(e) {
                    e.preventDefault();

                    let formUrl = $(this).attr("action");
                    let reqMethod = $(this).attr("method");
                    let formData = $(this).serialize();

                    $.ajax({
                        url: formUrl,
                        type: reqMethod,
                        data: formData,
                        dataType: 'json',
                        success: function(result) {
                            if (result.status == "success") {
                                console.log("Success", result);
                                showAlert("success", result.msg);
                                setTimeout(function() {
                                    if (result.Status === "admin") {
                                        window.location.href = "admin.php";
                                    } else {
                                        window.location.href = "user.php";
                                    }
                                }, 2000);
                            } else {
                                console.log("Error", result);
                                showAlert("error", result.msg);
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error!',
                                    text: result.msg,
                                });
                            }
                        }
                    });

                    function showAlert(type, message) {
                        let alertContainer = $("#alert-container");
                        alertContainer.empty();
                        
                        if (type === "success") {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: message,
                            });
                        } else {
                            alertContainer.append(`<div class="alert alert-${type}" role="alert">${message}</div>`);
                        }
                    }
                })
            });

        </script>
    
</body>
</html>
