<?php
session_start();

// Periksa apakah $_SESSION['cart'] ada
if (isset($_SESSION['cart'])) {
    unset($_SESSION['cart']);
}

// Redirect ke show_cart.php
header('Location: show_cart.php');
exit; // Tambahkan exit untuk menghentikan script
?>