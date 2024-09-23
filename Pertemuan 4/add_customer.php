<?php
session_start();  // Memulai session

if (isset($_POST['submit'])) {
    $aman = TRUE;

    require_once('./db_login.php');  // Sudah include test_input()

    // validasi name
    $name = test_input($_POST['name']);
    if (empty($name)) {
        $error_name = "Name is required !";
        $aman = FALSE;
    } 
    else if (!preg_match("/^[a-zA-Z\s]*$/", $name)) {
        $error_name = "Name only can contain alphabet and space !";
        $aman = FALSE;
    }

    // validasi address
    $address = test_input($_POST['address']);
    if (empty($address)) {
        $error_address = 'Address is required !';
        $aman = FALSE;
    }

    // validasi city
    $city = test_input($_POST['city']);
    if (empty($city) || $city == 'none') {
        $error_city = 'City is required !';
        $aman = FALSE;
    }

    if ($aman) {
        $query = "INSERT INTO customers (name, address, city) VALUES ('$name', '$address', '$city')";
        $result = $db->query($query);

        if (!$result) {
            die("Could not query the database: <br />" . $db->error);
        } else {
            $_SESSION['success_message'] = "Customer Successfully Added!";
            $db->close();
            header('Location: view_customer.php');
            exit;
        }
    }
}
?>

<?php include('./header.php') ?>

<div class="card mx-3 mt-4">
    <div class="card-header">Add Customer</div>
    <div class="card-body">
        <form action="add_customer.php" method="POST">
            <div class="form-group my-3">
                <label for="name">Name</label>
                <input type="text" name="name" value="<?php if (isset($name)) echo $name; ?>" class="form-control">
                <div class="error text-danger"><i><?php if (isset($error_name)) echo $error_name; ?></i></div>
            </div>

            <div class="form-group my-3">
                <label for="address">Address</label>
                <input type="text" name="address" value="<?php if (isset($address)) echo $address; ?>" class="form-control">
                <div class="error text-danger"><i><?php if (isset($error_address)) echo $error_address; ?></i></div>
            </div>

            <div class="form-group">
                <label for="city">City:</label>
                <select name="city" id="city" class="form-control" required>
                    <option value="none" <?php if (!isset($city)) echo 'selected' ?>>--Select a city--</option>
                    <option value="Airport West" <?php if (isset($city) && $city == "Airport West") echo 'selected' ?>>Airport West</option>
                    <option value="Box Hill" <?php if (isset($city) && $city == "Box Hill") echo 'selected' ?>>Box Hill</option>
                    <option value="Yarraville" <?php if (isset($city) && $city == "Yarraville") echo 'selected' ?>>Yarraville</option>
                </select>
                <div class="error text-danger"><i><?php if (isset($error_city)) echo $error_city ?></i></div>
            </div>
            <a href="view_customer.php" class="btn btn-dark my-3">Back</a>
            <button type="submit" name="submit" class="btn btn-primary my-3">Add Customer</button>
        </form>
    </div>
</div>

<?php include('./footer.php') ?>