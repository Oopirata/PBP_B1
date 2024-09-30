<?php
require_once('./lib/db_login.php');

if (isset($_GET['searchTerm'])) {
    $searchTerm = $_GET['searchTerm'];
    $query = "SELECT * FROM books WHERE title LIKE '%$searchTerm%'";
    $result = $db->query($query);

    if ($result) {
        echo "<table class='table table-striped'>
        <tr>
            <th>ISBN</th>
            <th>Title</th>
            <th>Action</th>
        </tr>";
        while ($row = $result->fetch_object()) {
            echo '<tr>';
                echo '<td>' . $row->isbn . '</td>';
                echo '<td>' . $row->title . '</td>';
                echo '<td><button class="btn btn-primary btn-sm" onclick="showBookDetail(\'' . $row->isbn . '\')">Detail</button></td>';
                echo '</tr>';
        }
        echo '</table>';
        echo '<br />';
        echo 'Total Rows = ' . $result->num_rows;
        $result->free();
    } else {
        echo 'Pencarian tidak ditemukan.';
    }

    $db->close();
}
?>
