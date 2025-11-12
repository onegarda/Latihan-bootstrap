<?php
include '../config.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $nama  = $_POST['nama'] ?? '';
  $email = $_POST['email'] ?? '';
  $pesan = $_POST['pesan'] ?? '';

  if ($nama && $email && $pesan) {
    $stmt = $conn->prepare("INSERT INTO kontak (nama, email, pesan) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nama, $email, $pesan);

    if ($stmt->execute()) {
      echo "success";
    } else {
      echo "error";
    }

    $stmt->close();
  } else {
    echo "empty";
  }
}

$conn->close();
?>
