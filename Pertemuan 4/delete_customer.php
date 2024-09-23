<?php
session_start();
require_once('./db_login.php');

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Mengambil ID dari URL

    // Query untuk menghapus pelanggan
    $query = "DELETE FROM customers WHERE customerid = $id";
    $result = $db->query($query);
    
    // Redirect ke halaman daftar pelanggan
    header('Location: view_customer.php');
    exit;
}
?>