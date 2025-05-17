<?php
function koneksi() {
    $conn = mysqli_connect("localhost", "root", "", "hukumsiap");

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    return $conn;
}
?>
