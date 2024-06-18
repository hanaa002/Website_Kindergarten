<?php
session_start();
include '../conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $nisn = $_POST['nisn'];
    $nama_siswa = $_POST['nama_siswa'];
    $alamat_siswa = $_POST['alamat_siswa'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $password_siswa = password_hash($_POST['password_siswa'], PASSWORD_DEFAULT); // Hash password
    $tinggi_badan = $_POST['tinggi_badan'];
    $berat_badan = $_POST['berat_badan'];
    $nama_ortu = $_POST['nama_ortu'];
    $notelp_ortu = $_POST['notelp_ortu'];
    $foto = null;

    // Handle file upload
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $target_dir = "../uploads/";
        $foto = basename($_FILES['foto']['name']);
        $target_file = $target_dir . $foto;

        // Pastikan direktori uploads sudah ada
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0755, true);
        }

        if (!move_uploaded_file($_FILES['foto']['tmp_name'], $target_file)) {
            $_SESSION['error_message'] = "Gagal mengunggah foto.";
            header('Location: tambah_siswa.php');
            exit();
        }
    } else if (isset($_FILES['foto']) && $_FILES['foto']['error'] !== UPLOAD_ERR_NO_FILE) {
        $_SESSION['error_message'] = "Error saat mengunggah file: " . $_FILES['foto']['error'];
        header('Location: tambah_siswa.php');
        exit();
    }

    // Simpan data ke database
    $query = "INSERT INTO siswa (nisn, nama_siswa, alamat_siswa, jenis_kelamin, password_siswa, tinggi_badan, berat_badan, nama_ortu, notelp_ortu, foto)
              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($query);
    if ($stmt === false) {
        $_SESSION['error_message'] = "Gagal menyiapkan statement: " . $conn->error;
        header('Location: tambah_siswa.php');
        exit();
    }

    $stmt->bind_param('sssssiisss', $nisn, $nama_siswa, $alamat_siswa, $jenis_kelamin, $password_siswa, $tinggi_badan, $berat_badan, $nama_ortu, $notelp_ortu, $foto);

    if ($stmt->execute()) {
        $_SESSION['success_message'] = "Data siswa berhasil ditambahkan.";
    } else {
        $_SESSION['error_message'] = "Gagal menambahkan data siswa: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();

    header('Location: tambah_siswa.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Siswa</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
    <?php
    require_once 'sidebar.html';
    ?>

    <!-- Content -->
    <div class="teacher-content">
        <section id="tambah-murid">
            <div class="box-container">
                <div class="title">
                    <h1>Tambah Siswa</h1>
                </div>
                <div class="box-detail">
                    <h2>Input Siswa Baru</h2>
                    <form action="tambah_siswa.php" method="POST" enctype="multipart/form-data">
                        <label for="nisn">NISN:</label><br>
                        <input type="text" id="nisn" name="nisn" required><br><br>

                        <label for="nama_siswa">Nama Siswa:</label><br>
                        <input type="text" id="nama_siswa" name="nama_siswa" required><br><br>

                        <label for="alamat_siswa">Alamat Siswa:</label><br>
                        <input type="text" id="alamat_siswa" name="alamat_siswa" required><br><br>

                        <label for="jenis_kelamin">Jenis Kelamin:</label><br>
                        <select id="jenis_kelamin" name="jenis_kelamin" required>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select><br><br>

                        <label for="password_siswa">Password:</label><br>
                        <input type="password" id="password_siswa" name="password_siswa" required><br><br>

                        <label for="tinggi_badan">Tinggi Badan:</label><br>
                        <input type="number" id="tinggi_badan" name="tinggi_badan" required><br><br>

                        <label for="berat_badan">Berat Badan:</label><br>
                        <input type="number" id="berat_badan" name="berat_badan" required><br><br>

                        <label for="nama_ortu">Nama Orang Tua:</label><br>
                        <input type="text" id="nama_ortu" name="nama_ortu" required><br><br>

                        <label for="notelp_ortu">No Telp Orang Tua:</label><br>
                        <input type="text" id="notelp_ortu" name="notelp_ortu" required><br><br>

                        <label for="foto">Foto:</label><br>
                        <input type="file" id="foto" name="foto" accept="image/*"><br><br>

                        <button type="submit">Submit</button>
                    </form>
                </div>
            </div>
        </section>
    </div>

    <script src="../assets/js/script.js"></script>
    <script>
        window.onload = function() {
            var successMessage = "<?php echo isset($_SESSION['success_message']) ? $_SESSION['success_message'] : ''; ?>";
            var errorMessage = "<?php echo isset($_SESSION['error_message']) ? $_SESSION['error_message'] : ''; ?>";

            if (successMessage) {
                showPopup(successMessage, 'success');
                <?php unset($_SESSION['success_message']); ?>
            }

            if (errorMessage) {
                showPopup(errorMessage, 'error');
                <?php unset($_SESSION['error_message']); ?>
            }
        };

        function showPopup(message, type) {
            var popup = document.createElement('div');
            var popupMessage = document.createElement('span');
            popupMessage.textContent = message;
            popup.className = 'popup ' + type;
            popup.appendChild(popupMessage);
            document.body.appendChild(popup);
            setTimeout(function() {
                popup.style.display = 'none';
            }, 3000);
        }
    </script>
</body>

</html>