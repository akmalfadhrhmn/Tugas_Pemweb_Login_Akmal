<?php 
session_start(); 
include 'db.php'; 

if (isset($_SESSION['user'])) {
    header("Location: dashboard.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username']; 
    $password = $_POST['password']; 
    
    $query = "SELECT * FROM users WHERE username='$username'"; 
    $result = mysqli_query($conn, $query); 
    $user = mysqli_fetch_assoc($result); 
    
    if ($user && password_verify($password, $user['password'])) { 
        $_SESSION['user'] = $user['username']; 
        header("Location: dashboard.php"); 
        exit; 
    } else { 
        $_SESSION['login_error'] = "Login gagal. Username atau password salah.";
        header("Location: index.php"); 
        exit;
    }
} else {
    header("Location: index.php");
    exit;
}
?>