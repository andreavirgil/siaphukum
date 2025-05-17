<?php
require 'function.php';

$conn = koneksi();

// Periksa apakah ID telah diterima melalui URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    echo "
    <script>
    var confirmDelete = confirm('Apakah Anda yakin ingin menghapus pengguna ini?');
    if (confirmDelete) {
        window.location.href = 'hapususer.php?action=delete&id=' + $id;
    } else {
        window.location.href = 'indexadmin.php';
    }
    </script>
    ";
    
    // Periksa jika tindakan hapus dikonfirmasi
    if (isset($_GET['action']) && $_GET['action'] == 'delete') {
        // Query untuk menghapus data pengguna berdasarkan ID
        $query = "DELETE FROM login WHERE iduser = $id";
        
        // Eksekusi query
        if (mysqli_query($conn, $query)) {
            // Redirect ke halaman utama jika berhasil
            header("Location: indexadmin.php");
            exit;
        } else {
            echo "Gagal menghapus data: " . mysqli_error($conn);
        }
    }
} else {
    // Jika ID tidak ada, redirect kembali ke halaman utama
    header("Location: indexadmin.php");
    exit;
}
