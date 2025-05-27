<?php include("header.php") ?>
<?php
$kecamatan  = "";
$tr2        = "";
$htr        = "";
$hts        = "";
$cultivator = "";
$error      = "";
$sukses     = "";

if(isset($_GET['id'])){
    $id = $_GET['id'];
}else{
    $id = "";
}

if($id != ""){
    $sql1   = "select * from alsintan where id = '$id'";
    $q1     = mysqli_query($koneksi,$sql1);
    $r1     = mysqli_fetch_array($q1);
    $kecamatan  = $r1['kecamatan'];
    $tr2        = $r1['tr2'];
    $htr        = $r1['htr'];
    $hts        = $r1['hts'];
    $cultivator = $r1['cultivator'];

    if($kecamatan == ''){
        $error  = "Data tidak ditemukan";
    }
}

if (isset($_POST['simpan'])) {
    $kecamatan  = $_POST['kecamatan'];
    $tr2        = $_POST['tr2'];
    $htr        = $_POST['htr'];
    $hts        = $_POST['hts'];
    $cultivator = $_POST['cultivator'];

    if ($kecamatan == '') {
        $error     = "Silakan masukkan semua data.";
    }

    if ($tr2 == ''){
        $tr2 = 0;
    }
    if ($htr == ''){
        $htr = 0;
    }
    if ($hts == ''){
        $hts = 0;
    }
    if ($cultivator == ''){
        $cultivator = 0;
    }

    if (empty($error)) {
        if($id != ""){
            $sql = "SELECT * FROM alsintan WHERE kecamatan = '$kecamatan' AND id != '$id'";
        } else {
            $sql = "SELECT * FROM alsintan WHERE kecamatan = '$kecamatan'";
        }

        $result = mysqli_query($koneksi, $sql);
        if (mysqli_num_rows($result) > 0) {
            $error = "Data dengan kecamatan yang sama sudah ada.";
        } else {
            if($id != ""){
                $sql1   = "update alsintan set kecamatan = '$kecamatan',tr2='$tr2',htr='$htr',hts='$hts',cultivator='$cultivator',total='$total', tanggal=now() where id = '$id'";
            }else{
                $sql1   = "insert into alsintan(kecamatan,tr2,htr,hts,cultivator,total) values ('$kecamatan','$tr2','$htr','$hts','$cultivator','$total')";
            }

            $q1         = mysqli_query($koneksi, $sql1);
            if ($q1) {
                // Setelah berhasil menyimpan data, arahkan ke halaman alsintan.php
                header("Location: alsintan.php");
                exit();
            } else {
                $error      = "Gagal memasukkan data";
            }
        }
    }
}

?>
<h1>Halaman Input Data Asiltan</h1>
<div class="mb-3 row">
    <a href="alsintan.php">
        << Kembali ke halaman Data Asiltan</a>
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
        <label for="tr2" class="col-sm-2 col-form-label">Traktor Roda 2</label>
        <div class="col-sm-10">
            <input type="number" class="form-control" id="tr2" value="<?php echo $tr2 ?>" name="tr2">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="htr" class="col-sm-2 col-form-label">Hand Traktor Rotari</label>
        <div class="col-sm-10">
            <input type="number" class="form-control" id="htr" value="<?php echo $htr ?>" name="htr">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="hts" class="col-sm-2 col-form-label">Hand Traktor Singkal</label>
        <div class="col-sm-10">
            <input type="number" class="form-control" id="hts" value="<?php echo $hts ?>" name="hts">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="cultivator" class="col-sm-2 col-form-label">Cultivator</label>
        <div class="col-sm-10">
            <input type="number" class="form-control" id="cultivator" value="<?php echo $cultivator ?>" name="cultivator">
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