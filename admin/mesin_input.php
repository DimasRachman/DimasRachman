<?php include("header.php") ?>
<?php
$nama_mesin  = "";
$spesifikasi = "";
$error       = "";
$sukses      = "";

if(isset($_GET['id'])){
    $id = $_GET['id'];
}else{
    $id = "";
}

if($id != ""){
    $sql1           = "select * from mesin where id = '$id'";
    $q1             = mysqli_query($koneksi,$sql1);
    $r1             = mysqli_fetch_array($q1);
    $nama_mesin     = $r1['nama_mesin'];
    $spesifikasi    = $r1['spesifikasi'];
    
    if($nama_mesin == ''){
        $error  = "Data tidak ditemukan";
    }
}

if (isset($_POST['simpan'])) {
    $nama_mesin     = $_POST['nama_mesin'];
    $spesifikasi    = $_POST['spesifikasi'];
    
    if ($nama_mesin == '' or $spesifikasi == '') {
        $error     = "Silakan masukkan semua data.";
    }

    if (empty($error)) {
        if($id != ""){
            $sql = "SELECT * FROM mesin WHERE nama_mesin = '$nama_mesin' AND id != '$id'";
        } else {
            $sql = "SELECT * FROM mesin WHERE nama_mesin = '$nama_mesin'";
        }

        $result = mysqli_query($koneksi, $sql);
        if (mysqli_num_rows($result) > 0) {
            $error = "Data dengan nama mesin yang sama sudah ada.";
        } else {
            if($id != ""){
                $sql1   = "update mesin set nama_mesin = '$nama_mesin',spesifikasi='$spesifikasi', tanggal=now() where id = '$id'";
            }else{
                $sql1   = "insert into mesin(nama_mesin,spesifikasi) values ('$nama_mesin','$spesifikasi')";
            }

            $q1         = mysqli_query($koneksi, $sql1);
            if ($q1) {
                // Setelah berhasil menyimpan data, arahkan ke halaman alsintan.php
                header("Location: mesin.php");
                exit();
            } else {
                $error      = "Gagal memasukkan data";
            }
        }
    }
}


?>
<h1>Halaman Input Data Spesifikasi Mesin</h1>
<div class="mb-3 row">
    <a href="mesin.php">
        << Kembali ke halaman Data Spesifikasi Mesin</a>
</div>
<?php
if ($error) {
?>
    <div class="alert alert-danger" role="alert">
        <?php echo $error ?>
    </div>
<?php
}
?>
<?php
if ($sukses) {
?>
    <div class="alert alert-primary" role="alert">
        <?php echo $sukses ?>
    </div>
<?php
}
?>
<form action="" method="post">
    <div class="mb-3 row">
        <label for="nama_mesin" class="col-sm-2 col-form-label">Mesin</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="nama_mesin" value="<?php echo $nama_mesin ?>" name="nama_mesin">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="spesifikasi" class="col-sm-2 col-form-label">Spesifikasi</label>
        <div class="col-sm-10">
            <textarea name="spesifikasi" class="form-control" id="summernote"><?php echo $spesifikasi ?></textarea>
        </div>
    </div>
    
    <div class="mb-3 row">
        <div class="col-sm-2"></div>
        <div class="col-sm-10">
            <input type="submit" name="simpan" value="Simpan Data" class="btn btn-primary" />
        </div>
    </div>
</form>
<?php include("footer.php") ?>