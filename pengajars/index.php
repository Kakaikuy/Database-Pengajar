<?php
include("connect.php");?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    
    <link rel="connection" href="connect.php">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="style/style.css">
</head>
    

<body>
    <br>
    <div class="wrapper">
        <form action="testlogin.php" method="post">
            <h1>Login</h1>
            <img src="/pengajars/images/logo3.png" style="position:center"/>
            <div class="input-box">
                <input type="text" placeholder="Username"
                required name="username">
                <i class='bx bxs-user'></i>
            </div>
            <div class="input-box">
                <input type="password"
                placeholder="Password" required name="password">
                <i class='bx bxs-lock'></i>
            </div>

            <button type="submit" class="btn" href="admin/halaman.php">Login</button>
        </form>
    </div>
</body>
</html>