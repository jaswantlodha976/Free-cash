<?php
require 'config.php';
if (!isset($_SESSION['user_id'])){ echo 'Login required'; exit; }
$uid = intval($_SESSION['user_id']);
$ts = isset($_GET['ts'])?intval($_GET['ts']):time()*1000;
mysqli_query($conn, "UPDATE users SET watch_start = $ts WHERE id=$uid");
echo 'Watch start saved';
?>