<?php
session_start();

// Cek apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    // Redirect ke halaman login jika pengguna belum login
    header("Location: login.php");
    exit();
}
?>


<!DOCTYPE html>
<html>

<head>
    <title>Laporan Daftar Perjalanan</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-4 ">
        <h2 class="text-center">Daftar Laporan Perjalanan</h2>

        <div class="mb-3">
            <form method="GET" action="search.php" class="form-inline">
                <button type="submit" class="btn btn-primary mr-2F ">Search</button>
                <div class="form-group  mr-auto">
                    <input type="text" name="keyword" class="form-control" placeholder="Cari...">
                </div>

                <a href="logout.php" class="btn btn-danger">Logout</a>

            </form>

        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>Gambar</th>
                    <th>Nama</th>
                    <th>Tanggal</th>
                    <th>Alamat Awal</th>
                    <th>Alamat Tujuan</th>
                    <th>Jarak (km)</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Koneksi ke database
                $conn = mysqli_connect("localhost", "root", "", "perjalanan");
                if (!$conn) {
                    die("Koneksi gagal: " . mysqli_connect_error());
                }

                // Ambil data laporan dari database
                $query = "SELECT * FROM laporan_perjalanan";
                $result = mysqli_query($conn, $query);

                // Tampilkan data dalam tabel
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td><img src='uploads/{$row['gambar']}' width='100'></td>";
                    echo "<td>{$row['nama']}</td>";
                    echo "<td>{$row['tanggal']}</td>";
                    echo "<td>{$row['alamat_awal']}</td>";
                    echo "<td>{$row['alamat_tujuan']}</td>";
                    echo "<td>{$row['jarak']}</td>";
                    echo "<td><a href='edit.php?id={$row['id']}' class='btn btn-primary'>Edit</a> 
                          <a href='delete.php?id={$row['id']}' class='btn btn-danger'>Hapus</a></td>";
                    echo "</tr>";
                }

                // Tutup koneksi ke database
                mysqli_close($conn);
                ?>
            </tbody>
        </table>
        <a href="add.php" class="btn btn-success">Tambah Laporan</a>
    </div>

</body>

</html>