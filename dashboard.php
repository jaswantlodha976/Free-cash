<?php
require 'config.php';
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}
$uid = intval($_SESSION['user_id']);
$res = mysqli_query($conn, "SELECT * FROM users WHERE id=$uid");
$user = mysqli_fetch_assoc($res);
?>
<!doctype html>
<html><head>
<meta charset="utf-8"><title>CashZilla - Dashboard</title>
<meta name="viewport" content="width=device-width,initial-scale=1">
<link rel="stylesheet" href="assets/style.css">
</head><body>
<div class="center">
  <div class="card">
    <h2>Welcome, <?php echo htmlspecialchars($user['email']); ?></h2>
    <p>Balance: ₹<span id="bal"><?php echo intval($user['balance']); ?></span></p>
    <p>Level: <?php echo intval($user['level']); ?></p>

    <h3>Tasks</h3>
    <button onclick="claimDaily()" class="btn">Claim Daily Login (₹20)</button>
    <div class="watch">
      <button onclick="openVideo()" class="btn accent">Open Random Video</button>
      <button id="claimWatchBtn" onclick="claimWatch()" class="btn" style="display:none">Claim Watch</button>
      <p id="watchStatus" class="muted"></p>
    </div>

    <h3>Withdraw</h3>
    <form action="withdraw.php" method="post">
      <input name="acc_name" placeholder="Account Holder Name" required>
      <input name="acc_no" placeholder="Account Number" required>
      <input name="ifsc" placeholder="IFSC / UPI ID" required>
      <input name="amount" type="number" placeholder="Amount (₹)" required>
      <button class="btn primary" type="submit">Request Withdraw</button>
    </form>
    <p class="muted">Withdraw requests will be saved as pending.</p>

    <p><a href="logout.php">Logout</a></p>
  </div>
</div>

<script>
function xhrGet(url, cb){ var xr=new XMLHttpRequest(); xr.open('GET',url); xr.onload=function(){ cb(xr.responseText); }; xr.send(); }
function claimDaily(){
  xhrGet('ajax_claim_daily.php', function(res){ alert(res); location.reload(); });
}

const videos = ['https://youtu.be/f2SCN87882g?si=7Y_C2nMMP3RqhIAy','https://youtu.be/cdtHYN8uulc?si=xsqs15Qbs5xwhhg1'];
function openVideo(){
  const v = videos[Math.floor(Math.random()*videos.length)];
  // save start via AJAX
  var xr=new XMLHttpRequest(); xr.open('GET','ajax_watch_start.php?ts='+Date.now()); xr.send();
  window.open(v,'_blank');
  document.getElementById('watchStatus').innerText = 'Video opened. Watch minimum 2.5 min then return and click Claim Watch';
  document.getElementById('claimWatchBtn').style.display = 'inline-block';
}
function claimWatch(){
  var xr=new XMLHttpRequest(); xr.open('GET','ajax_watch_claim.php'); xr.onload=function(){ alert(xr.responseText); location.reload(); }; xr.send();
}
</script>
</body></html>
