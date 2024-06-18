<?php
session_start();
include '../conn.php';
if (isset($_SESSION['nisn'])) {
    header('Location: index.php');
}

if (isset($_POST['nisn'])) {
    $nisn = $_POST['nisn'];
    $password_siswa = $_POST['password_siswa'];

    $query = "SELECT * FROM siswa WHERE nisn = '$nisn'";
    $result = $conn->query($query);
    $siswa = $result->fetch_assoc();

    if ($siswa) {
        if (password_verify($password_siswa, $siswa['password_siswa'])) {
            $_SESSION['nisn'] = $nisn;
            header('Location: index.php');
        } else {
            echo "<script>alert('Password salah')</script>";
        }
    } else {
        echo "<script>alert('NISN tidak ditemukan')</script>";
    }

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login Siswa</title>
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
                    <input type="text" id="nisn" name="nisn" placeholder="Masukkan NISN" />
                    <input type="password" id="password" name="password_siswa" placeholder="Masukkan password" />
                    <button type="submit" class="btn-login">Login</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>