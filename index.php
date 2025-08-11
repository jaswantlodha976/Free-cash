<?php
require 'config.php';
if (isset($_SESSION['user_id'])) {
    header('Location: dashboard.php');
    exit;
}
$msg = '';
if (isset($_GET['msg'])) $msg = htmlspecialchars($_GET['msg']);
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>CashZilla - Login / Signup</title>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link rel="stylesheet" href="assets/style.css">
</head>
<body>
  <div class="center">
    <div class="card auth-card">
      <div class="left">
        <h1>CashZilla</h1>
        <p>Sign up or login to start earning.</p>
        <div class="marquee">
          <div>Recent: Rahul Sharma withdrew ₹1200</div>
          <div>Recent: Priya Singh withdrew ₹800</div>
        </div>
      </div>
      <div class="right">
        <?php if($msg) echo '<p class="info">'. $msg .'</p>'; ?>
        <h3>Login</h3>
        <form action="login.php" method="post">
          <input name="email" type="email" placeholder="Email" required>
          <input name="password" type="password" placeholder="Password" required>
          <button class="btn" type="submit">Login</button>
        </form>
        <hr>
        <h3>Signup</h3>
        <form action="signup.php" method="post">
          <input name="email" type="email" placeholder="Email" required>
          <input name="password" type="password" placeholder="Password" required>
          <button class="btn outline" type="submit">Signup</button>
        </form>
      </div>
    </div>
    <p class="muted">This is a demo site. For production use secure hosting and validations.</p>
  </div>
</body>
</html>
