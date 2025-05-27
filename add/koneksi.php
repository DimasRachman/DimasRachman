<?php
$host   = "localhost";
$user   = "root";
$pass   = "";
$db     = "dinas";

$koneksi    = mysqli_connect($host,$user,$pass,$db);
if(!$koneksi){
    die("gagal");
}
