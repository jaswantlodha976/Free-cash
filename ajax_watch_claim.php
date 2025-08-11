<?php
require 'config.php';
if (!isset($_SESSION['user_id'])){ echo 'Login required'; exit; }
$uid = intval($_SESSION['user_id']);
$res = mysqli_query($conn, "SELECT watch_start FROM users WHERE id=$uid");
$row = mysqli_fetch_assoc($res);
$start = intval($row['watch_start']);
if ($start <= 0) { echo 'No watch start found'; exit; }
$now = time()*1000;
$sec = floor(($now - $start)/1000);
if ($sec < 150) { echo 'Not enough watch time: ' . $sec . ' sec. Minimum 150 sec required.'; exit; }
$earn = floor($sec/10) * 1;
mysqli_query($conn, "UPDATE users SET balance = balance + $earn, watch_start = 0 WHERE id=$uid");
mysqli_query($conn, "INSERT INTO transactions (user_id, amount, reason, ts) VALUES ($uid, $earn, 'Watch earn', $now)");
echo 'You earned ₹' . $earn;
?>