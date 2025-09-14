<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start(); // pastikan session hanya dimulai sekali
}
//membuat koneksi ke database
$conn = mysqli_connect("localhost","root","","operasionalbisnis");

function generateIdUser() {
    return str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);
}

function generatePassword($length = 8) {
    $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $pass = '';
    for ($i = 0; $i < $length; $i++) {
        $pass .= $chars[mt_rand(0, strlen($chars) - 1)];
    }
    return $pass;
}
?>