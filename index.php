<?php
session_start();
include 'conn.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Kindergarten Website</title>
    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- lightgallery css cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightgallery-js/1.4.0/css/lightgallery.min.css">
    <!-- custom css file link  -->
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        .admin-login-form {
            display: none;
            position: absolute;
            top: 50px;
            right: 10px;
            background: white;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            z-index: 100;
        }
        .admin-login-form.active {
            display: block;
        }
        .icons {
            position: relative;
        }
        #admin-login-btn {
            font-size: 1.2em;
            position: absolute;
            top: 0;
            right: 60px;
            cursor: pointer;
        }
    </style>
</head>
<body>

    <!-- header section starts -->

    <header class="header">

        <a href="#" class="logo"> <i class="fas fa-school"></i> TK Dharma Wanita Persatuan</a>

        <nav class="navbar">
            <a href="#home">home</a>
            <a href="#about">about</a>
            <a href="#education">education</a>
            <a href="#teacher">teacher</a>
            <a href="#gallery">gallery</a>
            <a href="#contact">contact</a>
        </nav>

        <div class="icons">
            <div class="fas fa-user" id="login-btn"></div>
            <div class="fas fa-bars" id="menu-btn"></div>
            <div class="fas fa-user-shield" id="admin-login-btn"></div>
        </div>

        <div class="login-form">
            <?php
            if (isset($_SESSION['nisn'])) {
                echo '<a href="siswa/index.php" class="btn">siswa dashboard</a>';
            } else if (isset($_SESSION['nip'])) {
                echo '<a href="guru/dashboard/index.php" class="btn">guru dashboard</a>';
            } else {
                echo '<h3>login sebagai</h3>';
                echo '<a href="siswa/login.php" class="btn">siswa</a>';
                echo '<a href="guru/login.php" class="btn">guru</a>';
            }
            ?>
        </div>

        <div class="admin-login-form" id="admin-login-form">
            <h3>Admin Login</h3>
            <form action="admin_login.php" method="post">
                <input type="text" name="admin_username" placeholder="Username" required>
                <input type="password" name="admin_password" placeholder="Password" required>
                <input type="submit" value="Login" class="btn">
            </form>
        </div>

    </header>

    <!-- header section ends -->

    <!-- home section starts -->

    <section class="home" id="home">

        <div class="content">
            <h3>Selamat datang di <span>TK Dharma Wanita Persatuan</span></h3>
            <p>Desa Medalem, Kecamatan Tulangan, Sidoarjo </p>
        </div>

        <div class="image">
            <img src="assets/images/home.png" alt="">
        </div>

        <div class="custom-shape-divider-bottom-1684324473">
            <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M985.66,92.83C906.67,72,823.78,31,743.84,14.19c-82.26-17.34-168.06-16.33-250.45.39-57.84,11.73-114,31.07-172,41.86A600.21,600.21,0,0,1,0,27.35V120H1200V95.8C1132.19,118.92,1055.71,111.31,985.66,92.83Z" class="shape-fill"></path>
            </svg>
        </div>

    </section>

    <!-- home section ends -->

    <!-- about us section starts -->

    <section class="about" id="about">

        <h1 class="heading"> <span>tentang</span> kami</h1>

        <div class="row">

            <div class="image">
                <img src="assets/images/about us.png" alt="">
            </div>

            <div class="content">
                <h3>Exploring, Growing, And Thriving Together</h3>
                <p style="text-align: justify;"> TK Dharma Wanita Persatuan Desa Medalem, tempat di mana pendidikan dan kepedulian menyatu dalam komunitas yang peduli dan berkualitas. Kami berkomitmen memberikan pendidikan terbaik yang mendorong perkembangan holistik setiap anak. </p>
                <p style="text-align: justify;"> Kami mengembangkan lingkungan belajar yang merangsang kreativitas, kecerdasan, dan karakter kuat, dengan staf pengajar berdedikasi. Kami juga aktif mengadakan kegiatan ekstrakurikuler dan acara komunitas untuk memperluas wawasan dan keterampilan anak-anak dalam berbagai aspek kehidupan. Bersama-sama, mari kita bantu anak-anak mencapai potensi penuh mereka dan siapkan mereka menjadi pemimpin masa depan yang berintegritas.</p>
                <a href="#" class="btn">baca selengkapnya</a>
            </div>
        </div>

    </section>

    <!-- about us section ends -->

    <!-- education section start -->

    <section class="education" id="education">

        <h1 class="heading">pembelajaran <span> kami</span></h1>

        <div class="box-container">

            <div class="box" style="text-align: center;">
                <h3>Membaca</h3>
                <p>Kegiatan membaca di TK Dharma Wanita Persatuan dirancang untuk menumbuhkan kecintaan anak-anak terhadap buku dan literasi sejak dini. Dengan metode yang menyenangkan dan interaktif, kami membantu anak-anak mengembangkan kemampuan membaca yang kuat.</p>
                <img src="assets/images/education1.png" alt="" style="display: block; margin: 0 auto;">
            </div>

            <div class="box"  style="text-align: center;">
                <h3>Keterampilan</h3>
                <p>Program keterampilan kami mencakup berbagai aktivitas yang mengembangkan motorik halus dan kasar anak-anak. Dari seni dan kerajinan hingga permainan konstruktif</p>
                <img src="assets/images/education2.png" alt="" style="display: block; margin: 0 auto;">
            </div>

            <div class="box"  style="text-align: center;">
                <h3>berhitung</h3>
                <p>Kami membantu anak-anak memahami konsep dasar matematika melalui kegiatan berhitung yang menyenangkan dan penuh tantangan. Dengan pendekatan yang sesuai usia, anak-anak belajar berhitung, mengenal angka, dan mengembangkan kemampuan logika mereka.</p>
                <img src="assets/images/education3.png" alt="" style="display: block; margin: 0 auto;">
            </div>

        </div>

    </section>

    <!-- education section ends -->

    <!-- teacher section starts -->

    <section class="teacher" id="teacher">

        <h1 class="heading">guru <span> kami</span></h1>

        <div class="box-container">

            <div class="box">
                <img src="assets/images/teacher1.png" alt="">
                <h3>Heny Kurniawati</h3>
                <p>guru</p>
                <div class="share">
                    <i class="fab fa-facebook-f"></i>
                    <i class="fab fa-twitter"></i>
                    <i class="fab fa-instagram"></i>
                </div>
            </div>

            <div class="box">
                <img src="assets/images/teacher2.png" alt="">
                <h3>Evi Yuliani S.Pd.AUD</h3>
                <p>kepala sekolah</p>
                <div class="share">
                    <i class="fab fa-facebook-f"></i>
                    <i class="fab fa-twitter"></i>
                    <i class="fab fa-instagram"></i>
                </div>
            </div>

            <div class="box">
                <img src="assets/images/teacher3.png" alt="">
                <h3>Nur Lailatul Khoiriyah</h3>
                <p>guru</p>
                <div class="share">
                    <i class="fab fa-facebook-f"></i>
                    <i class="fab fa-twitter"></i>
                    <i class="fab fa-instagram"></i>
                </div>
            </div>

        </div>

    </section>

    <!-- teacher section ends -->

    <!-- gallery section starts -->

    <section class="gallery" id="gallery">

        <h1 class="heading">kegiatan <span>kami</span></h1>

        <div class="gallery-container">

            <a href="assets/images/image1.jpg" class="box">
                <img src="assets/images/image1.jpg" alt="">
                <div class="icon"> <i class
                class="fas fa-plus"></i></div>
                </a>
                <a href="assets/images/image2.jpg" class="box">
            <img src="assets/images/image2.jpg" alt="">
            <div class="icon"> <i class="fas fa-plus"></i></div>
        </a>

        <a href="assets/images/image3.jpg" class="box">
            <img src="assets/images/image3.jpg" alt="">
            <div class="icon"> <i class="fas fa-plus"></i></div>
        </a>

        <a href="assets/images/image4.jpg" class="box">
            <img src="assets/images/image4.jpg" alt="">
            <div class="icon"> <i class="fas fa-plus"></i></div>
        </a>

    </div>

</section>

<!-- gallery section ends -->

<!-- contact section starts -->

<section class="contact" id="contact">

    <h1 class="heading"> <span>kontak</span> kami</h1>

    <div class="row">

        <iframe class="map" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15866.9680550873!2d106.8259831!3d-6.1753926!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2ddfa93b52922a7d%3A0x6f2b0bde160d9da4!2sNational%20Monument!5e0!3m2!1sen!2sid!4v1602082736259!5m2!1sen!2sid" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>

        <form action="">
            <h3>get in touch</h3>
            <input type="text" placeholder="your name" class="box">
            <input type="email" placeholder="your email" class="box">
            <input type="number" placeholder="your number" class="box">
            <textarea name="" placeholder="your message" id="" cols="30" rows="10"></textarea>
            <input type="submit" value="send message" class="btn">
        </form>

    </div>

</section>

<!-- contact section ends -->

<!-- footer section starts -->

<section class="footer">

    <div class="box-container">

        <div class="box">
            <h3>TK Dharma Wanita Persatuan</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae et earum quaerat quis aliquam maiores distinctio libero non quisquam voluptas! Quo recusandae architecto consequatur aut consequuntur officia, nulla, hic voluptas!</p>
        </div>

        <div class="box">
            <h3>quick links</h3>
            <a href="#"> <i class="fas fa-arrow-right"></i> home </a>
            <a href="#"> <i class="fas fa-arrow-right"></i> about </a>
            <a href="#"> <i class="fas fa-arrow-right"></i> education </a>
            <a href="#"> <i class="fas fa-arrow-right"></i> teacher </a>
            <a href="#"> <i class="fas fa-arrow-right"></i> gallery </a>
            <a href="#"> <i class="fas fa-arrow-right"></i> contact </a>
        </div>

        <div class="box">
            <h3>follow us</h3>
            <a href="#"> <i class="fab fa-facebook-f"></i> facebook </a>
            <a href="#"> <i class="fab fa-twitter"></i> twitter </a>
            <a href="#"> <i class="fab fa-instagram"></i> instagram </a>
            <a href="#"> <i class="fab fa-linkedin"></i> linkedin </a>
            <a href="#"> <i class="fab fa-pinterest"></i> pinterest </a>
        </div>

    </div>

    <h1 class="credit"> created by <span>mr. web designer</span> | all rights reserved. </h1>

</section>

<!-- footer section ends -->

<!-- custom js file link  -->
<script src="assets/js/script.js"></script>
<script>
    // Menangani klik pada tombol admin login
    document.querySelector('#admin-login-btn').onclick = function() {
        window.location.href = 'admin/admin_login.php';
    };
</script>
</body>
</html>
```