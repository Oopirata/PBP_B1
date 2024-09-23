#view books
<?php include('./header.php') ?>
<div class="container">
    <div class="card mt-4">
        <div class="cardheader">Books Data</div>
        <div class="card-body">
            <br>
            <table class="table table-striped">
                <tr>
                    <th>ISBN</th>
                    <th>Author</th>
                    <th>Title</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>
                <?php
                // include our login 

                require_once('./db_login.php');
                // execute the query 26
                $query = " SELECT * FROM books ORDER BY isbn ";
                $result = $db->query($query);
                if (!$result) {
                    die("Could not 
the query the database: <br />" . $db->error
                        . "<br>Query: " . $query);
                }
                // fetch and display the results
                while ($row =
                    $result->fetch_object()
                ) {
                    echo '<tr>';
                    echo '<td>'
                        . $row->isbn . '</td>';
                    echo '<td>'
                        . $row->author . '</td>';
                    echo '<td>'
                        . $row->title . '</td>';
                    echo '<td> $' . $row->price . '</td>';
                    echo '<td><a class="btn btn-primary" href="show_cart.php?id=' . $row->isbn . '">Add to Cart</a></td>';
                    echo '</tr>';
                }
                echo '</table>';
                echo '<br />';
                echo 'Total Rows = ' . $result->num_rows;
                $result->free();
                $db->close();
                ?>
        </div>
    </div>
</div>
<?php include('./footer.php') ?>