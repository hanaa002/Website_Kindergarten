<?php
session_start();
include '../../conn.php';
if (!isset($_SESSION['nisn'])) {
    header('Location: ../login.php');
}

$nisn = $_SESSION['nisn'];

$query = "SELECT * FROM siswa WHERE nisn = '$nisn'";
$result = $conn->query($query);
$siswa = $result->fetch_assoc();

if (!$siswa) {
    session_destroy();
    header('Location: ../login.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Siswa - Data</title>
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
            <a href="../index.php" class="">
                <i class="fas fa-home"></i>
            </a>
        </div>
        <div class="link">
            <a href="#" class="active">
                <i class="fas fa-user"></i>
            </a>
        </div>
        <div class="link">
            <a href="nilai.php" class="">
                <i class="fas fa-graduation-cap"></i>
            </a>
        </div>
        <div class="link">
            <a href="barang_bawaan.php" class="">
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

    <div class="student-content">

        
        <div class="box-container">
            <div class="title">
                <h1>
                    Data Siswa
                </h1>
            </div>

            <div class="box-name">
                <h3><?= $siswa['nama_siswa'] ?></h3>
                <h3>ID:#<?= $siswa['id_siswa'] ?></h3>
            </div>

            <div class="box-detail">
                <div class="detail">
                    <div class="detail-title">nisn</div>
                    <div class="detail-description"><?= $siswa['nisn'] ?></div>
                </div>
                <div class="detail">
                    <div class="detail-title">Alamat</div>
                    <div class="detail-description"><?= $siswa['alamat_siswa'] ?></div>
                </div>
                <div class="detail">
                    <div class="detail-title">Jenis Kelamin</div>
                    <div class="detail-description"><?= $siswa['jenis_kelamin'] === 'L' ? 'Laki-laki' : 'Perempuan' ?>
                    </div>
                </div>
                <div class="detail">
                    <div class="detail-title">Tinggi Badan</div>
                    <div class="detail-description"><?= $siswa['tinggi_badan'] ?></div>
                </div>
                <div class="detail">
                    <div class="detail-title">Berat Badan</div>
                    <div class="detail-description"><?= $siswa['berat_badan'] ?></div>
                </div>
                <div class="detail">
                    <div class="detail-title">Nama Orang Tua</div>
                    <div class="detail-description"><?= $siswa['nama_ortu'] ?></div>
                </div>
                <div class="detail">
                    <div class="detail-title">Nomor Telepon Orang Tua</div>
                    <div class="detail-description"><?= $siswa['notelp_ortu'] ?></div>
                </div>
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