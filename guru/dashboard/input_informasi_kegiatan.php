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

if (isset($_POST['nama_kegiatan'])) {
    $nama_kegiatan = $_POST['nama_kegiatan'];
    $deskripsi = $_POST['deskripsi'];
    $tgl_kegiatan = $_POST['tgl_kegiatan'];
    $dokumentasi = $_FILES['dokumentasi'];

    $dokumentasi_name = $dokumentasi['name'];
    $dokumentasi_tmp = $dokumentasi['tmp_name'];
    $dokumentasi_size = $dokumentasi['size'];
    $dokumentasi_error = $dokumentasi['error'];

    $dokumentasi_ext = explode('.', $dokumentasi_name);
    $dokumentasi_actual_ext = strtolower(end($dokumentasi_ext));

    $allowed = array('jpg', 'jpeg', 'png');

    if (in_array($dokumentasi_actual_ext, $allowed)) {
        if ($dokumentasi_error === 0) {
            if ($dokumentasi_size < 1000000) {
                $dokumentasi_destination = '../../uploads/' . $dokumentasi_name;
                move_uploaded_file($dokumentasi_tmp, $dokumentasi_destination);

                $query = "INSERT INTO informasi_kegiatan (nama_kegiatan, deskripsi, dokumentasi, tgl_kegiatan) VALUES ('$nama_kegiatan', '$deskripsi', '$dokumentasi_name', '$tgl_kegiatan')";

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
            } else {
                echo "<script>
                        alert('Ukuran file terlalu besar!');
                        window.location.href = 'input_informasi_kegiatan.php';
                      </script>";
                exit;
            }
        } else {
            echo "<script>
                    alert('Error saat upload file!');
                    window.location.href = 'input_informasi_kegiatan.php';
                  </script>";
            exit;
        }
    } else {
        echo "<script>
                alert('File yang diupload bukan gambar!');
                window.location.href = 'input_informasi_kegiatan.php';
              </script>";
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guru - Input Kegiatan</title>
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
                <h1>Input Kegiatan</h1>
            </div>

            <div class="box-detail">
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="nama_kegiatan">Nama Kegiatan</label>
                        <input type="text" name="nama_kegiatan" id="nama_kegiatan" required>
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <input type="text" name="deskripsi" id="deskripsi" required>
                    </div>
                    <div class="form-group">
                        <label for="dokumentasi">Foto</label>
                        <input type="file" name="dokumentasi" id="dokumentasi" required>
                    </div>
                    <div class="form-group">
                        <label for="tgl_kegiatan">Tanggal Kegiatan</label>
                        <input type="date" name="tgl_kegiatan" id="tgl_kegiatan" required>
                    </div>
                    <button type="submit" class="btn">Submit</button>
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