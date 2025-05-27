<?php include("header.php") ?>
<?php
$kecamatan           = "";
$kebun               = "";
$sawah               = "";
$pekarangan          = "";
$sawah_irigasi       = "";
$sawah_tadah_hujan   = "";
$tegalan             = "";
$error               = "";
$sukses              = "";

if(isset($_GET['id'])){
    $id = $_GET['id'];
}else{
    $id = "";
}

if($id != ""){
    $sql1                 = "select * from luas_lahan where id = '$id'";
    $q1                   = mysqli_query($koneksi,$sql1);
    $r1                   = mysqli_fetch_array($q1);
    $kecamatan            = $r1['kecamatan'];
    $kebun                = $r1['kebun'];
    $pekarangan           = $r1['pekarangan'];
    $sawah_irigasi        = $r1['sawah_irigasi'];
    $sawah_tadah_hujan    = $r1['sawah_tadah_hujan'];
    $tegalan              = $r1['tegalan'];

    if($kecamatan == ''){
        $error  = "Data tidak ditemukan";
    }
}

if (isset($_POST['simpan'])) {
    $kecamatan          = $_POST['kecamatan'];
    $kebun              = $_POST['kebun'];
    $pekarangan         = $_POST['pekarangan'];
    $sawah_irigasi      = $_POST['sawah_irigasi'];
    $sawah_tadah_hujan  = $_POST['sawah_tadah_hujan'];
    $tegalan            = $_POST['tegalan'];
    
    if ($kecamatan == '') {
        $error     = "Silakan masukkan semua data.";
    }

    if ($kebun == ''){
        $kebun = 0;
    }
    if ($pekarangan == ''){
        $pekarangan = 0;
    }
    if ($sawah_irigasi == ''){
        $sawah_irigasi = 0;
    }
    if ($sawah_tadah_hujan == ''){
        $sawah_tadah_hujan = 0;
    }
    if ($tegalan == ''){
        $tegalan = 0;
    }

    if (empty($error)) {
        if($id != ""){
            $sql = "SELECT * FROM luas_lahan WHERE kecamatan = '$kecamatan' AND id != '$id'";
        } else {
            $sql = "SELECT * FROM luas_lahan WHERE kecamatan = '$kecamatan'";
        }

        $result = mysqli_query($koneksi, $sql);
        if (mysqli_num_rows($result) > 0) {
            $error = "Data dengan kecamatan yang sama sudah ada.";
        } else {
            if($id != ""){
                $sql1   = "update luas_lahan set kecamatan = '$kecamatan',kebun='$kebun',pekarangan='$pekarangan',sawah_irigasi='$sawah_irigasi',sawah_tadah_hujan='$sawah_tadah_hujan',tegalan='$tegalan', tanggal=now() where id = '$id'";
            }else{
                $sql1   = "insert into luas_lahan(kecamatan,kebun,pekarangan,sawah_irigasi,sawah_tadah_hujan,tegalan) values ('$kecamatan','$kebun','$pekarangan','$sawah_irigasi','$sawah_tadah_hujan','$tegalan')";
            }

            $q1         = mysqli_query($koneksi, $sql1);
            if ($q1) {
                // Setelah berhasil menyimpan data, arahkan ke halaman alsintan.php
                header("Location: luasLahan.php");
                exit();
            } else {
                $error      = "Gagal memasukkan data";
            }
        }
    }
}

?>
<h1>Halaman Input Data Luas Lahan</h1>
<div class="mb-3 row">
    <a href="luasLahan.php">
        << Kembali ke halaman Data Luas Lahan</a>
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
        <label for="kecamatan" class="col-sm-2 col-form-label">Kecamatan</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="kecamatan" value="<?php echo $kecamatan ?>" name="kecamatan">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="kebun" class="col-sm-2 col-form-label">Kebun</label>
        <div class="col-sm-10">
            <input type="number" class="form-control" id="kebun" value="<?php echo $kebun ?>" name="kebun">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="pekarangan" class="col-sm-2 col-form-label">Pekarangan</label>
        <div class="col-sm-10">
            <input type="number" class="form-control" id="pekarangan" value="<?php echo $pekarangan ?>" name="pekarangan">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="sawah_irigasi" class="col-sm-2 col-form-label">Sawah Irigasi</label>
        <div class="col-sm-10">
            <input type="number" class="form-control" id="sawah_irigasi" value="<?php echo $sawah_irigasi ?>" name="sawah_irigasi">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="sawah_tadah_hujan" class="col-sm-2 col-form-label">Sawah Tadah Hujan</label>
        <div class="col-sm-10">
            <input type="number" class="form-control" id="sawah_tadah_hujan" value="<?php echo $sawah_tadah_hujan ?>" name="sawah_tadah_hujan">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="tegalan" class="col-sm-2 col-form-label">Tegalan</label>
        <div class="col-sm-10">
            <input type="number" class="form-control" id="tegalan" value="<?php echo $tegalan ?>" name="tegalan">
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