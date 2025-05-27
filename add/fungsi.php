<?php
function url_base(){
    $url_base = "http://".$_SERVER['SERVER_NAME'].dirname($_SERVER['SCRIPT_NAME']);
    return $url_base;
}
function ambil_gambar($id_){
    global $koneksi;
    $sql1   = "select * from home where id = '$id_'";
    $q1     = mysqli_query($koneksi,$sql1);
    $r1     = mysqli_fetch_array($q1);
    $text   = $r1['isi'];

    preg_match('/< *img[^>]*src *= *["\']?([^"\']*)/i', $text, $img);
    $image = $img[1];
    $image = str_replace("../images/", url_base()."/images/",$image);
    return $image;
}
function ambil_gambarMesin($id_, $n) {
    global $koneksi;
    $sql1 = "SELECT * FROM home WHERE id = '$id_'";
    $q1 = mysqli_query($koneksi, $sql1);
    $r1 = mysqli_fetch_array($q1);
    $text = $r1['isi'];

    preg_match_all('/< *img[^>]*src *= *["\']?([^"\']*)/i', $text, $img);

    if (isset($img[1][$n - 1])) {
        $image = $img[1][$n - 1];
        $image = str_replace("../images/", url_base() . "/images/", $image);
        return $image;
    } else {
        return null; // Jika gambar ke-n tidak ada
    }
}

function get_img($id_){
    global $koneksi;
    $sql1   = "select * from peta_lahan where id = '$id_'";
    $q1     = mysqli_query($koneksi,$sql1);
    $r1     = mysqli_fetch_array($q1);
    $text   = $r1['peta'];

    preg_match('/< *img[^>]*src *= *["\']?([^"\']*)/i', $text, $img);
    $image = $img[1];
    $image = str_replace("../admin/peta/", url_base()."/peta/",$image);
    return $image;
}
function get_peta($id_){
    global $koneksi;
    $sql1   = "select * from peta_lahan where id = '$id_'";
    $q1     = mysqli_query($koneksi,$sql1);
    $r1     = mysqli_fetch_array($q1);
    $text   = $r1['peta'];

    preg_match('/< *img[^>]*src *= *["\']?([^"\']*)/i', $text, $img);
    $image = $img[1];
    $image = str_replace("../peta/", url_base()."/peta/",$image);
    return $image;
}
function ambil_kutipan($id_){
    global $koneksi;
    $sql1   = "select * from home where id = '$id_'";
    $q1     = mysqli_query($koneksi,$sql1);
    $r1     = mysqli_fetch_array($q1);
    $text   = $r1['kutipan'];
    return $text;
}
function ambil_judul($id_){
    global $koneksi;
    $sql1   = "select * from home where id = '$id_'";
    $q1     = mysqli_query($koneksi,$sql1);
    $r1     = mysqli_fetch_array($q1);
    $text   = $r1['judul'];
    return $text;
}
function ambil_isi($id_){
    global $koneksi;
    $sql1   = "select * from home where id = '$id_'";
    $q1     = mysqli_query($koneksi,$sql1);
    $r1     = mysqli_fetch_array($q1);
    $text   = strip_tags($r1['isi']);
    return $text;
}
function ambil_spesifikasi($id_){
    global $koneksi;
    $sql1   = "select * from mesin where id = '$id_'";
    $q1     = mysqli_query($koneksi,$sql1);
    $r1     = mysqli_fetch_array($q1);
    $text   = strip_tags($r1['spesifikasi']);
    return $text;
}
function bersihkan_judul($judul){
    $judul_baru     = strtolower($judul);
    $judul_baru     = preg_replace("/[^a-zA-Z0-9\s]/","",$judul_baru);
    $judul_baru     = str_replace(" ","-",$judul_baru);
    return $judul_baru;
}
function get_id($desa_){
    global $koneksi;
    $sql1   = "select * from peta_lahan where desa = '$desa_'";
    $q1     = mysqli_query($koneksi,$sql1);
    $r1     = mysqli_fetch_array($q1);
    $id     = strip_tags($r1['id']);
    return $id;
}function set_isi($isi){
    $isi    = str_replace("../images/",url_base()."/images/",$isi);
    return $isi;
}