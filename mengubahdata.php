<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "nama_database_laporpak"; 

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if (isset($_POST['submit'])) {
    $user_id = intval($_POST['user_id']);
    $name    = $conn->real_escape_string($_POST['name']);
    $email   = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password'];

  
    if (!empty($password)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "UPDATE users SET name='$name', email='$email', password='$hashed_password' WHERE id=$user_id";
    } else {
        // Jika password tidak diubah
        $sql = "UPDATE users SET name='$name', email='$email' WHERE id=$user_id";
    }

    if ($conn->query($sql) === TRUE) {
        echo "Data akun berhasil diperbarui.";
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>