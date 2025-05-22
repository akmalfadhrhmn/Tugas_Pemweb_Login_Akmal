<?php
include "db.php";
$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM users WHERE id=$id"));
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit User</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
  <h2>Edit Data User</h2>
  <form method="POST" enctype="multipart/form-data">
    <div class="mb-3">
      <label>Username</label>
      <input type="text" name="username" class="form-control" value="<?= $data['username'] ?>" required>
    </div>
    <div class="mb-3">
      <label>Ganti Foto Profile</label>
      <input type="file" name="foto" class="form-control" accept="image/*" required>
      <small class="text-muted">Pilih foto baru untuk mengganti foto profile</small>
    </div>
    <button type="submit" name="update" class="btn btn-warning">Update</button>
    <a href="crud.php" class="btn btn-secondary">Kembali</a>
  </form>

  <?php
  if (isset($_POST['update'])) {
    $username = $_POST['username'];
    
    if (!empty($_FILES['foto']['name'])) {
      if (!empty($data['foto']) && file_exists('uploads/' . $data['foto'])) {
        unlink('uploads/' . $data['foto']);
      }


      $foto_name = $_FILES['foto']['name'];
      
      move_uploaded_file($_FILES['foto']['tmp_name'], 'uploads/' . $foto_name);
      mysqli_query($conn, "UPDATE users SET username='$username', foto='$foto_name' WHERE id=$id");
    } else {
      mysqli_query($conn, "UPDATE users SET username='$username' WHERE id=$id");
    }

    echo "
    <div class='alert alert-success mt-3'>Data berhasil diedit.</div>
    <script>
      alert('Data Berhasil Diupdate');
      window.location.href = 'crud.php';
    </script>
    ";
  }
  ?>
</body>
</html>