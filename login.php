<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AUTH_PROTOCOL | COMMAND_CENTER</title>
    <link rel="stylesheet" href="data/css/auth_style.css">
</head>
<body>
    <div class="auth-wrapper">
        <div class="auth-box">
            <div class="auth-label">/sys/auth/login.exe</div>
            <div class="auth-content">
                <div class="auth-header">
                    <h2>ACCESS_RESTRICTED</h2>
                    <p>Masukkan kredensial untuk otorisasi sistem.</p>
                </div>
                <form action="auth_process.php" method="POST" class="auth-form">
                    <div class="form-group">
                        <label>USERNAME</label>
                        <input type="text" name="username" placeholder="Root ID" required>
                    </div>
                    <div class="form-group">
                        <label>PASSWORD</label>
                        <input type="password" name="password" placeholder="********" required>
                    </div>
                    <button type="submit" class="auth-btn">AUTHORIZE_ACCESS</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>