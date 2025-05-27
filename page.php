<?php 
include_once("add/koneksi.php");
include_once("add/fungsi.php");
$id = get_id();

$sql1   = "select * from artikel where id = '$id'";
$q1     = mysqli_query($koneksi,$sql1);
$n1     = mysqli_num_rows($q1);
$r1     = mysqli_fetch_array($q1);

$judul_halaman  = $r1['judul'];
?>
<?php include_once("header.php")?>
<?php 
if($judul_halaman == ''){
    echo "<div><p>Maaf data yang kamu maksud tidak ditemukan :(</p></div>";
}else{
    ?>
    <p class="deskripsi"><?php echo $r1['kutipan']?></p>
    <h1><?php echo $r1['judul']?></h1>
    <?php echo $r1['isi']?>
    <?php
}
?>
<?php include_once("footer.php")?>