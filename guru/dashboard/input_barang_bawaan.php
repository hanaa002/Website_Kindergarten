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

if (isset($_POST['nama_barang'])) {
    $nama_barang = $_POST['nama_barang'];
    $info_kegiatan = $_POST['info_kegiatan'];
    $tgl_bawa = $_POST['tgl_bawa'];

    $query = "INSERT INTO barang_bawaan (nama_barang, info_kegiatan, tgl_bawa) VALUES ('$nama_barang', '$info_kegiatan', '$tgl_bawa')";

    if ($conn->query($query) === TRUE) {
        echo "<script>
                alert('Data berhasil disimpan!');
                window.location.href = 'barang_bawaan.php';
              </script>";
    } else {
        echo "<script>
                alert('Error: " . $conn->error . "');
                window.location.href = 'barang_bawaan.php';
              </script>";
    }
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guru - Input Barang Bawaan</title>
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
            <a href="barang_bawaan.php" class="active">
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
                <h1>Input Barang Bawaan</h1>
            </div>

            <div class="box-detail">
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="nama_barang">Nama Barang</label>
                        <input type="text" name="nama_barang" id="nama_barang" required>
                    </div>
                    <div class="form-group">
                        <label for="info_kegiatan">Info Kegiatan</label>
                        <input type="text" name="info_kegiatan" id="info_kegiatan" required>
                    </div>
                    <div class="form-group">
                        <label for="tgl_bawa">Tanggal Bawa</label>
                        <input type="date" name="tgl_bawa" id="tgl_bawa" required>
                    </div>
                    <button type="submit" class="btn">Submit</button>
                    <a href="barang_bawaan.php" class="btn">Kembali</a>
                </form>
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