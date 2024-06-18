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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Siswa</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        body {
            font-size: 2rem;
        }

        .admin-content {
            margin-left: 100px;
            padding: 20px;
        }

        .admin-content .box-container {
            background-color: var(--orange);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .admin-content .box-container .title h1 {
            font-size: 2rem;
            color: var(--black);
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            font-size: 1.2rem;
            color: var(--black);
            display: block;
            margin-bottom: 5px;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 10px;
            font-size: 1rem;
            border: 1px solid rgba(0, 0, 0, .3);
            border-radius: 5px;
        }

        .form-group input::placeholder {
            color: rgba(0, 0, 0, .5);
        }

        .form-group select {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background: transparent;
            background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="12" height="8" viewBox="0 0 12 8"><path fill="%23000" fill-rule="evenodd" d="M1.502 0L0 1.503l6 6.002 6-6.002L10.497 0l-5.997 6z"/></svg>');
            background-repeat: no-repeat;
            background-position-x: calc(100% - 10px);
            background-position-y: center;
        }

        .form-group textarea {
            width: 100%;
            padding: 10px;
            font-size: 1rem;
            border: 1px solid rgba(0, 0, 0, .3);
            border-radius: 5px;
            resize: vertical;
        }

        .form-group button {
            padding: 10px 20px;
            background-color: var(--orange);
            color: var(--pink);
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
        }

        .form-group button:hover {
            background-color: var(--pink);
            color: var(--orange);
        }

        .popup {
            display: none;
            position: fixed;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            animation: fadeIn 0.5s, fadeOut 0.5s 2.5s;
        }

        .popup.success {
            border-left: 5px solid green;
        }

        .popup.error {
            border-left: 5px solid red;
        }

        .popup .close-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            cursor: pointer;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes fadeOut {
            from {
                opacity: 1;
            }

            to {
                opacity: 0;
            }
        }
    </style>
</head>

<body>
    <?php
    require_once 'sidebar.html';
    ?>

    <!-- Content -->

    <div class="admin-content">
        <section id="informasi-kegiatan">
            <div>
                <p style="font-size: 24px; margin-bottom: 15px;"><b>Input Siswa Baru</b></p>
            </div>
            <div class="box-container">
                <!-- Popup Message -->
                <div id="popup" class="popup">
                    <span class="close-btn" onclick="document.getElementById('popup').style.display='none'">&times;</span>
                    <span id="popup-message"></span>
                </div>

                <!-- Form for Adding Siswa -->
                <div class="box-detail">
                    <form action="tambah_siswa.php" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="nisn">NISN:</label>
                            <input type="text" id="nisn" name="nisn" required>
                        </div>

                        <div class="form-group">
                            <label for="nama">Nama Siswa:</label>
                            <input type="text" id="nama" name="nama_siswa" required>
                        </div>

                        <div class="form-group">
                            <label for="nama">Alamat Siswa:</label>
                            <input type="text" id="nama" name="alamat_siswa" required>
                        </div>

                        <div class="form-group">
                            <label for="jenis_kelamin">Jenis Kelamin:</label>
                            <select id="jenis_kelamin" name="jenis_kelamin" required style="background-color: white;">
                                <option value="" selected disabled hidden>Pilih</option>
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="password_siswa">Password:</label>
                            <input type="password" id="password_siswa" name="password_siswa" required>
                        </div>

                        <div class="form-group">
                            <label for="tinggi_badan">Tinggi Badan:</label>
                            <input type="number" id="tinggi_badan" name="tinggi_badan" required>
                        </div>

                        <div class="form-group">
                            <label for="berat_badan">Berat Badan:</label>
                            <input type="number" id="berat_badan" name="berat_badan" required>
                        </div>

                        <div class="form-group">
                            <label for="nama_ortu">Nama Orang Tua:</label>
                            <input type="text" id="nama_ortu" name="nama_ortu" required>
                        </div>
                        <div class="form-group">
                            <label for="notelp_ortu">No Telp Orang Tua:</label>
                            <input type="text" id="notelp_ortu" name="notelp_ortu" required>
                        </div>
                        <div class="form-group">
                            <label for="foto">Foto:</label>
                            <input type="file" id="foto" name="foto" accept="image/*">
                        </div>

                        <button type="submit" style=" background-color: var(--pink); color:white; padding:20px; float:right;">Submit</button>
                    </form>
                </div>
            </div>
        </section>
    </div>
    <!-- Custom JavaScript or additional scripts -->
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
            var popup = document.getElementById('popup');
            var popupMessage = document.getElementById('popup-message');
            popup.className = 'popup ' + type;
            popupMessage.textContent = message;
            popup.style.display = 'block';
            setTimeout(function() {
                popup.style.display = 'none';
            }, 3000);
        }
    </script>
</body>

</html>