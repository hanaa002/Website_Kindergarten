<?php
session_start();
include '../../conn.php';
if (!isset($_SESSION['nip'])) {
    header('Location: ../login.php');
}

$nip = $_SESSION['nip'];

$query = "SELECT * FROM guru WHERE nip = '$nip'";
$result = $conn->query($query);
$guru = $result->fetch_assoc();

if (!$guru) {
    session_destroy();
    header('Location: ../login.php');
}

$barang_bawaan_query = "SELECT * FROM barang_bawaan";
$barang_bawaan = $conn->query($barang_bawaan_query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guru - Barang Bawaan</title>
    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- lightgallery css cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightgallery-js/1.4.0/css/lightgallery.min.css">
    <!-- custom css file link  -->
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>

<body>
    <aside class="sidebar">
        <div class="link">
            <a href="../../index.php" class="">
                <i class="fas fa-home"></i>
            </a>
        </div>
        <div class="link">
            <a href="index.php" class="">
                <i class="fas fa-user"></i>
            </a>
        </div>
        <div class="link">
            <a href="nilai.php" class="">
                <i class="fas fa-graduation-cap"></i>
            </a>
        </div>
        <div class="link">
            <a href="#" class="active">
                <i class="fas fa-box"></i>
            </a>
        </div>
        <div class="link">
            <a href="informasi_kegiatan.php" class="">
                <i class="fas fa-info-circle"></i>
            </a>
        </div>
        <div class="link">
            <a href="../../logout.php" class="">
                <i class="fas fa-sign-out-alt"></i>
            </a>
        </div>
    </aside>

    <div class="teacher-content">


        <div class="box-container">

            <div class="title">
                <h1>
                    Barang Bawaan
                </h1>
                <a href="input_barang_bawaan.php" class="btn">
                    <i class="fas fa-plus"></i>
                    <span>Input Barang</span>
                </a>
            </div>


            <div class="box-detail">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Barang</th>
                            <th>Info Kegiatan</th>
                            <th>Tanggal Bawa</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($barang_bawaan->num_rows > 0):
                            $no = 1;
                            while ($row = $barang_bawaan->fetch_assoc()):
                                ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $row['nama_barang'] ?></td>
                                    <td><?= $row['info_kegiatan'] ?></td>
                                    <td><?= $row['tgl_bawa'] ?></td>
                                    <td>
                                        <a href="edit_barang_bawaan.php?id_barang=<?= $row['id_barang'] ?>" class="btn-edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="delete_barang_bawaan.php?id_barang=<?= $row['id_barang'] ?>" class="btn-delete" onclick="confirm('Yakin hapus data ini?')">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php
                            endwhile;
                        else:
                            ?>
                            <tr>
                                <td colspan="5">
                                    <center>Data tidak ditemukan</center>
                                </td>
                            </tr>
                            <?php
                        endif;
                        ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <!-- lightgallery cdn js link -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery-js/1.4.0/js/lightgallery.min.js"></script>
    <!-- custom js file link -->
    <script src="../../assets/js/script.js"></script>

    <script>
        lightGallery(document.querySelector('.gallery .gallery-container'));
    </script>

</body>

</html>