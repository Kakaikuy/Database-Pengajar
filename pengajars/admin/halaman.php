<?php include("inc_header.php") ?>
<?php
$katakunci = (isset($_GET['katakunci'])) ? $_GET['katakunci'] : "";
if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}
if ($op == 'delete') {
    $id = $_GET['id'];
    $sql1 = "delete from pengajars where id = '$id'";
    $q1 = mysqli_query($koneksi, $sql1);
    if ($q1) {
        $sukses = "Berhasil hapus data";
    }
}

?>
<h1>Halaman Admin</h1>
<p>
    <a href="halaman_input.php">
        <input type="button" class="btn btn-primary" value="Buat Pengguna Baru">
    </a>
</p>
<?php
$sukses     ="";
if($sukses) {
    ?>
    <div class="alert alert-primary" role="alert">
        <?php echo $sukses ?>
    </div>
    <?php
}
?>
<form class="row g-3" method="get">
    <div class="col-auto">
        <input type="text" class="form-control" placeholder="Masukan Kata Kunci" name="katakunci"
            value="<?php echo $katakunci ?>" />
    </div>
    <div class="col-auto">
        <input type="submit" name="cari" value="Cari Pengguna" class="btn btn-secondary" />
    </div>
</form>

<table class="table table-striped">
    <thead>
        <tr>
            <th>No</th>
            <th>ID</th>
            <th>Nama</th>
            <th>Email</th>
            <th>No.HP</th>
            <th>Alamat</th>
            <th>Materi</th>
            <th class="col-2">Created At</th>
            <th class="col-2">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        //keyword search
        $sqltambahan = "";
        if ($katakunci != '') {
            $array_katakunci = explode(" ", $katakunci);
            for ($x = 0; $x < count($array_katakunci); $x++) {
                $sqlcari[] = "(name like '%" . $array_katakunci[$x] . "%' or email like '%" . $array_katakunci[$x] . "%' or phone like '%" . $array_katakunci[$x] . "%')";
            }
            $sqltambahan = " where" . implode(" or", $sqlcari);
        }

        //nampilin data
        $sql1 = "select * from pengajars $sqltambahan order by id desc";
        $q1 = mysqli_query($koneksi, $sql1);
        $nomor = 1;
        while ($r1 = mysqli_fetch_array($q1)) {
            ?>
            <tr>
                <td>
                    <?php echo $nomor++ ?>
                </td>
                <td>
                    <?php echo $r1['id'] ?>
                </td>
                <td>
                    <?php echo $r1['name'] ?>
                </td>
                <td>
                    <?php echo $r1['email'] ?>
                </td>
                <td>
                    <?php echo $r1['phone'] ?>
                </td>
                <td>
                    <?php echo $r1['address'] ?>
                </td>
                <td>
                    <?php echo $r1['materi'] ?>
                </td>
                <td>
                    <?php echo $r1['created_at'] ?>
                </td>
                <td>
                    <a class='btn btn-primary btn-sm' href="halaman_edit.php?id=<?php echo $r1['id']?>">Edit</a>
                    <a class='btn btn-danger btn-sm' href="halaman.php?op=delete&id=<?php echo $r1['id']?>" onclick="return confirm('Yakin ingin Delete data?')">Delete</button></a>
                </td>

            </tr>
            <?php
        }
        ?>
    </tbody>
</table>
<?php include("inc_footer.php") ?>