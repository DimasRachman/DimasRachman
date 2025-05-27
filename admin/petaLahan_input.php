<?php include("header.php") ?>
<?php
    $kecamatan  = "";
    $desa       = "";
    $peta       = "";
    $total      = "";
    $error      = "";
    $sukses     = "";
    
if(isset($_GET['id'])){
    $id = $_GET['id'];
}else{
    $id = "";
}

if($id != ""){
    $sql1           = "select * from peta_lahan where id = '$id'";
    $q1             = mysqli_query($koneksi,$sql1);
    $r1             = mysqli_fetch_array($q1);
    $kecamatan      = $r1['kecamatan'];
    $peta           = $r1['peta'];
    $desa           = $r1['desa'];
    
    if($kecamatan == ''){
        $error  = "Data tidak ditemukan";
    }
}

if (isset($_POST['simpan'])) {
    $kecamatan     = $_POST['kecamatan'];
    $desa          = $_POST['desa'];
    $peta =        $_POST['peta'];

    if (isset($_FILES['peta']) && $_FILES['peta']['error'] == UPLOAD_ERR_OK) {
        $upload_dir = 'images/';
        $uploaded_file = $upload_dir . basename($_FILES['peta']['name']);
        if (move_uploaded_file($_FILES['peta']['tmp_name'], $uploaded_file)) {
            $peta = basename($_FILES['peta']['name']);
        }
    }
    
    if ($kecamatan == '' or $desa == '' or $peta == '') {
        $error     = "Silakan masukkan semua data.";
    }

    if (empty($error)) {
        if($id != ""){
            $sql = "SELECT * FROM peta_lahan WHERE desa = '$desa' AND id != '$id'";
        } else {
            $sql = "SELECT * FROM peta_lahan WHERE desa = '$desa'";
        }

        $result = mysqli_query($koneksi, $sql);
        if (mysqli_num_rows($result) > 0) {
            $error = "Data dengan desa yang sama sudah ada.";
        } else {
            if($id != ""){
                $sql1   = "update peta_lahan set kecamatan = '$kecamatan',desa='$desa',peta='$peta', tanggal=now() where id = '$id'";
            }else{
                $sql1   = "insert into peta_lahan(kecamatan,desa,peta) values ('$kecamatan','$desa','$peta')";
            }

            $q1         = mysqli_query($koneksi, $sql1);
            if ($q1) {
                // Setelah berhasil menyimpan data, arahkan ke halaman alsintan.php
                header("Location: petaLahan.php");
                exit();
            } else {
                $error      = "Gagal memasukkan data";
            }
        }
    }
}


?>

<h1>Halaman Input Data Peta Lahan</h1>
<div class="mb-3 row">
    <a href="petaLahan.php">
        << Kembali ke halaman Data Peta Lahan</a>
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
        <label for="desa" class="col-sm-2 col-form-label">Desa</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="desa" value="<?php echo $desa ?>" name="desa">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="peta" class="col-sm-2 col-form-label">Peta</label>
        <div class="col-sm-10">
        <textarea name="peta" class="form-control" id="summernote"><?php echo $peta ?></textarea>
        </div>
    </div>
    <div class="mb-3 row">
        <div class="col-sm-2"></div>
        <div class="col-sm-10">
            <input type="submit" name="simpan" value="Simpan Data" class="btn btn-primary" />
        </div>
    </div>

</form>

<?php if ($peta): ?>
    <div class="mb-3 row">
        <label for="current-peta" class="col-sm-2 col-form-label">Gambar Saat Ini</label>
        <div class="col-sm-10">
            <img src="<?php echo htmlspecialchars($peta); ?>" alt="Peta" class="img-fluid" id="current-peta">
        </div>
    </div>
<?php endif; ?>

</main>
<footer class="bg-light">
    <div class="text-center p-3" style="background:#CCCCCC">
        Copyright &copy; 2024
    </div>
</footer>
<script>
    $(document).ready(function() {
        $('#summernote').summernote({
            callbacks: {
                onImageUpload: function(files) {
                    for(let i=0; i < files.length; i++) {
                        $.upload(files[i]);
                    }
                }
            },
            height:300,
            toolbar: [
                ["style", ["bold", "italic", "underline", "clear"]],
                ["fontname", ["fontname"]],
                ["fontsize", ["fontsize"]],
                ["color", ["color"]],
                ["para", ["ul", "ol", "paragraph"]],
                ["height", ["height"]],
                ["insert", ["link", "picture", "imageList", "video", "hr"]],
                ["help", ["help"]]
            ],
            dialogsInBody: true,
            imageList: {
                endpoint: "list_peta.php",
                fullUrlPrefix: "../peta/",
                thumbUrlPrefix: "../peta/"
            }
        });
        $.upload = function (file) {
            let out = new FormData();
            out.append('file', file, file.name);

            $.ajax({
                method: 'POST',
                url: 'upload_peta.php',
                contentType: false,
                cache: false,
                processData: false,
                data: out,
                success: function (img) {
                    $('#summernote').summernote('insertImage', img);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.error(textStatus + " " + errorThrown);
                }
            });
        };
    });
</script>
</body>

</html>