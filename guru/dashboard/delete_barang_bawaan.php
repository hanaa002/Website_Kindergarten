<?php
session_start();
include '../conn.php';
if (!isset($_SESSION['nip'])) {
    header('Location: login.php');
}

$nip = $_SESSION['nip'];
$query = "SELECT * FROM guru WHERE nip = '$nip'";
$result = $conn->query($query);
$guru = $result->fetch_assoc();

if (!$guru) {
    session_destroy();
    header('Location: ../login.php');
}

if (isset($_GET['id_barang'])) {
    $id_barang = $_GET['id_barang'];
    $query = "DELETE FROM barang_bawaan WHERE id_barang = '$id_barang'";
    if ($conn->query($query) === TRUE) {
        echo "<script>
                alert('Data berhasil dihapus!');
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
