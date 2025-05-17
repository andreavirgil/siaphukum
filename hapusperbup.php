<?php
require 'function.php';
$conn = koneksi();

if (isset($_GET['id'])) {
    $idperbup = intval($_GET['id']);
    
    // Ambil nama file dari database sebelum menghapus data
    $stmt = $conn->prepare("SELECT fileperbup FROM perbup WHERE idperbup = ?");
    $stmt->bind_param("i", $idperbup);
    $stmt->execute();
    $stmt->bind_result($fileperbup);
    $stmt->fetch();
    $stmt->close();
    
    // Path lengkap ke file
    $filePath = "previewperbup/" . $fileperbup;
    
    // Hapus file dari server jika ada
    if ($fileperbup && file_exists($filePath)) {
        if (unlink($filePath)) {
            $fileDeleteStatus = "File berhasil dihapus.";
        } else {
            $fileDeleteStatus = "Gagal menghapus file.";
        }
    } else {
        $fileDeleteStatus = "File tidak ditemukan.";
    }

    // Hapus data dari database
    $stmt = $conn->prepare("DELETE FROM perbup WHERE idperbup = ?");
    $stmt->bind_param("i", $idperbup);

    if ($stmt->execute()) {
        echo "<script>
                alert('Data dan " . $fileDeleteStatus . "');
                window.location.href = 'perbup.php';
              </script>";
    } else {
        echo "<script>
                alert('Data gagal dihapus!');
                window.location.href = 'perbup.php';
              </script>";
    }
    $stmt->close();
}
?>
