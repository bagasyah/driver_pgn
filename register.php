<?php
// Koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "perjalanan");
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mendapatkan data yang di-submit dari form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Mengecek apakah username sudah ada dalam database
    $checkQuery = "SELECT * FROM users WHERE username='$username'";
    $checkResult = mysqli_query($conn, $checkQuery);
    if (mysqli_num_rows($checkResult) > 0) {
        echo "Username sudah digunakan.";
    } else {
        // Menyimpan data pengguna baru ke dalam database
        $query = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
        $result = mysqli_query($conn, $query);

        if ($result) {
            // Redirect ke halaman login setelah pendaftaran berhasil
            header("Location: login.php");
            exit();
        } else {
            echo "Terjadi kesalahan dalam pendaftaran.";
        }
    }
}

// Tutup koneksi ke database
mysqli_close($conn);
?>
<!DOCTYPE html>
<html>

<head>
    <title>Registrasi Pengguna</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-4">
        <h2>Registrasi Pengguna</h2>
        <form method="POST" action="register.php">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" name="username" id="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" id="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Daftar</button>
        </form>
    </div>
</body>

</html>