<?php

require_once('./lib/db_login.php');

// TODO 1: Ambil value dari query string parameter id
$id = $_GET['customerid'];
// TODO 2: Tuliskan dan eksekusi query untuk mendapatkan informasi customer
$query = "SELECT * FROM customers WHERE customerid = '" . $id . "'";
$result = $db->query($query);
if (!$result) {
    die("Could not query the database: <br>" . $db->error);
}

// TODO 3: Tuliskan response
while($row = $result->fetch_object()){
    echo "<div class='alert alert-success alert-dismissible'>
    <strong>Load Success!</strong> Here's The Data<br> Name: " . $row->name . "<br> Address: " . $row->address . "<br> City: " . $row->city . "</div>";
}

// TODO 4: Dealokasi variabel dan tutup koneksi database
$result->free();
$db->close();