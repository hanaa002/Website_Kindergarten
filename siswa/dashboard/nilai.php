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

$siswa_id = $siswa['id_siswa'];
$nilai_query = "SELECT nilai.*, siswa.nama_siswa FROM nilai INNER JOIN siswa ON nilai.id_siswa = siswa.id_siswa WHERE nilai.id_siswa = '$siswa_id'";
$nilai = $conn->query($nilai_query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Siswa - Nilai</title>
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
            <a href="index.php" class="">
                <i class="fas fa-user"></i>
            </a>
        </div>
        <div class="link">
            <a href="#" class="active">
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
                <h1>Nilai Evaluasi Mingguan</h1>
            </div>


            <div class="box-detail">
                <?php
                if ($nilai->num_rows > 0):
                    while ($row = $nilai->fetch_assoc()):
                        ?>
                        <div class="report">
                            <div class="report-date"><?= $row['tgl_input'] ?></div>
                            <div class="report-detail">
                                <ul>
                                    <li>
                                        Nilai: <?= $row['nilai'] ?>
                                    </li>
                                    <li>
                                        Kategori: <?= $row['kategori'] ?>
                                    </li>
                                    <li>
                                        Deskripsi: <?= $row['deskripsi'] ?>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <?php
                    endwhile;
                else:
                    ?>
                    <h3>Belum ada nilai</h3>
                    <?php
                endif;
                ?>
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