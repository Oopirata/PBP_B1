<?php
require_once('./lib/db_login.php');

if (isset($_GET['isbn'])) {
    $isbn = $_GET['isbn'];
    $query = "SELECT * FROM books WHERE isbn = '" . $isbn . "'";
    $result = $db->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_object();
        echo '<h3>Detail Buku</h3>';
        echo '<p><strong>ISBN:</strong> ' . $row->isbn . '</p>';
        echo '<p><strong>Judul:</strong> ' . $row->title . '</p>';
        echo '<p><strong>Penulis:</strong> ' . $row->author . '</p>';
        echo '<p><strong>Harga:</strong> $' . $row->price . '</p>';
    } else {
        echo 'Buku tidak ditemukan.';
    }

    $result->free();
    $db->close();
}
?>
