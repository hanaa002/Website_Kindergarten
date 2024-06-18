<?php
session_start();
include '../conn.php';
if (!isset($_SESSION['nisn'])) {
    header('Location: login.php');
}

$nisn = $_SESSION['nisn'];
$query = "SELECT * FROM siswa WHERE nisn = '$nisn'";
$result = $conn->query($query);
$siswa = $result->fetch_assoc();

if (!$siswa) {
    session_destroy();
    header('Location: login.php');
}

$informasi_kegiatan_query = "SELECT * FROM informasi_kegiatan";
$informasi_kegiatan = $conn->query($informasi_kegiatan_query);

$barang_bawaan_query = "SELECT * FROM barang_bawaan";
$barang_bawaan = $conn->query($barang_bawaan_query);

$nilai = "SELECT * FROM nilai WHERE id_siswa = " . $siswa['id_siswa'];
$nilai = $conn->query($nilai);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Kindergarten Website</title>
    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- lightgallery css cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightgallery-js/1.4.0/css/lightgallery.min.css">
    <!-- custom css file link  -->
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>

    <!-- header section starts -->

    <header class="header">

        <a href="#" class="logo"> <i class="fas fa-school"></i> TK Dharma Wanita Persatuan</a>

        <nav class="navbar">
            <a href="#data-siswa">data siswa</a>
            <a href="#barang-bawaan">barang bawaan</a>
            <a href="#informasi-kegiatan">kegiatan</a>
            <a href="#rapor">rapor</a>
            <a href="../logout.php">logout</a>
        </nav>

        <div class="icons">
            <div class="fas fa-user" id="login-btn"></div>
            <div class="fas fa-bars" id="menu-btn"></div>
        </div>

        <div class="login-form">
            <a href="dashboard/index.php" class="btn">siswa dashboard</a>
        </div>

    </header>

    <!-- header section ends -->

    <!-- hero section starts -->

    <section class="hero" id="data-siswa">
        <div class="title-student">
            <div class="image-student">
                <?php
                if ($siswa['foto'] == null) {
                    echo '<img src="../assets/images/user.png" alt="">';
                } else {
                    echo '<img src="../uploads/' . $siswa['foto'] . '" alt="">';
                }
                ?>
            </div>

            <div class="content-student">
                <h3>Hi! <?= $siswa['nama_siswa'] ?> Parent's</h3>
                <p>Selamat datang moms/dad!! Ayo pantau tumbuh kembang anak anda disini
                </p>
            </div>
        </div>

        <div class="item-information" id="barang-bawaan">
            <h5>Informasi Barang Bawaan</h5>
            <ul>
                <?php
                $count_barang = 0;
                if ($barang_bawaan->num_rows > 0) {
                    if ($count_barang < 3) {
                        while ($row = $barang_bawaan->fetch_assoc()) {
                            echo '<li>' . $row['nama_barang'] . ' - ' . date('d F Y', strtotime($row['tgl_bawa'])) . '</li>';
                        }
                    }
                    $count_barang++;
                } else {
                    echo '<li>Belum ada barang bawaan</li>';
                }
                ?>
            </ul>
            <div class="btn-wrapper">
                <a href="dashboard/barang_bawaan.php" class="btn">Lihat Barang Bawaan</a>
            </div>
        </div>

        <div class="custom-shape-divider-bottom-1684324473">
            <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120"
                preserveAspectRatio="none">
                <path
                    d="M985.66,92.83C906.67,72,823.78,31,743.84,14.19c-82.26-17.34-168.06-16.33-250.45.39-57.84,11.73-114,31.07-172,41.86A600.21,600.21,0,0,1,0,27.35V120H1200V95.8C1132.19,118.92,1055.71,111.31,985.66,92.83Z"
                    class="shape-fill"></path>
            </svg>
        </div>

    </section>

    <!-- hero section ends -->

    <!-- activities-student section starts -->

    <section class="activities-student" id="informasi-kegiatan">

        <h1 class="heading">kegiatan <span>kami</span></h1>

        <div class="box-container <?= $informasi_kegiatan->num_rows === 1 ? 'single' : '' ?>">

            <?php
            $count_informasi_kegiatan = 0;
            if ($informasi_kegiatan->num_rows > 0) {
                while ($row = $informasi_kegiatan->fetch_assoc()) {
                    if ($count_informasi_kegiatan < 3) {
                        echo '<a href="detail_kegiatan.php?id_kegiatan=' . $row['id_kegiatan'] . '" class="box">
                            <h3>' . $row['nama_kegiatan'] . '</h3>
                            <p>' . $row['deskripsi'] . '</p>
                            <div class="img">
                            <img src="../uploads/' . $row['dokumentasi'] . '" alt="">
                            </div>
                        </a>';
                        $count_informasi_kegiatan++;
                    }
                }
            } else {
                echo '<h3>Belum ada kegiatan</h3>';
            }
            ?>
        </div>

        <div class="btn-wrapper">
            <a href="dashboard/informasi_kegiatan.php" class="btn">Lebih Lengkap</a>
        </div>

    </section>

    <!-- kegiatan section ends -->

    <!-- rapor mingguan section starts -->

    <section class="weekly-report" id="rapor">

        <h1 class="heading">rapor <span>mingguan</span></h1>

        <div class="box-container">

            <div class="box-name">
                <h3><?= $siswa['nama_siswa'] ?></h3>
            </div>

            <div class="box-report">
                <?php
                $count_report = 0;
                if ($nilai->num_rows > 0) {
                    while ($row = $nilai->fetch_assoc()) {
                        if ($count_report < 3) {
                            echo '<div class="report">
                                    <div class="report-title">' . $row['kategori'] . '</div>
                                    <div class="report-description">' . $row['deskripsi'] . '</div>
                                </div>';
                            $count_report++;
                        }
                    }
                } else {
                    echo '<h3>Belum ada rapor</h3>';
                }
                ?>
            </div>

        </div>

        <div class="btn-wrapper">
            <a href="dashboard/nilai.php" class="btn">Lebih Lengkap</a>
        </div>
    </section>

    <!-- contact section ends -->


    <!-- lightgallery cdn js link -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery-js/1.4.0/js/lightgallery.min.js"></script>
    <!-- custom js file link -->
    <script src="../assets/js/script.js"></script>

    <script>
        lightGallery(document.querySelector('.gallery .gallery-container'));
    </script>

</body>

</html>