<?php 
session_start();
include('connect.php');

$username		= $_POST['username'];
$password		= $_POST['password'];

$proses 	= "SELECT * FROM login WHERE username ='$username' AND password ='$password'";
$login		= mysqli_query($conn, $proses);

$cek		= mysqli_num_rows($login);

if ($cek > 0) {
	
	$data 			= mysqli_fetch_assoc($login);
	$db_id			= $data['id'];
	$db_user		= $data['username'];
	$db_pass		= $data['password'];
	$_SESSION['id']	= $db_id;
		header("location:admin/halaman.php");	
}else{
	echo "<script>alert('LOGIN GAGAL');document.location.href='index.php'</script>";
}

?>