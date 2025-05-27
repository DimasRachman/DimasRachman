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
    $sql1   = "delete from alsintan where id = '$id'";
    $q1     = mysqli_query($koneksi, $sql1);
    if ($q1) {
        $sukses     = "Berhasil hapus data";
    }
}
?>

<h1>Data Alsiltan</h1>

<form class="row g-3" method="get">
    <div class="col-auto">
        <input type="text" class="form-control" placeholder="Cari Kecamatan" name="katakunci" value="<?php echo $katakunci ?>" />
    </div>
    <div class="col-auto">
        <input type="submit" name="cari" value="Cari" class="btn btn-secondary" />
    </div>
</form>

<?php
if ($sukses) {
?>
    <div class="alert alert-primary" role="alert">
        <?php echo $sukses ?>
    </div>
<?php
}
?>

<table class="table table-striped">
    <thead>
        <tr>
            <th class="col-1"><center>No</th>
            <th><center>Kecamatan</th>
            <th><center>Traktor Roda 2</th>
            <th><center>Hand Traktor Rotari</th>
            <th><center>Hand Traktor Singkal</th>
            <th><center>Cultivator</th>
            <th><center>Total Alsintan</th>
            <th class="col-2"><center>Aksi</th>
        </tr>
    </thead>
    <tbody>
    <?php
        $sqltambahan = "";
        $per_halaman = 10;
        if ($katakunci != '') {
            $array_katakunci = explode(" ", $katakunci);
            for ($x = 0; $x < count($array_katakunci); $x++) {
                $sqlcari[] = "(kecamatan like '%" . $array_katakunci[$x] . "%')";
            }
            $sqltambahan    = " where " . implode(" or ", $sqlcari);
        }
        $sql1   = "select * from alsintan $sqltambahan";
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
                <td><center><?php echo $r1['kecamatan'] ?></td>
                <td><center><?php echo $r1['tr2'] ?></td>
                <td><center><?php echo $r1['htr'] ?></td>
                <td><center><?php echo $r1['hts'] ?></td>
                <td><center><?php echo $r1['cultivator'] ?></td>
                <td><center><?php echo $r1['tr2'] + $r1['htr'] + $r1['hts'] + $r1['cultivator'] ?></td>
                <td><center>
                    <a href="alsintan_input.php?id=<?php echo $r1['id']?>">
                        <span class="badge bg-warning text-dark">Edit</span>
                    </a>

                    <a href="alsintan.php?op=delete&id=<?php echo $r1['id'] ?>" onclick="return confirm('Hapus Data?')">
                        <span class="badge bg-danger">Delete</span>
                    </a>
                </td>
            </tr>
        <?php
        }
        ?>

    </tbody>
</table>

<nav aria-label="Page navigation example">
    <ul class="pagination">
        <?php 
        $cari = isset($_GET['cari'])? $_GET['cari'] : "";

        for($i=1; $i <= $pages; $i++){
            ?>
            <li class="page-item">
                <a class="page-link" href="alsintan.php?katakunci=<?php echo $katakunci?>&cari=<?php echo $cari?>&page=<?php echo $i ?>"><?php echo $i ?></a>
            </li>
            <?php
        }
        ?>
    </ul>
</nav>

<p>
    <a href="alsintan_input.php">
        <input type="button" class="btn btn-primary" value="Buat Data Baru" />
    </a>
</p>
 
<?php include("footer.php") ?>