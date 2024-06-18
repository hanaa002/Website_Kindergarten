<?php
session_start();
include '../../conn.php';

if (!isset($_SESSION['nip'])) {
    header('Location: ../login.php');
    exit();
}

$nip = $_SESSION['nip'];

$query = "SELECT * FROM guru WHERE nip = '$nip'";
$result = $conn->query($query);
$guru = $result->fetch_assoc();

if (!$guru) {
    session_destroy();
    header('Location: ../login.php');
    exit();
}

$nilai_query = "SELECT nilai.*, siswa.nama_siswa FROM nilai INNER JOIN siswa ON nilai.id_siswa = siswa.id_siswa";
$nilai = $conn->query($nilai_query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guru - Nilai</title>
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

    <div class="teacher-content">
        <div class="box-container">
            <div class="title">
                <h1>Nilai Evaluasi Mingguan</h1>
                <a href="input_nilai.php" class="btn">
                    <i class="fas fa-plus"></i>
                    <span>Input Nilai</span>
                </a>
            </div>

            <div class="box-detail">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Siswa</th>
                            <th>Nilai</th>
                            <th>Kategori</th>
                            <th>Deskripsi</th>
                            <th>Tanggal Input</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($nilai->num_rows > 0): ?>
                            <?php $no = 1; while ($row = $nilai->fetch_assoc()): ?>
                                <tr>
                                    <td><?= htmlspecialchars($no++) ?></td>
                                    <td><?= htmlspecialchars($row['nama_siswa']) ?></td>
                                    <td><?= htmlspecialchars($row['nilai']) ?></td>
                                    <td><?= htmlspecialchars($row['kategori']) ?></td>
                                    <td><?= htmlspecialchars($row['deskripsi']) ?></td>
                                    <td><?= htmlspecialchars($row['tgl_input']) ?></td>
                                    <td>
                                        <a href="edit_nilai.php?id_nilai=<?= htmlspecialchars($row['id_nilai']) ?>" class="btn-edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="delete_nilai.php?id_nilai=<?= htmlspecialchars($row['id_nilai']) ?>" class="btn-delete"
                                            onclick="return confirm('Yakin hapus data ini?')">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7">
                                    <center>Data tidak ditemukan</center>
                                </td>
                            </tr>
                        <?php endif; ?>
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
