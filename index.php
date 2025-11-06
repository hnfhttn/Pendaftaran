<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Koneksi ke database
$koneksi = new mysqli("localhost", "root", "", "pendaftaran_siswa");
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form dengan trim untuk bersihkan spasi
    $nama         = trim($_POST['nama']);
    $alamat       = trim($_POST['alamat']);
    $wa           = trim($_POST['wa']);
    $email        = trim($_POST['email']);
    $jenis_kelamin= trim($_POST['jenis_kelamin']);
    $agama        = trim($_POST['agama']);
    $sekolah_asal = trim($_POST['sekolah_asal']);

    // Prevent SQL Injection sederhana dengan prepare statement
    $stmt = $koneksi->prepare("INSERT INTO siswa (nama, alamat, wa, email, jenis_kelamin, agama, sekolah_asal) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param( "sssssss", $nama, $alamat, $wa, $email, $jenis_kelamin, $agama, $sekolah_asal);

    if ($stmt->execute()) {
        echo "<script>alert('Data berhasil Disimpan!');</script>";
    } else {
        echo "<p style='color:red;'>Error: " . $stmt->error . "</p>";
    }

    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Form Pendaftaran</title>
  <link rel="stylesheet" href="style.css" />
</head>
<body>
  <div class="container">
   <div style="display: flex; gap: 10px">
         <img style="margin-top: 80px; margin-left: 170px" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS-UQngoJJVhVbkCpozz4WAeY9yksMfowye-g&s" width="200" height="200" alt="">
    <img src="https://i.pinimg.com/736x/79/0c/a3/790ca385268cc47c273e5d09ff052e29.jpg"  width="200" alt="">
   </div>
    <h2>Form Pendaftaran</h2>
    <form action="" method="POST">
        <label for="nama">Nama:</label>
        <input type="text" id="nama" name="nama" required />

        <label for="alamat">Alamat:</label>
        <input type="text" id="alamat" name="alamat" required />

        <label for="wa">Nomor WA:</label>
        <input type="text" id="wa" name="wa" required />

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required />

        <label for="jenis_kelamin">Jenis Kelamin:</label>
        <select id="jenis_kelamin" name="jenis_kelamin" required>
            <option value="">-- Pilih --</option>
            <option value="pria">Pria</option>
            <option value="wanita">Wanita</option>
        </select>

        <label for="agama">Agama:</label>
        <select id="agama" name="agama" required>
            <option value="Islam">Islam</option>
            <option value="Kristen">Kristen</option>
            <option value="Hindu">Hindu</option>
            <option value="Budha">Budha</option>
            <option value="Konghucu">Konghucu</option>
        </select>

        <label for="sekolah">Sekolah Asal:</label>
        <input type="text" id="sekolah_asal" name="sekolah_asal" required />

        <button type="submit">Daftar</button>
        <button style="margin-top:20px" id="button">lihat data</button>
    </form>

    <script> 
        const button = document.getElementById('button');
        button.addEventListener('click', function() {
            window.top.location.href = 'index2.php';
        })
        
    </script>
  </div>
</body>
</html>
