<?php
session_start();
include '../conn.php';
if (isset($_SESSION['nip'])) {
    header('Location: dashboard/index.php');
}

if (isset($_POST['nip'])) {
    $nip = $_POST['nip'];
    $password_guru = $_POST['password_guru'];

    $query = "SELECT * FROM guru WHERE nip = '$nip'";
    $result = $conn->query($query);
    $siswa = $result->fetch_assoc();

    if ($siswa) {
        if (password_verify($password_guru, $siswa['password_guru'])) {
            $_SESSION['nip'] = $nip;
            header('Location: dashboard/index.php');
        } else {
            echo "<script>alert('Password salah')</script>";
        }
    } else {
        echo "<script>alert('NIP tidak ditemukan')</script>";
    }

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login Guru</title>
    <link rel="stylesheet" href="../assets/css/style.css" />
</head>

<body>
    <div class="login">
        <div class="image">
            <div class="cover"></div>
            <img src="../assets/images/login.jpeg" alt="" srcset="" />
        </div>
        <div class="container">
            <div class="login-form">
                <img src="../assets/images/user.png" alt="" srcset="" />
                <h1>Hi, Selamat Datang!</h1>
                <form action="" method="POST" class="form">
                    <input type="text" id="nip" name="nip" placeholder="Masukkan NIP" />
                    <input type="password" id="password" name="password_guru" placeholder="Masukkan password" />
                    <button type="submit" class="btn-login">Login</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>