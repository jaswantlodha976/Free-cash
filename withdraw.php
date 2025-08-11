<?php
require 'config.php';
if (!isset($_SESSION['user_id'])) { header('Location:index.php'); exit; }
$uid = intval($_SESSION['user_id']);
$acc_name = mysqli_real_escape_string($conn, $_POST['acc_name']);
$acc_no = mysqli_real_escape_string($conn, $_POST['acc_no']);
$ifsc = mysqli_real_escape_string($conn, $_POST['ifsc']);
$amount = intval($_POST['amount']);

// check balance
$res = mysqli_query($conn, "SELECT balance FROM users WHERE id=$uid");
$row = mysqli_fetch_assoc($res);
if ($row && $row['balance'] >= $amount) {
    mysqli_query($conn, "INSERT INTO withdrawals (user_id, acc_name, acc_no, ifsc, amount, status) VALUES ($uid, '$acc_name', '$acc_no', '$ifsc', $amount, 'pending')");
    // deduct balance immediately or keep until approval (we deduct)
    mysqli_query($conn, "UPDATE users SET balance = balance - $amount WHERE id=$uid");
    header('Location: dashboard.php?msg=' . urlencode('Withdraw request created and marked pending.'));
} else {
    header('Location: dashboard.php?msg=' . urlencode('Insufficient balance'));
}
?>