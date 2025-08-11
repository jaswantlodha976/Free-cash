CashZilla - InfinityFree ready package
---------------------------------------
Contents:
- index.php          -> Login & Signup UI (routes to dashboard)
- signup.php         -> Handles signup (inserts into users)
- login.php          -> Handles login (verifies credentials, starts session)
- dashboard.php      -> User dashboard (shows balance, watch tool, refer code)
- withdraw.php       -> Create withdraw request (saved in DB)
- logout.php         -> Logout
- config.php         -> DB config (replace placeholders)
- init_db.sql        -> SQL to create required tables
- assets/*           -> css and simple logo

Instructions:
1) On InfinityFree: Create account, create new site, go to Control Panel.
2) In Control Panel -> MySQL Databases: create a new database. Note host, db name, username, password.
3) Edit config.php and replace DB_HOST, DB_NAME, DB_USER, DB_PASS with your values.
4) Upload ZIP to File Manager (htdocs) and extract, or upload files directly.
5) In Control Panel -> phpMyAdmin: Import init_db.sql to create tables.
6) Open your site URL -> use signup to create account -> login -> dashboard.
7) Watch feature is simulated: click 'Open Video' to save watch start, then 'Claim Watch' to calculate time based earnings.
8) Withdraw requests are stored in 'withdrawals' table and marked 'pending'. Admin approval must be done manually in DB or by extending admin.php.

Security notes:
- This is a simple demo implementation. For production, enforce HTTPS, strong validation, prepared statements, and server-side checks.
- Do not store sensitive production data without secure measures.

If you want, I can also provide an admin.php to approve withdrawals.
