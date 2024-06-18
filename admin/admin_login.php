<?php
session_start();
include '../conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['admin_username'];
    $password = $_POST['admin_password'];

    // Debugging: cek nilai variabel
    echo "Username: " . $username . "<br>";
    echo "Password: " . $password . "<br>";

    $sql = "SELECT * FROM admin WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $admin = $result->fetch_assoc();
        // Debugging: cek apakah query menghasilkan admin yang benar
        var_dump($admin);

        if ($password === $admin['password']) { // Assuming password is stored in plain text for demo purpose
            $_SESSION['admin_username'] = $username;
            header('Location: index.php');
            exit; // tambahkan exit untuk menghentikan eksekusi lebih lanjut
        } else {
            echo "<script>alert('Password salah')</script>";
        }
    } else {
        echo "<script>alert('Username tidak ditemukan')</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login Admin</title>
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
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="form">
                    <input type="text" id="admin_username" name="admin_username" placeholder="Masukkan Username" />
                    <input type="password" id="admin_password" name="admin_password" placeholder="Masukkan password" />
                    <button type="submit" class="btn-login">Login</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
