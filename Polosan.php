<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penilaian Mahasiswa</title>

    <!-- NAYLA PUTRI INNAYAH (202332165) -->

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>

    <style>
        body {
            background-color: #f8f9fa;
        }

        .card-header {
            background-color: #007bff;
            color: white;
        }

        .form-label {
            font-weight: bold;
        }

        .result-title {
            font-weight: bold;
            font-size: 1.5rem;
        }

        .btn-full {
            width: 100%;
        }
    </style>
</head>
<body>
    <!-- NAYLA PUTRI INNAYAH (202332165) -->
    <div class="container mt-4 mb-5 px-5">
        <div class="card shadow-sm">
            <div class="card-header text-center">
                <h1 class="h4 mb-0">Form Penilaian Mahasiswa</h1>
            </div>
            <div class="card-body">
                <form method="post">
                    <!-- Input Nama -->
                    <div class="mb-3">
                        <label for="nama" class="form-label">Masukkan Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama"
                               placeholder="Agus" value="<?= $_POST['nama'] ?? '' ?>">
                    </div>

                    <!-- Input NIM -->
                    <div class="mb-3">
                        <label for="nim" class="form-label">Masukkan NIM</label>
                        <input type="text" class="form-control" id="nim" name="nim"
                               placeholder="202332xxx" value="<?= $_POST['nim'] ?? '' ?>">
                    </div>

                    <!-- Input Kehadiran -->
                    <div class="mb-3">
                        <label for="kehadiran" class="form-label">Nilai Kehadiran (10%)</label>
                        <input type="number" class="form-control" id="kehadiran" name="kehadiran"
                               placeholder="Untuk Lulus minimal 70%" min="0" max="100"
                               value="<?= $_POST['kehadiran'] ?? '' ?>">
                    </div>

                    <!-- Input Tugas -->
                    <div class="mb-3">
                        <label for="tugas" class="form-label">Nilai Tugas (20%)</label>
                        <input type="number" class="form-control" id="tugas" name="tugas"
                               placeholder="0 - 100" min="0" max="100"
                               value="<?= $_POST['tugas'] ?? '' ?>">
                    </div>

                    <!-- Input UTS -->
                    <div class="mb-3">
                        <label for="uts" class="form-label">Nilai UTS (30%)</label>
                        <input type="number" class="form-control" id="uts" name="uts"
                               placeholder="0 - 100" min="0" max="100"
                               value="<?= $_POST['uts'] ?? '' ?>">
                    </div>

                    <!-- Input UAS -->
                    <div class="mb-3">
                        <label for="uas" class="form-label">Nilai UAS (40%)</label>
                        <input type="number" class="form-control" id="uas" name="uas"
                               placeholder="0 - 100" min="0" max="100"
                               value="<?= $_POST['uas'] ?? '' ?>">
                    </div>

                    <!-- Tombol Proses -->
                    <div class="d-grid gap-2">
                        <button type="submit" name="proses" class="btn btn-primary">Proses</button>
                    </div>
                </form>

                <?php

                // NAYLA PUTRI INNAYAH (202332165)

                // Reset form saat tombol "Selesai" ditekan
                if (isset($_POST['selesai'])) {
                    $_POST = array(); // kosongkan semua input
                }

                // PROSES SAAT TOMBOL "PROSES" DITEKAN
                if (isset($_POST['proses'])) {
                    $errors = [];

                    // Validasi setiap kolom input
                    if (empty($_POST['nama'])) $errors[] = "Kolom Nama harus diisi!";
                    if (empty($_POST['nim'])) $errors[] = "Kolom NIM harus diisi!";
                    if ($_POST['kehadiran'] === "") $errors[] = "Nilai Kehadiran harus diisi!";
                    if ($_POST['tugas'] === "") $errors[] = "Nilai Tugas harus diisi!";
                    if ($_POST['uts'] === "") $errors[] = "Nilai UTS harus diisi!";
                    if ($_POST['uas'] === "") $errors[] = "Nilai UAS harus diisi!";

                    // Menampilkan peringatan error 
                    if ($errors) {
                        echo "<div class='alert alert-danger mt-3'>";
                        echo "<strong>Semua kolom harus diisi!</strong><br>";
                        foreach ($errors as $e) {
                            echo "• $e<br>";
                        }
                        echo "</div>";
                    } else {
                        // Mengambil data dari input
                        $nama = $_POST['nama'];
                        $nim = $_POST['nim'];
                        $hadir = (int)$_POST['kehadiran'];
                        $tugas = (int)$_POST['tugas'];
                        $uts = (int)$_POST['uts'];
                        $uas = (int)$_POST['uas'];

                        // Menghitung nilai akhir
                        $nilai_akhir = ($hadir * 0.1) + ($tugas * 0.2) + ($uts * 0.3) + ($uas * 0.4);

                        // Menentukan grade
                        if ($nilai_akhir >= 85) $grade = 'A';
                        elseif ($nilai_akhir >= 70) $grade = 'B';
                        elseif ($nilai_akhir >= 55) $grade = 'C';
                        elseif ($nilai_akhir >= 40) $grade = 'D';
                        else $grade = 'E';

                        // Menentukan status kelulusan
                        if ($hadir < 70) {
                            $status = 'TIDAK LULUS';
                            $warna = 'danger';
                        } elseif ($nilai_akhir >= 60 && $hadir > 70 && $tugas >= 40 && $uts >= 40 && $uas >= 40) {
                            $status = 'LULUS';
                            $warna = 'success';
                        } else {
                            $status = 'TIDAK LULUS';
                            $warna = 'danger';
                        }

                        // Menampilkan hasil
                        echo "
                        <div class='mt-4 card border-$warna'>
                            <div class='card-header bg-$warna text-white'>
                                <strong>Hasil Penilaian</strong>
                            </div>
                            <div class='card-body'>
                                <p class='text-center result-title'>Nama: $nama &nbsp;&nbsp;&nbsp; NIM: $nim</p>
                                <p>Nilai Kehadiran: $hadir%</p>
                                <p>Nilai Tugas: $tugas</p>
                                <p>Nilai UTS: $uts</p>
                                <p>Nilai UAS: $uas</p>
                                <p>Nilai Akhir: " . number_format($nilai_akhir, 2) . "</p>
                                <p>Grade: $grade</p>
                                <p>Status: <strong class='text-" . ($status == 'LULUS' ? 'success' : 'danger') . "'>$status</strong></p>
                            </div>
                            <div class='card-footer'>
                                <!-- Tombol untuk reset -->
                                <form method='post'>
                                    <button type='submit' name='selesai' class='btn btn-$warna btn-full'>Selesai</button>
                                </form>
                            </div>
                        </div>";
                    }
                }
                ?>
            </div>
        </div>
    </div>
</body>
</html>
