<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $bukti_laporan = $_FILES["bukti_laporan"];
    $lokasi_laporan = $_POST["lokasi_laporan"];
    $ciri_lokasi = $_POST["ciri_lokasi"];
    $kategori_laporan = $_POST["kategori_laporan"];
    $deskripsi_laporan = $_POST["deskripsi_laporan"];
    $persetujuan = isset($_POST["persetujuan"]) ? $_POST["persetujuan"] : "";

    // Validasi data
    $errors = [];
    if (empty($bukti_laporan["name"])) {
        $errors[] = "Lengkapi bukti kerusakan";
    }
    if (empty($lokasi_laporan)) {
        $errors[] = "Lengkapi lokasi laporan";
    }
    if (empty($kategori_laporan)) {
        $errors[] = "Pilih kategori laporan";
    }
    if (empty($deskripsi_laporan)) {
        $errors[] = "Lengkapi deskripsi laporan";
    }
    if (empty($persetujuan)) {
        $errors[] = "Ceklis pernyataan persetujuan";
    }

    // Jika ada error, redirect kembali ke form dengan pesan error
    if (!empty($errors)) {
        $query_string = http_build_query(['errors' => $errors]);
        header('Location: /form-laporan?' . $query_string);
        exit();
    } else {
        // Proses upload file (contoh sederhana)
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($bukti_laporan["name"]);
        move_uploaded_file($bukti_laporan["tmp_name"], $target_file);

        // Redirect kembali ke form dengan pesan sukses
        header('Location: /form-laporan?success=Laporan berhasil dikirim!');
        exit();
    }
}
?>
