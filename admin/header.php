<?php
session_start();
if($_SESSION['admin_username'] == ''){
    header("location:login.php");
    exit();
}
include_once("../add/koneksi.php");
include_once("../add/fungsi.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INFORMASI DINAS</title>
    
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="../home.css">

    <link href="../css/summernote-image-list.min.css">
    <script src="../js/summernote-image-list.min.js"></script>

    <style>
        .image-list-content .col-lg-3 { width: 100%;}
        .image-list-content img { float:left; width: 20%}
        .image-list-content p { float:left; padding-left:20px}
        .image-list-item { padding:10px 0px 10px 0px } 
    </style> 
</head>

<body class="container">
    <header>
    <nav>
        <div class="wrapper">
            <div class="logo"><a href=''>SI Alsintan</a></div>
            <div class="menu">
                <ul>
                    <li><a href="home.php">Home</a></li>
                    <li><a href="alsintan.php">Alsintan</a></li>
                    <li><a href="mesin.php">Spesifikasi Mesin</a></li>
                    <li><a href="luasLahan.php">Luas Lahan</a></li>
                    <li><a href="petaLahan.php">Peta Lahan</a></li>
                    <li><a href="logout.php" class="tbl-biru">Log out</a></li>
                </ul>
            </div>
        </div>
    </header>
    <br>