<?php
$error_nis = $error_nama = $error_jenis_kelamin = $error_kelas = $error_ekstrakurikuler = '';
$display_form = true;

if (isset($_POST['submit'])) {
    $nis = test_input($_POST['nis']);
    if (empty($nis)) {
        $error_nis = "NIS harus diisi";
    } elseif (!preg_match("/^[0-9]{10}$/", $nis)) {
        $error_nis = "NIS harus terdiri dari 10 angka";
    }

    $nama = test_input($_POST['nama']);
    if (empty($nama)) {
        $error_nama = "Nama harus diisi";
    } elseif (!preg_match("/^[a-zA-Z ]*$/", $nama)) {
        $error_nama = "Nama hanya dapat berisi huruf dan spasi";
    }

    if (!isset($_POST['jenis_kelamin'])) {
        $error_jenis_kelamin = "Jenis kelamin harus diisi";
    }

    $kelas = isset($_POST['kelas']) ? $_POST['kelas'] : '';
    if (empty($kelas)) {
        $error_kelas = "Kelas harus diisi";
    }

    if ($kelas == 'X' || $kelas == 'XI') {
        if (!isset($_POST['ekstrakurikuler'])) {
            $error_ekstrakurikuler = "Ekstrakurikuler harus dipilih (minimal 1, maksimal 3)";
        } else {
            $ekstrakurikuler = $_POST['ekstrakurikuler'];
            if (count($ekstrakurikuler) < 1 || count($ekstrakurikuler) > 3) {
                $error_ekstrakurikuler = "Ekstrakurikuler minimal 1 dan maksimal 3";
            }
        }
    }

    if (empty($error_nis) && empty($error_nama) && empty($error_jenis_kelamin) && empty($error_kelas) && empty($error_ekstrakurikuler)) {
        $display_form = false;
    }
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Input Siswa</title>
    <style>
        body {
            background-color: #5abf90;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 50%;
            margin: 50px auto;
            background-color: #ffffff;
            padding: 30px;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        .title {
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #2a3b4c;
            color: white;
            padding: 20px;
            border-radius: 10px 10px 0 0;
            margin: -30px -30px 30px -30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"],
        select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .form-check {
            margin-bottom: 10px;
        }

        .form-check input {
            margin-right: 10px;
        }

        .error {
            color: red;
            font-size: 0.9em;
        }

        .btn-group {
            display: flex;
            justify-content: space-between;
        }

        button.reset {
            padding: 10px 20px;
            border: none;
            background-color: red;
            color: white;
            cursor: pointer;
            border-radius: 5px;
        }

        button.submit {
            padding: 10px 20px;
            border: none;
            background-color: green;
            color: white;
            cursor: pointer;
            border-radius: 5px;
        }

        button:hover {
            background-color: #1f2a37;
        }

        .result {
            padding: 20px;
            background-color: #ffffff;
            border-radius: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="title">
            <h1>Form Input Siswa</h1>
        </div>

        <?php if ($display_form) { ?>
            <form method="POST" autocomplete="on" action="">
                <div class="form-group">
                    <label for="NIS">NIS:</label>
                    <input type="text" id="nis" name="nis" maxlength="10" value="<?php if (isset($_POST['nis'])) echo $_POST['nis'] ?>">
                    <div class="error"><?php if (isset($error_nis)) echo $error_nis; ?></div>
                </div>

                <div class="form-group">
                    <label for="nama">Nama:</label>
                    <input type="text" id="nama" name="nama" maxlength="50" value="<?php if (isset($_POST['nama'])) echo $_POST['nama'] ?>">
                    <div class="error"><?php if (isset($error_nama)) echo $error_nama; ?></div>
                </div>

                <div class="form-group">
                    <label>Jenis Kelamin:</label>
                    <div class="form-check">
                        <input type="radio" name="jenis_kelamin" value="Pria" <?php if (isset($_POST['jenis_kelamin']) && $_POST['jenis_kelamin'] == 'Pria') echo 'checked' ?>>Pria
                    </div>
                    <div class="form-check">
                        <input type="radio" name="jenis_kelamin" value="Wanita" <?php if (isset($_POST['jenis_kelamin']) && $_POST['jenis_kelamin'] == 'Wanita') echo 'checked' ?>>Wanita
                    </div>
                    <div class="error"><?php if (isset($error_jenis_kelamin)) echo $error_jenis_kelamin; ?></div>
                </div>

                <div class="form-group">
                    <label for="kelas">Kelas:</label>
                    <select id="kelas" name="kelas" onchange="toggleEkstrakurikuler(this.value)">
                        <option value="" selected disabled>-- Pilih Kelas --</option>
                        <option value="X" <?php if (isset($_POST['kelas']) && $_POST['kelas'] == 'X') echo 'selected' ?>>X</option>
                        <option value="XI" <?php if (isset($_POST['kelas']) && $_POST['kelas'] == 'XI') echo 'selected' ?>>XI</option>
                        <option value="XII" <?php if (isset($_POST['kelas']) && $_POST['kelas'] == 'XII') echo 'selected' ?>>XII</option>
                    </select>
                    <div class="error"><?php if (isset($error_kelas)) echo $error_kelas; ?></div>
                </div>

                <div id="ekstrakurikuler-group" style="display: none;">
                    <label>Ekstrakurikuler:</label>
                    <div class="form-check">
                        <input type="checkbox" name="ekstrakurikuler[]" value="Pramuka" <?php if (isset($_POST['ekstrakurikuler']) && in_array('Pramuka', $_POST['ekstrakurikuler'])) echo 'checked' ?>>Pramuka
                    </div>
                    <div class="form-check">
                        <input type="checkbox" name="ekstrakurikuler[]" value="Seni Tari" <?php if (isset($_POST['ekstrakurikuler']) && in_array('Seni Tari', $_POST['ekstrakurikuler'])) echo 'checked' ?>>Seni Tari
                    </div>
                    <div class="form-check">
                        <input type="checkbox" name="ekstrakurikuler[]" value="Sinematografi" <?php if (isset($_POST['ekstrakurikuler']) && in_array('Sinematografi', $_POST['ekstrakurikuler'])) echo 'checked' ?>>Sinematografi
                    </div>
                    <div class="form-check">
                        <input type="checkbox" name="ekstrakurikuler[]" value="Basket" <?php if (isset($_POST['ekstrakurikuler']) && in_array('Basket', $_POST['ekstrakurikuler'])) echo 'checked' ?>>Basket
                    </div>
                    <div class="error"><?php if (isset($error_ekstrakurikuler)) echo $error_ekstrakurikuler; ?></div>
                </div>

                <div class="btn-group">
                    <button type="submit" class="submit" name="submit">Kirim</button>
                    <button type="reset" class="reset">Reset</button>
                </div>
            </form>
        <?php } else { ?>
            <div class="result">
                <h2>Hasil Input</h2>
                <p><strong>NIS:</strong> <?php echo htmlspecialchars($nis); ?></p>
                <p><strong>Nama:</strong> <?php echo htmlspecialchars($nama); ?></p>
                <p><strong>Jenis Kelamin:</strong> <?php echo htmlspecialchars($_POST['jenis_kelamin']); ?></p>
                <p><strong>Kelas:</strong> <?php echo htmlspecialchars($kelas); ?></p>
                <?php if ($kelas == 'X' || $kelas == 'XI') { ?>
                    <p><strong>Ekstrakurikuler:</strong></p>
                    <ul>
                        <?php foreach ($_POST['ekstrakurikuler'] as $ekstra) { ?>
                            <li><?php echo htmlspecialchars($ekstra); ?></li>
                        <?php } ?>
                    </ul>
                <?php } ?>
            </div>
        <?php } ?>
    </div>

    <script>
        function toggleEkstrakurikuler(kelas) {
            const ekstraGroup = document.getElementById('ekstrakurikuler-group');
            if (kelas === 'X' || kelas === 'XI') {
                ekstraGroup.style.display = 'block';
            } else {
                ekstraGroup.style.display = 'none';
            }
        }

        window.onload = function() {
            const kelas = document.getElementById('kelas').value;
            toggleEkstrakurikuler(kelas);
        }
    </script>
</body>
</html>