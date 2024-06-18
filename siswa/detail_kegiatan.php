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

if (isset($_GET['id_kegiatan'])) {
    $id_kegiatan = $_GET['id_kegiatan'];
    $kegiatan_query = "SELECT * FROM informasi_kegiatan WHERE id_kegiatan = $id_kegiatan";
    $kegiatan = $conn->query($kegiatan_query);
    $kegiatan = $kegiatan->fetch_assoc();
} else {
    header('Location: index.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Siswa - Infromasi Kegiatan</title>
    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- lightgallery css cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightgallery-js/1.4.0/css/lightgallery.min.css">
    <!-- custom css file link  -->
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
    <div class="detail-kegiatan">
        <div class="container">
            <div class="title">
                <h1><?= $kegiatan['nama_kegiatan'] ?></h1>
                <a href="index.php" class="back"><i class="fas fa-arrow-left"></i></a>
            </div>
            <div class="image">
                <img src="../uploads/<?= $kegiatan['dokumentasi'] ?>" alt="<?= $kegiatan['nama_kegiatan'] ?>">
            </div>
            <div class="description">
                <p><?= $kegiatan['deskripsi'] ?></p>
                <div class="date">
                    <p><?= $kegiatan['tgl_kegiatan'] ?></p>
                </div>
            </div>
        </div>
    </div>

    <!-- lightgallery cdn js link -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery-js/1.4.0/js/lightgallery.min.js"></script>
    <!-- custom js file link -->
    <script src="../assets/js/script.js"></script>

    <script>
        lightGallery(document.querySelector('.gallery .gallery-container'));
    </script>

</body>

</html>