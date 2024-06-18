<?php
// Sertakan file koneksi
include('../conn.php');

// Ambil data siswa
$sql = "SELECT * FROM siswa";
$result = $conn->query($sql);

// Ambil data jenis kelamin dan ID siswa
$jenis_kelamin_count = [
    'L' => 0,
    'P' => 0
];
$id_siswa_data = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        if (isset($jenis_kelamin_count[$row["jenis_kelamin"]])) {
            $jenis_kelamin_count[$row["jenis_kelamin"]]++;
        }
        $id_siswa_data[] = $row["id_siswa"];
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Siswa</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-size: 1rem; /* Adjusted to a more standard size */
        }

        table {
            width: 1200px;
            border-collapse: collapse;
            font-size: 1rem;
            text-align: left;
            border-radius: 10px;
            overflow: hidden;
        }

        th, td {
            padding: 12px 15px;
            font-size: 13px;
        }

        th {
            background-color: var(--pink);
            color: #ffffff;
        }

        tr {
            border-bottom: 1px solid #dddddd;
        }

        tr {
            background-color: var(--orange);
        }

        tr:last-of-type {
            border-bottom: 2px solid var(--pink);
        }

        img {
            border-radius: 50%;
            width: 50px;
            height: 50px;
            object-fit: cover;
        }

        .chart-container {
            width: 70%; /* Adjust width as needed */
            margin: auto;
        }
    </style>
</head>

<body>
    <?php
    require_once 'sidebar.html';
    ?>

    <!-- Main Content -->
    <div class="main-content" style="margin-left:150px; padding-top:30px;">
        <h1>Data Siswa</h1>
        <table border="1" cellpadding="10" cellspacing="0" style="margin-top:20px; border-radius: 10">
            <tr style="background-color: var(--pink);">
                <th>ID Siswa</th>
                <th>NISN</th>
                <th>Nama Siswa</th>
                <th>Alamat Siswa</th>
                <th>Jenis Kelamin</th>
                <th>Tinggi Badan</th>
                <th>Berat Badan</th>
                <th>Nama Ortu</th>
                <th>No Telp Ortu</th>
                <th>Foto</th>
            </tr>
            <?php
            if ($result->num_rows > 0) {
                // Output data dari setiap baris
                $result->data_seek(0); // Reset pointer result set
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id_siswa"] . ".</td>";
                    echo "<td>" . $row["nisn"] . "</td>";
                    echo "<td>" . $row["nama_siswa"] . "</td>";
                    echo "<td>" . $row["alamat_siswa"] . "</td>";
                    echo "<td>" . $row["jenis_kelamin"] . "</td>";
                    echo "<td>" . $row["tinggi_badan"] . "</td>";
                    echo "<td>" . $row["berat_badan"] . "</td>";
                    echo "<td>" . $row["nama_ortu"] . "</td>";
                    echo "<td>" . $row["notelp_ortu"] . "</td>";
                    echo "<td>";
                    if ($row["foto"]) {
                        echo "<img src='../uploads/" . $row["foto"] . "' alt='Foto Siswa' width='50' height='50'>";
                    } else {
                        echo "Tidak ada foto";
                    }
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='10'>Tidak ada data siswa</td></tr>";
            }
            $conn->close();
            ?>
        </table>

        <!-- Heading untuk Grafik -->
        <h2 style="margin-top:50px;">Grafik Jenis Kelamin Siswa</h2>

        <!-- Container untuk Bar Chart -->
        <div class="chart-container">
            <canvas id="genderChart"></canvas>
        </div>
    </div>

    <script>
        // Data dari PHP
        const genderData = <?php echo json_encode($jenis_kelamin_count); ?>;
        const idSiswaData = <?php echo json_encode($id_siswa_data); ?>;

        const data = {
            labels: ['Laki-Laki', 'Perempuan'],
            datasets: [{
                label: 'Jumlah Siswa',
                data: [genderData['L'], genderData['P']],
                backgroundColor: [
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 99, 132, 0.2)'
                ],
                borderColor: [
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 99, 132, 1)'
                ],
                borderWidth: 1
            }]
        };

        const config = {
            type: 'bar',
            data: data,
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        precision: 0
                    }
                },
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    },
                    tooltip: {
                        callbacks: {
                            afterLabel: function(context) {
                                return 'ID Siswa: ' + idSiswaData.join(', ');
                            }
                        }
                    }
                }
            }
        };

        // Render Chart
        const genderChart = new Chart(
            document.getElementById('genderChart'),
            config
        );
    </script>
</body>

</html>
