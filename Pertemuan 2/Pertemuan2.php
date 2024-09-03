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
    }

    $array_mhs = array(
        "Abdul" => array(89, 90, 54),
        "Budi" => array(98, 65, 74),
        "Nina" => array(67, 56, 84)
    );

    print_mhs($array_mhs);
    ?>
</body>
</html>