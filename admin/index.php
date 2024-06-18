<?php
// Sertakan file koneksi
require_once "../conn.php";

// Query untuk mengambil data kegiatan
$sql_kegiatan = "SELECT * FROM informasi_kegiatan";
$result_kegiatan = $conn->query($sql_kegiatan);

// Query untuk mengambil data barang bawaan
$sql_barang = "SELECT * FROM barang_bawaan";
$result_barang = $conn->query($sql_barang);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monitor Kegiatan & Barang Bawaan</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        body {
            font-size: 2rem; /* Adjusted to a more standard size */
        }

        table {
            width: 1200px;
            border-collapse: collapse;
            font-size: 1rem;
            text-align: left;
            border-radius: 10px;
            overflow: hidden;
        }

        th, td {
            padding: 12px 15px;
            font-size: 13px;
        }

        th {
            background-color: var(--pink);
            color: #ffffff;
        }

        tr {
            border-bottom: 1px solid #dddddd;
        }

        tr:nth-of-type(even) {
            background-color: #f3f3f3;
        }

        tr:last-of-type {
            border-bottom: 2px solid var(--pink);
        }

        img {
            border-radius: 50%;
            width: 50px;
            height: 50px;
            object-fit: cover;
        }
    </style>
</head>

<body>

    <?php
    require_once 'sidebar.html';
    ?>

    <div class="content" style="margin-left: 150px;">
        <h2 style="padding-top: 70px;"><b>Monitor Kegiatan & Barang Bawaan yang Telah Diunggah Guru</b></h2>
        <h4 style="padding-top: 40px;">Kegiatan yang Telah Diunggah Guru</h4>
        <?php
        // if ($result_kegiatan->num_rows > 0) {
        //     echo "<table border='1' cellpadding='10' cellspacing='0' style='margin-top:30px';>
        //         <tr class='ttop'>
        //             <th>Nama Kegiatan</th>
        //             <th>Deskripsi</th>
        //             <th>Tanggal Kegiatan</th>
        //             <th>Dokumentasi</th>
        //         </tr>";
        //     while ($row_kegiatan = $result_kegiatan->fetch_assoc()) {
        //         echo "
        //         <tr style='background-color:orange;'>
        //             <td>" . $row_kegiatan["nama_kegiatan"] . "</td>
        //             <td>" . $row_kegiatan["deskripsi"] . "</td>
        //             <td>" . $row_kegiatan["tgl_kegiatan"] . "</td>
        //             <td>" . $row_kegiatan["dokumentasi"] . "</td>
        //         </tr>";
        //     }
        //     echo "</table>";
        // } else {
        //     echo "Belum ada kegiatan yang diunggah.";
        // }

        // ini baru


        ?>
        <table border='1' cellpadding='10' cellspacing='0' style='margin-top:30px' ;>
            <tr class='ttop'>
                <th>Nama Kegiatan</th>
                <th>Deskripsi</th>
                <th>Tanggal Kegiatan</th>
                <th>Dokumentasi</th>
            </tr>
            <?php
            while ($d = mysqli_fetch_array($result_kegiatan)) {
            ?>
                <tr style='background-color: var(--orange);'>
                    <td><?= ucwords($d['nama_kegiatan']) ?></td>
                    <td><?= ucwords($d['deskripsi']) ?></td>
                    <td><?= ucwords($d['tgl_kegiatan']) ?></td>
                    <td><?= ucwords($d['dokumentasi']) ?></td>
                </tr>
            <?php

            }
            ?>
        </table>




        <!--  -->
        <h4 style="padding-top: 50px;">Barang Bawaan yang Telah Diunggah Guru</h4>
        <?php
        if ($result_barang->num_rows > 0) {
            echo "<table border='1' cellpadding='10' cellspacing='0' style='margin-top:30px';>
                <tr class='btop'>
                    <th>Nama Barang</th>
                    <th>Info Kegiatan</th>
                    <th>Tanggal Bawa</th>
                </tr>";
            while ($row_barang = $result_barang->fetch_assoc()) {
                echo "<tr style='background-color: var(--orange)'>
                    <td>" . $row_barang["nama_barang"] . "</td>
                    <td>" . $row_barang["info_kegiatan"] . "</td>
                    <td>" . $row_barang["tgl_bawa"] . "</td>
                  </tr>";
            }
            echo "</table>";
        } else {
            echo "Belum ada barang bawaan yang diunggah.";
        }
        ?>

    </div>

</body>

</html>