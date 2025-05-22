<?php include "db.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Data User</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
  <h2>Data User</h2>
  <a href="tambah.php" class="btn btn-primary mb-3">+ Tambah User</a>
  <table class="table table-bordered">
    <thead class="table-dark">
      <tr>
        <th>No</th>
        <th>Foto Profile</th>
        <th>Username</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $no = 1;
      $result = mysqli_query($conn, "SELECT * FROM users");
      while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
                <td>$no</td>
                <td>";
    
        echo "<img src='uploads/{$row['foto']}' alt='Profile Photo' style='width: 50px; height: 50px; object-fit: cover; border-radius: 50%;'>";
        
        echo "</td>
                <td>{$row['username']}</td>
                <td>
                  <a href='edit.php?id={$row['id']}' class='btn btn-warning btn-sm'>Edit</a>
                  <a href='hapus.php?id={$row['id']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Hapus data ini?\")'>Hapus</a>
                </td>
              </tr>";
        $no++;
      }
      ?>
    </tbody>
  </table>
</body>
</html>