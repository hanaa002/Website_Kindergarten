<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monitor Kegiatan & Barang Bawaan</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        body {
            font-size: 2rem;
        }

        .content {
            margin-left: 200px;
            padding-top: 20px;
            /* background-color: red; */
        }

        .box-containers {
            padding: 10px;
            background-color: orange;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 10px;
            font-size: 1.6rem;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .form-group input[type="file"] {
            padding: 6px 0;
        }

        button[type="submit"] {
            background-color: green;
            color: white;
            padding: 20px;
            float: right;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <?php require_once 'sidebar.html'; ?>
    <div class="content">
        <div class="admin-contents">
            <section id="informasi-kegiatan">
                <div>
                    <p style="font-size: 24px; margin-bottom: 15px;"><b><?= ucwords('input siswa baru') ?></b></p>
                </div>
                <div class="box-containers">
                    <div class="box-detail">
                        <form action="tambah_guru.php" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="nip">NISN:</label>
                                <input type="text" id="nip" name="nip" required>
                            </div>

                            <div class="form-group">
                                <label for="nama_siswa">Nama Siswa:</label>
                                <input type="text" id="nama_siswa" name="nama_siswa" required>
                            </div>

                            <div class="form-group">
                                <label for="jenis_kelamin">Jenis Kelamin:</label>
                                <select id="jenis_kelamin" name="jenis_kelamin" required>
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

                            <button type="submit">Submit</button>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>

</body>

</html>