<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start(); // pastikan session hanya dimulai sekali
}
?>
