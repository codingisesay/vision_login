<?php
error_reporting(0);
ini_set('session.cookie_lifetime', 2592000);
ini_set('session.gc_maxlifetime', 2592000);
//ini_set('session.save_path', '/var/lib/php/sessions');
session_start();
include 'database_connection.php';
include 'functions.php';
$cookie_name = "PHPSESSID";
$device_cookie = $_COOKIE['PHPSESSID'];
$user_id = $_SESSION['id'];
$row_of_specific_device = specific_device_from_login_log($device_cookie, $user_id);
mysqli_num_rows($row_of_specific_device);
$data = mysqli_fetch_assoc($row_of_specific_device);

if (isset($_SESSION['id']) && isset($_COOKIE['PHPSESSID']) && $data['session_status'] == "active") {
    setcookie($cookie_name, $device_cookie, time() + 2592000);
    $q = "SELECT user.user_id, user.user_name,user.user_mobile,user.user_mail_id,user.user_password,user.number_of_device_access,department.department_name
         FROM user
         INNER JOIN department
         ON user.department_id = department.department_id
         WHERE user.user_id = '$user_id'";
    $result = mysqli_query($connect, $q);
    $row = mysqli_num_rows($result);
    $data = mysqli_fetch_assoc($result);
    $department_name = $data['department_name'];
    mysqli_close($connect);
    department_redirect($department_name);

}
mysqli_close($connect);

?>
<html>

<head>
    <title>login page</title>

    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="css/index.css">

    <!--<link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@500&family=Pushster&family=Raleway:ital,wght@1,700&display=swap" rel="stylesheet">-->
</head>

<body>
    <div class="container-fluid h-custom">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-md-9 col-lg-6 col-xl-5 d-none d-lg-block">
            <img src="image/login_page_image.webp" id="" style="width:100%">
            </div>
            <div class="centerdiv col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                <img src="image/vision_logo-removebg-preview.png" id="profilepic">
                <h2 class="login-h2" style="font-family: Arial, Helvetica, sans-serif;">user login</h2>
                <form method="POST" action="validate_login.php" class="form-group">
                    <div class="form-group text-align-last-center">
                        <input type="text" class="form-control" name="filed_username" class="inputbox"
                            placeholder="Username" require>
                    </div>
                    <div class="form-group text-align-last-center">
                        <input type="password" class="form-control" name="filed_password" class="inputbox"
                            placeholder="Password" require>
                    </div>
                    <a class="forget-password">Forgot Password</a>
                    <br>
                    <br>
                    <div class="form-group text-center">
                        <button type="submit" class="btn-primary button-color btn" name="submit">LogIn</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>