<?php
require 'function.php';
$conn = koneksi();

// Ambil ID dari parameter URL
$id = $_GET['id'];

// Pastikan ID valid
if (isset($id) && is_numeric($id)) {
    // Hapus data dari tabel keputusan
    $query = "DELETE FROM masuk WHERE idmasuk = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);

    if (mysqli_stmt_execute($stmt)) {
        // Redirect ke halaman keputusan.php setelah berhasil menghapus
        header("Location: suratmasuk.php");
        exit();
    } else {
        echo "Terjadi kesalahan saat menghapus data: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
} else {
    echo "ID tidak valid.";
}

mysqli_close($conn);
?>
