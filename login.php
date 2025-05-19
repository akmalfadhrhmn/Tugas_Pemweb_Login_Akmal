<?php 
session_start(); 
include 'db.php'; 

// Check if user is already logged in
if (isset($_SESSION['user'])) {
    header("Location: dashboard.php");
    exit;
}

// Validate form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username']; 
    $password = $_POST['password']; 
    
    $query = "SELECT * FROM users WHERE username='$username'"; 
    $result = mysqli_query($conn, $query); 
    $user = mysqli_fetch_assoc($result); 
    
    if ($user && password_verify($password, $user['password'])) { 
        $_SESSION['user'] = $user['username']; 
        header("Location: dashboard.php"); 
        exit; // Always add exit after header redirect
    } else { 
        // Set error message in session
        $_SESSION['login_error'] = "Login gagal. Username atau password salah.";
        header("Location: index.php"); 
        exit;
    }
} else {
    // Direct access to login.php without POST data
    header("Location: index.php");
    exit;
}
?>