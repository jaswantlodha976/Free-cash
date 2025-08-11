<?php
require 'config.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = mysqli_real_escape_string($conn, trim($_POST['email']));
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $q = "INSERT INTO users (email, password) VALUES ('$email', '$password')";
    if (mysqli_query($conn, $q)) {
        header('Location: index.php?msg=' . urlencode('Signup successful. Please login.'));
    } else {
        header('Location: index.php?msg=' . urlencode('Signup failed: ' . mysqli_error($conn)));
    }
} else {
    header('Location: index.php');
}
?>