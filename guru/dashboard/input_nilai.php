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

$siswa = $conn->query("SELECT * FROM siswa");

if (!$guru) {
    session_destroy();
    header('Location: ../login.php');
}

if (isset($_POST['id_siswa'])) {
    $id_siswa = $_POST['id_siswa'];
    $nilai = $_POST['nilai'];
    $kategori = $_POST['kategori'];
    $deskripsi = $_POST['deskripsi'];
    $tgl_input = $_POST['tgl_input'];

    $query = "INSERT INTO nilai (id_siswa, nilai, kategori, deskripsi, tgl_input) VALUES ('$id_siswa', '$nilai', '$kategori', '$deskripsi', '$tgl_input')";
    if ($conn->query($query) === TRUE) {
        echo "<script>
                alert('Nilai berhasil diinput!');
                window.location.href = 'nilai.php';
              </script>";
    } else {
        echo "<script>
                alert('Error: " . $conn->error . "');
                window.location.href = 'nilai.php';
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
    <title>Guru - Input Nilai</title>
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
            <a href="nilai.php" class="active">
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
                <h1>Input Nilai</h1>
            </div>

            <div class="box-detail">
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="id_siswa">Nama Siswa</label>
                        <select name="id_siswa" id="id_siswa">
                            <?php while ($row = $siswa->fetch_assoc()): ?>
                                <option value="<?= $row['id_siswa'] ?>"><?= $row['nama_siswa'] ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nilai">Nilai</label>
                        <input type="text" name="nilai" id="nilai" placeholder="Masukkan nilai">
                    </div>
                    <div class="form-group">
                        <label for="kategori">Kategori</label>
                        <input type="text" name="kategori" id="kategori" placeholder="Masukkan kategori">
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea name="deskripsi" id="deskripsi" cols="30" rows="10"
                            placeholder="Masukkan deskripsi"></textarea>
                    </div>
                     <div class="form-group">
                        <label for="tgl_input">Tanggal Input</label>
                        <input type="date" name="tgl_input" id="tgl_input" value="<?= date('Y-m-d')?>" required>
                    </div>
                    <button type="submit" class="btn">Submit</button>
                    <a href="nilai.php" class="btn">Kembali</a>
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