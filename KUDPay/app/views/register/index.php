<?php
// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "KUDPay");

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Inisialisasi variabel
$error = '';
$success = '';

// Proses form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ussername = trim($_POST["ussername"]);
    $nama = trim($_POST["nama"]);
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    // Validasi
    if (empty($ussername) || empty($nama) || empty($password) || empty($confirm_password)) {
        $error = "Semua field harus diisi.";
    } elseif ($password !== $confirm_password) {
        $error = "Password dan Konfirmasi Password tidak cocok.";
    } else {
        // Cek ussername unik
        $stmt = $conn->prepare("SELECT id FROM admin WHERE ussername = ?");
        $stmt->bind_param("s", $ussername);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $error = "ussername sudah digunakan.";
        } else {
            // Hash password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Insert ke database
            $stmt = $conn->prepare("INSERT INTO admin (ussername, nama, password) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $ussername, $nama, $hashed_password);
            if ($stmt->execute()) {
                $success = "Registrasi berhasil.";
            } else {
                $error = "Gagal menyimpan data.";
            }
        }
        $stmt->close();
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Admin</title>
</head>
<body>
    <h2>Registrasi Admin</h2>
    <?php if ($error): ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php elseif ($success): ?>
        <p style="color: green;"><?php echo $success; ?></p>
    <?php endif; ?>

    <form method="post" action="">
        <label for="ussername">ussername:</label><br>
        <input type="text" id="ussername" name="ussername" required><br><br>

        <label for="nama">Nama:</label><br>
        <input type="text" id="nama" name="nama" required><br><br>

        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br><br>

        <label for="confirm_password">Konfirmasi Password:</label><br>
        <input type="password" id="confirm_password" name="confirm_password" required><br><br>

        <button type="submit">Registrasi</button>
    </form>
</body>
</html>
