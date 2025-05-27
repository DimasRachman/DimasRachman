<?php include("header.php") ?>
<?php
$judul      = "";
$kutipan    = "";
$isi        = "";
$error      = "";
$sukses     = "";

if(isset($_GET['id'])){
    $id = $_GET['id'];
}else{
    $id = "";
}

if($id != ""){
    $sql1           = "select * from home where id = '$id'";
    $q1             = mysqli_query($koneksi,$sql1);
    $r1             = mysqli_fetch_array($q1);
    $judul          = $r1['judul'];
    $kutipan        = $r1['kutipan'];
    $isi            = $r1['isi'];

    if($judul == ''){
        $error  = "Data tidak ditemukan";
    }
}

if (isset($_POST['simpan'])) {
    $judul      = $_POST['judul'];
    $kutipan    = $_POST['kutipan'];
    $isi        = $_POST['isi'];
    
    if ($judul == '' or $kutipan == '' or $isi == '') {
        $error     = "Silakan masukkan semua data.";
    }

    if (empty($error)) {
        if($id != ""){
            $sql = "SELECT * FROM home WHERE judul = '$judul' AND id != '$id'";
        } else {
            $sql = "SELECT * FROM home WHERE judul = '$judul'";
        }

        $result = mysqli_query($koneksi, $sql);
        if (mysqli_num_rows($result) > 0) {
            $error = "Data dengan judul yang sama sudah ada.";
        } else {
            if($id != ""){
                $sql1   = "update home set judul = '$judul',kutipan='$kutipan',isi='$isi', tanggal=now() where id = '$id'";
            }else{
                $sql1   = "insert into home(judul,kutipan,isi) values ('$judul','$kutipan','$isi')";
            }

            $q1         = mysqli_query($koneksi, $sql1);
            if ($q1) {
                // Setelah berhasil menyimpan data, arahkan ke halaman alsintan.php
                header("Location: home.php");
                exit();
            } else {
                $error      = "Gagal memasukkan data";
            }
        }
    }
}
?>

<h1>Halaman Input Home</h1>
<div class="mb-3 row">
    <a href="home.php">
        << Kembali ke halaman Home</a>
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
        <label for="judul" class="col-sm-2 col-form-label">Judul</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="judul" value="<?php echo $judul ?>" name="judul">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="kutipan" class="col-sm-2 col-form-label">Kutipan</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="kutipan" value="<?php echo $kutipan ?>" name="kutipan">
        </div>
    </div>                
    <div class="mb-3 row">
        <label for="isi" class="col-sm-2 col-form-label">Isi</label>
        <div class="col-sm-10">
            <textarea name="isi" class="form-control" id="summernote"><?php echo $isi ?></textarea>
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