<?php include "db.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Tambah User</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
  <h2>Tambah Data User</h2>
  <form method="POST" enctype="multipart/form-data">
    <div class="mb-3">
      <label>Username</label>
      <input type="text" name="username" class="form-control" required>
    </div> 
    <div class="mb-3">
      <label>Password</label>
      <input type="text" name="password" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Foto Profile</label>
      <input type="file" name="foto" class="form-control" accept="image/*" required>
    </div>
    <button type="submit" name="simpan" class="btn btn-success">Simpan</button>
    <a href="crud.php" class="btn btn-secondary">Kembali</a>
  </form>

  <?php
  if (isset($_POST['simpan'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    // Menggunakan nama file asli tanpa perubahan
    $foto_name = $_FILES['foto']['name'];
    
    move_uploaded_file($_FILES['foto']['tmp_name'], 'uploads/' . $foto_name);
    
    mysqli_query($conn, "INSERT INTO users (username, password, foto) VALUES ('$username', '$password_hash', '$foto_name')");

    echo "
    <div class='alert alert-success mt-3'>Data berhasil disimpan.</div>
    <script>
      alert('Data Berhasil Ditambah');
      window.location.href = 'crud.php';
    </script>
    ";
  }
  ?>
</body>
</html>