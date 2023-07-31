<?php
session_start();
if(isset($_SESSION['admin_username'])!=''){
    header("location:halaman.php");
    exit();
}
include("../incl/inc_koneksi.php");

$username   ="";
$password   ="";
$err      ="";


if(isset($_POST['Login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    if($username == '' && $password == ''){
        $err .= "<li>Silakan masukkan username dan juga password.</li>";
    }elseif($username == ''){
        $err .= "<li>Silakan masukkan username.</li>";
    }elseif($password == ''){
        $err .= "<li>Silakan masukkan password.</li>";
    }else{
        $sql1 = "select * from login where username = '$username'";
        $q1 = mysqli_query($koneksi,$sql1);
        $r1 = mysqli_fetch_array($q1);
        $n1 = mysqli_num_rows($q1);

        if($n1 < 1){
            $err = "Username tidak ditemukan";
        }elseif($r1['password'] != md5($password)){
            $err = "Password yang kamu masukkan tidak sesuai";
        }else{
            $_SESSION['admin_username'] = $username;
            header("location:halaman.php");
            exit();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-COmpatible"content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>Login Admin</title>
</head>
<body style="width:100%; max-width:330px; margin:auto; padding:15px">
    <form action="" method="POST">
        <h1>Login Admin</h1>
        <?php
        if($err){
        ?>
        <div class = "alert alert-danger">
            <?php echo $err ?>
        </div>
        <?php
        }
        ?>
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" name="username" placeholder="Masukan Username Anda" value="<?php echo $username ?>"/>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password"/>
        </div>
        <button type="submit" class="btn btn-primary" name="Login">LOGIN</button>
    </form>
</body>
</html>