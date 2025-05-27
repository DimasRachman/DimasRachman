<?php include("header.php") ?>
<?php

$sukses = "";
$katakunci = (isset($_GET['katakunci'])) ? $_GET['katakunci'] : "";
if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}
if ($op == 'delete') {
    $id = $_GET['id'];
    $sql1   = "delete from peta_lahan where id = '$id'";
    $q1     = mysqli_query($koneksi, $sql1);
    if ($q1) {
        $sukses     = "Berhasil hapus data";
    }
}
?>

<h1>Data Peta Lahan</h1>

<?php
if ($sukses) {
?>
    <div class="alert alert-primary" role="alert">
        <?php echo $sukses ?>
    </div>
<?php
}
?>
<form class="row g-3" method="get">
    <div class="col-auto">
        <input type="text" class="form-control" placeholder="Cari peta" name="katakunci" value="<?php echo $katakunci ?>" />
    </div>
    <div class="col-auto">
        <input type="submit" name="cari" value="Cari" class="btn btn-secondary" />
    </div>
</form>
<table class="table table-striped">
    <thead>
        <tr>
            <th class="col-1"><center>No</th>
            <th class="col-3">Kecamatan</th>
            <th class="col-3">Desa</th>
            <th class="col-3">Peta</th>
            <th class="col-1"></th>
        </tr>
    </thead>
    <tbody>
        <?php
        $sqltambahan = "";
        $per_halaman = 20;
        if ($katakunci != '') {
            $array_katakunci = explode(" ", $katakunci);
            for ($x = 0; $x < count($array_katakunci); $x++) {
                $sqlcari[] = "(kecamatan like '%" . $array_katakunci[$x] . "%')";
            }
            $sqltambahan    = " where " . implode(" or ", $sqlcari);
        }
        $sql1   = "select * from peta_lahan $sqltambahan";
        $page   = isset($_GET['page'])?(int)$_GET['page']:1;
        $mulai  = ($page > 1) ? ($page * $per_halaman) - $per_halaman : 0;
        $q1     = mysqli_query($koneksi,$sql1);
        $total  = mysqli_num_rows($q1);
        $pages  = ceil($total / $per_halaman);
        $nomor  = $mulai + 1;
        $sql1   = $sql1." order by id desc limit $mulai,$per_halaman";

        $q1     = mysqli_query($koneksi, $sql1);
      
        while ($r1 = mysqli_fetch_array($q1)) {
        ?>
            <tr>
                <td><center><?php echo $nomor++ ?></td>
                <td><?php echo $r1['kecamatan'] ?></td>
                <td><?php echo $r1['desa'] ?></td>
                <td><img src="<?php echo get_peta($r1['id']) ?>" width="100" height="100"/></td>
                <td><input type="button" class="btn btn-primary lihat-gambar" data-src= "<?php echo get_peta($r1['id']) ?>" value="Lihat" /></td>
            </tr>
        <?php
        }
        ?>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.4.0/lightgallery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.4.0/plugins/zoom/lg-zoom.umd.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.4.0/plugins/thumbnail/lg-thumbnail.umd.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.4.0/plugins/rotate/lg-rotate.umd.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.4.0/plugins/fullscreen/lg-fullscreen.es5.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.4.0/plugins/fullscreen/lg-fullscreen.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.4.0/plugins/fullscreen/lg-fullscreen.umd.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.4.0/plugins/mediumZoom/lg-medium-zoom.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.4.0/plugins/hash/lg-hash.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.4.0/plugins/share/lg-share.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.4.0/plugins/zoom/lg-zoom.min.js"></script>
        
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                document.querySelectorAll('.lihat-gambar').forEach(button => {
                    button.addEventListener('click', function(event) {
                        event.preventDefault();
                        const imgSrc = this.getAttribute('data-src');
                        
                        const dynamicGallery = document.createElement('div');
                        dynamicGallery.innerHTML = `<a href="${imgSrc}"><img src="${imgSrc}" class="img-fluid"></a>`;
                        document.body.appendChild(dynamicGallery);

                        const lightGalleryInstance = lightGallery(dynamicGallery, {
                            dynamic: true,
                            plugins: [lgZoom, lgThumbnail, lgRotate],
                            dynamicEl: [{
                                src: imgSrc,
                                thumb: imgSrc
                            }],
                            licenseKey: 'your_license_key',
                            closable: true
                        });

                        lightGalleryInstance.openGallery();

                        lightGalleryInstance.on('lgAfterClose', function() {
                            document.body.removeChild(dynamicGallery);
                            lightGalleryInstance.destroy(true);
                        });
                    });
                });
            });
        </script>

    </tbody>
</table>

<nav aria-label="Page navigation example">
    <ul class="pagination">
        <?php 
        $cari = isset($_GET['cari'])? $_GET['cari'] : "";

        for($i=1; $i <= $pages; $i++){
            ?>
            <li class="page-item">
                <a class="page-link" href="informasi_petaLahan.php?katakunci=<?php echo $katakunci?>&cari=<?php echo $cari?>&page=<?php echo $i ?>"><?php echo $i ?></a>
            </li>
            <?php
        }
        ?>
    </ul>
</nav>

<?php include("footer.php") ?>