<?php include("inc_header.php") ?>
<?php
$id = "";
$name = "";
$email = "";
$phone = "";
$address = "";
$materi = "";

$errorMessage = "";
$successMessage = "";



if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    //GET METHOD = buat nunjukin data ke pengguna

    if (!isset($_GET["id"])){
        header("location: /pengajars/admin/halaman.php");
        exit;
    }
    
    $id = $_GET['id']; 

    $sql = "SELECT * FROM pengajars WHERE id='$id'";
    $q1  = mysqli_query($koneksi,$sql);
    $row  = mysqli_fetch_array($q1);

    if (!$row) {
        header("location: /pengajars/admin/halaman.php");
        exit;
    }
    "VALUES ('$name', '$email', '$phone', '$address', '$materi')";
    
    $name = $row["name"];
    $email = $row["email"];
    $phone = $row["phone"];
    $address = $row["address"];
    $materi = $row["materi"];
}
else {
    //POST METHOD = buat update data client

    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];
    $materi = $_POST["materi"];
    $id = $_POST["id"]; // Assuming you have an "id" field in your form

    do {
        if (empty($name) || empty($email) || empty($phone) || empty($address) || empty($materi)) {
            $errorMessage = "All the fields are required";
            break;
        }

        $sql = "UPDATE pengajars SET name = '$name', email = '$email', phone = '$phone', address = '$address', materi = '$materi' WHERE id=$id";

        $result = $koneksi->query($sql);

        if (!$result) {
            $errorMessage = "Invalid query: " . $koneksi->error;
            break;
        }

        $successMessage = "Berhasil Terupdate";

        header("location: /pengajars/admin/halaman.php");
        exit;

    } while (false);

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data pengajar</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container my-5">
        <h2>Update Data</h2>

        <?php
        if (!empty($errorMessage)) {
            echo "
            <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                <strong>$errorMessage</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            ";
        } 
        ?>
        <form method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Nama</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="name" value="<?php echo $name; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="email" value="<?php echo $email; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">No. HP</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="phone" value="<?php echo $phone; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Alamat</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="address" value="<?php echo $address; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Materi</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="materi" value="<?php echo $materi; ?>">
                </div>
            </div>

            <?php
            if (!empty($successMessage)) {
                echo"
                <div class='row mb-3'>
                    <div class='offset-sm-3 col-sm-6'>
                        <div class='alert alert-success alert-dismissible fade show' role='alert'>
                            <strong>$successMessage</strong>
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>
                    </div>
                </div>
                ";
            }
            ?>
            
            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="/pengajars/admin/halaman.php" role="button">Batal</a>
                </div>
            </div>
        </form>

    </div>
</body>
</html>
<?php include("inc_footer.php") ?>