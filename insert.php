<?php
// Koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "perjalanan");
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Mendapatkan data yang ditambahkan dari form
$gambar = $_FILES['gambar']['name'];
$nama = $_POST['nama'];
$tanggal = $_POST['tanggal'];
$alamat_awal = $_POST['alamat_awal'];
$alamat_tujuan = $_POST['alamat_tujuan'];
$jarak = $_POST['jarak'];

// Upload gambar
$targetDir = "uploads/";
$targetFile = $targetDir . basename($_FILES["gambar"]["name"]);
move_uploaded_file($_FILES["gambar"]["tmp_name"], $targetFile);

// Menyimpan data laporan ke database
$query = "INSERT INTO laporan_perjalanan (gambar, nama, tanggal, alamat_awal, alamat_tujuan, jarak)
          VALUES ('$gambar', '$nama', '$tanggal', '$alamat_awal', '$alamat_tujuan', '$jarak')";
$result = mysqli_query($conn, $query);

// Mengalihkan kembali ke halaman utama setelah data ditambahkan
header("Location: index.php");
exit();

// Tutup koneksi ke database
mysqli_close($conn);
?>