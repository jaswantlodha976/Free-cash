<?php
require 'config.php';
if (!isset($_SESSION['user_id'])){ echo 'Login required'; exit; }
$uid = intval($_SESSION['user_id']);
$res = mysqli_query($conn, "SELECT last_daily FROM users WHERE id=$uid");
$row = mysqli_fetch_assoc($res);
$now = time()*1000;
$last = $row['last_daily'];
$today = date('Y-m-d', $now/1000);
$lastday = ($last>0)?date('Y-m-d',$last/1000):'1970-01-01';
if ($today == $lastday) { echo 'Already claimed today'; exit; }
mysqli_query($conn, "UPDATE users SET balance = balance + 20, last_daily = $now WHERE id=$uid");
echo '₹20 added for daily login';
?>