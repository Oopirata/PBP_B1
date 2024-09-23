<?php
//File   : show_cart.php
//Deskripsi: untuk menambahkan item ke shopping cart dan menampilkan isi shopping cart

session_start();
$id = isset($_GET['id']) ? $_GET['id'] : '';
if ($id != "") {
    //Jika $_SESSION['cart'] belum ada, maka inisialisasi dengan array kosong
    //$_SESSION['cart'] merupakan array asosiatif
    //Indexnya berisi isbn buku yang dipilih
    //Value-nya berisi jumlah (qty) dari buku dengan isbn tersebut
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    //Jika $_SESSION['cart'] dengan indeks isbn buku yang dipilih sudah ada, tambahkan
    //value-nya dengan 1, jika belum ada, buat elemen baru dengan indeks tersebut dan set nilainya dengan 1
    if (isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id]++;
    } else {
        $_SESSION['cart'][$id] = 1;
    }
}
?>

<!-- Menampilkan isi shopping cart -->
<?php include('./header.php') ?>
<br>
<div class="card">
    <div class="card-header">Shopping Cart</div>
    <div class="card-body">
        <table class="table table-striped">
            <tr>
                <th>ISBN</th>
                <th>Author</th>
                <th>Title</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Price * Qty</th>
            </tr>

            <?php
            // Include user login information
            require_once('./db_login.php');
            $sum_qty = 0; //inisialisasi total item di shopping cart
            $sum_price = 0; //inisialisasi total price di shopping cart
            
            // Periksa apakah $_SESSION['cart'] ada dan merupakan array
            if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
                foreach ($_SESSION['cart'] as $id => $qty) {
                    $query = "SELECT * FROM books WHERE isbn='" . $id . "'";
                    $result = $db->query($query);
                    $sum_qty += $qty;

                    if (!$result) {
                        die("Could not query the database: <br>" . $db->error . "<br>Query: " . $query);
                    }

                    while ($row = $result->fetch_object()) {
                        echo '<tr>';
                        echo '<td>' . $row->isbn . '</td>';
                        echo '<td>' . $row->author . '</td>';
                        echo '<td>' . $row->title . '</td>';
                        echo '<td>' . $row->price . '</td>';
                        echo '<td>' . $qty . '</td>';
                        $sum_price += ($row->price * $qty);
                        echo '<td>' . $qty . ' * ' . $row->price . '</td>';
                        echo '</tr>';
                    }
                    $result->free();
                }
                $db->close();
            } else {
                echo '<tr><td colspan="6" align="center">There is no item in shopping cart</td></tr>';
            }
            ?>
        </table>
        Total items = <?php echo $sum_qty; ?><br>
        <a class="btn btn-primary" href="view_books.php">Continue Shopping</a>
        <a class="btn btn-danger" href="delete_cart.php">Empty Cart</a><br />
    </div>
</div>

<?php include('./footer.php') ?>