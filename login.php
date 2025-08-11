<?php
require 'config.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = mysqli_real_escape_string($conn, trim($_POST['email']));
    $password = $_POST['password'];
    $res = mysqli_query($conn, "SELECT * FROM users WHERE email='$email' LIMIT 1");
    if ($res && $row = mysqli_fetch_assoc($res)) {
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            header('Location: dashboard.php');
            exit;
        }
    }
    header('Location: index.php?msg=' . urlencode('Invalid credentials'));
} else {
    header('Location: index.php');
}
?>