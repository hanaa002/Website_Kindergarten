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

if (isset($_GET['id_kegiatan'])) {
    $id_kegiatan = $_GET['id_kegiatan'];
    $informasi_kegiatan_query = "SELECT * FROM informasi_kegiatan WHERE id_kegiatan = '$id_kegiatan'";
    $informasi_kegiatan_result = $conn->query($informasi_kegiatan_query);
    $informasi_kegiatan_data = $informasi_kegiatan_result->fetch_assoc();
    if (!$informasi_kegiatan_data) {
        echo "<script>
                alert('Data tidak ditemukan!');
                window.location.href = 'informasi_kegiatan.php';
              </script>";
        exit;
    }
}

if (isset($_POST['nama_kegiatan'])) {
    $nama_kegiatan = $_POST['nama_kegiatan'];
    $deskripsi = $_POST['deskripsi'];
    $tgl_kegiatan = $_POST['tgl_kegiatan'];

    $dokumentasi = $_FILES['dokumentasi'];
    $dokumentasi_name = $dokumentasi['name'];
    $dokumentasi_tmp = $dokumentasi['tmp_name'];
    $dokumentasi_size = $dokumentasi['size'];
    $dokumentasi_error = $dokumentasi['error'];

    if ($dokumentasi_error === 0 && $dokumentasi != '') {
        $dokumentasi_path = '../../uploads/' . $dokumentasi_name;
        move_uploaded_file($dokumentasi_tmp, $dokumentasi_path);
        
        if (isset($informasi_kegiatan_data) && $informasi_kegiatan_data['dokumentasi'] != '') {
            $old_dokumentasi_path = '../../uploads/' . $informasi_kegiatan_data['dokumentasi'];
            if (file_exists($old_dokumentasi_path)) {
                unlink($old_dokumentasi_path);
            }
        }
    } else {
        $dokumentasi_name = isset($informasi_kegiatan_data) ? $informasi_kegiatan_data['dokumentasi'] : '';
    }
    $query = "UPDATE informasi_kegiatan SET nama_kegiatan = '$nama_kegiatan', deskripsi = '$deskripsi', dokumentasi = '$dokumentasi_name', tgl_kegiatan = '$tgl_kegiatan' WHERE id_kegiatan = '$id_kegiatan'";

    if ($conn->query($query) === TRUE) {
        echo "<script>
                alert('Data berhasil disimpan!');
                window.location.href = 'informasi_kegiatan.php';
              </script>";
    } else {
        echo "<script>
                alert('Error: " . $conn->error . "');
                window.location.href = 'informasi_kegiatan.php';
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
    <title>Guru - Edit Informasi Kegiatan</title>
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
            <a href="barang_bawaan.php" class="">
                <i class="fas fa-box"></i>
            </a>
        </div>
        <div class="link">
            <a href="informasi_kegiatan.php" class="active">
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
                <h1>Edit Informasi Kegiatan</h1>
            </div>

            <div class="box-detail">
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="nama_kegiatan">Nama Kegiatan</label>
                        <input type="text" name="nama_kegiatan" id="nama_kegiatan" value="<?= isset($informasi_kegiatan_data) ? $informasi_kegiatan_data['nama_kegiatan'] : '' ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <input type="text" name="deskripsi" id="deskripsi" value="<?= isset($informasi_kegiatan_data) ? $informasi_kegiatan_data['deskripsi'] : '' ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="dokumentasi">Dokumentasi</label>
                        <input type="file" name="dokumentasi" id="dokumentasi">
                    </div>
                    <div class="form-group">
                        <label for="tgl_kegiatan">Tanggal Kegiatan</label>
                        <input type="date" name="tgl_kegiatan" id="tgl_kegiatan" value="<?= isset($informasi_kegiatan_data) ? $informasi_kegiatan_data['tgl_kegiatan'] : '' ?>" required>
                    </div>
                    <button type="submit" class="btn">Simpan</button>
                    <a href="informasi_kegiatan.php" class="btn">Kembali</a>
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