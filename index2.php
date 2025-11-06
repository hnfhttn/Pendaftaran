<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$koneksi = new mysqli("localhost", "root", "", "pendaftaran_siswa");
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

// Ambil data dari tabel mahasiswa
$result = $koneksi->query("SELECT * FROM siswa");
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Data Mahasiswa</title>
<style>
  body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: white;
    padding: 20px;
  }
  h2 {
    text-align: center;
    color: #333;
  }
  table {
    border-collapse: collapse;
    width: 90%;
    margin: 20px auto;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    background: #fff;
    border-radius: 8px;
    overflow: hidden;
  }
  th, td {
    padding: 12px 20px;
    text-align: left;
  }
  th {
    background-color: #009879;
    color: white;
    text-transform: uppercase;
    font-weight: 600;
  }
  tr:nth-child(even) {
    background-color: #f3f3f3;
  }
  tr:hover {
    background-color: #d1e7dd;
    cursor: pointer;
  }
</style>
</head>
<body>
    <div style="display: flex; gap: 10px; margin-left: 350px">
         <img style="margin-top: 80px; margin-left: 170px" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS-UQngoJJVhVbkCpozz4WAeY9yksMfowye-g&s" width="200" height="200" alt="">
    <img src="https://i.pinimg.com/736x/79/0c/a3/790ca385268cc47c273e5d09ff052e29.jpg"  width="200" alt="">
   </div>

<h2>Data Mahasiswa</h2>

<table>
  <thead>
    <tr>
      <th>ID</th>
      <th>Nama</th>
      <th>Alamat</th>
      <th>WA</th>
      <th>Email</th>
      <th>Jenis Kelamin</th>
      <th>Agama</th>
      <th>Sekolah Asal</th>
    </tr>
  </thead>
  <tbody>
    <?php if ($result && $result->num_rows > 0): ?>
      <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
          <td><?= htmlspecialchars($row['no']) ?></td>
          <td><?= htmlspecialchars($row['nama']) ?></td>
          <td><?= htmlspecialchars($row['alamat']) ?></td>
          <td><?= htmlspecialchars($row['wa']) ?></td>
          <td><?= htmlspecialchars($row['email']) ?></td>
          <td><?= htmlspecialchars($row['jenis_kelamin']) ?></td>
          <td><?= htmlspecialchars($row['agama']) ?></td>
          <td><?= htmlspecialchars($row['sekolah_asal']) ?></td>
        </tr>
      <?php endwhile; ?>
    <?php else: ?>
      <tr><td colspan="8" style="text-align:center;">Tidak ada data.</td></tr>
    <?php endif; ?>
  </tbody>
</table>

</body>
</html>
