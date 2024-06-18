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
    $query = "DELETE FROM informasi_kegiatan WHERE id_kegiatan = '$id_kegiatan'";
    if ($conn->query($query) === TRUE) {
        echo "<script>
                alert('Data berhasil dihapus!');
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