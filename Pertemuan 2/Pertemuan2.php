<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pertemuan 2</title>
    <style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 5px;
            text-align: center;
            margin:auto;
        }
        
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
    </style>
</head>
<body>
    <?php
    function hitung_rata($array) {
        $jumlah = array_sum($array);
        $banyak = count($array);
        $rata = $jumlah / $banyak;
        return $rata;
    }

    function print_mhs($array_mhs) {
        echo "<div class ='container'>";
            echo "<div class='title'>";
                echo "<h1>Daftar Nilai Mahasiswa</h1>";
            echo "</div>";
            echo "<table>";
            echo "<tr><th>Nama</th><th>Nilai 1</th><th>Nilai 2</th><th>Nilai 3</th><th>Rata2</th></tr>";

            foreach ($array_mhs as $nama => $nilai) {
                $rata2 = hitung_rata($nilai);
                echo "<tr>";
                echo "<td>$nama</td>";
                echo "<td>$nilai[0]</td>";
                echo "<td>$nilai[1]</td>";
                echo "<td>$nilai[2]</td>";
                echo "<td>" . $rata2 . "</td>";
                echo "</tr>";
            }

            echo "</table>";
        echo "</div>";
    }

    $array_mhs = array(
        "Budi" => array(89, 90, 54),
        "Joni" => array(98, 65, 74),
        "Tejo" => array(67, 56, 84)
    );

    print_mhs($array_mhs);
    ?>
</body>
</html>