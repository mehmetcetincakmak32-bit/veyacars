<?php
session_start();
error_reporting(0);

// --- GİRİŞ KONTROLÜ ---
if (isset($_POST['site_login'])) {
    // Kullanıcı adı: admin | Şifre: 123456
    if ($_POST['user'] === "admin" && $_POST['pass'] === "123456") {
        $_SESSION['cb_auth'] = true;
        header("Location: index.php"); exit;
    } else { 
        $error = "Hatalı Giriş Bilgileri!"; 
    }
}

// --- ÇIKIŞ ---
if (isset($_GET['logout'])) { session_destroy(); header("Location: index.php"); exit; }
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CiscoBrain | Login</title>
    <style>
        :root { --blue: #0071e3; --dark: #1d1d1f; }
        body, html { margin: 0; padding: 0; height: 100%; font-family: -apple-system, sans-serif; background: #f5f7fa; overflow: hidden; }
        .apple-bg { position: fixed; inset: 0; z-index: 1; background: linear-gradient(135deg, #f5f7fa 0%, #cfdef3 100%); }
        #data-stream { position: fixed; inset: 0; z-index: 2; pointer-events: none; opacity: 0.7; }
        
        /* GİRİŞ KARTI (CAM EFEKTİ) */
        .login-overlay { position: fixed; inset: 0; z-index: 1000; display: flex; align-items: center; justify-content: center; backdrop-filter: blur(20px); }
        .glass-card { background: rgba(255, 255, 255, 0.45); backdrop-filter: blur(30px) saturate(180%); border: 1px solid rgba(255, 255, 255, 0.3); border-radius: 40px; padding: 50px 35px; width: 340px; text-align: center; box-shadow: 0 25px 50px rgba(0,0,0,0.05); }
        
        input { width: 100%; padding: 15px; margin-bottom: 15px; border-radius: 14px; border: 1px solid #ddd; outline: none; text-align: center; font-size: 14px; background: rgba(255,255,255,0.8); }
        .btn-blue { width: 100%; padding: 16px; border-radius: 16px; border: none; background: var(--blue); color: #fff; font-weight: 600; cursor: pointer; transition: 0.3s; }
        .btn-blue:hover { transform: scale(1.02); background: #0077ed; }

        /* ANA EKRAN LOGOSU */
        .hero { position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); text-align: center; z-index: 50; }
        .hero h1 { font-size: 4.5rem; letter-spacing: 25px; font-weight: 100; color: var(--dark); margin: 0; }
        @media (max-width: 768px) { .hero h1 { font-size: 2.2rem; letter-spacing: 8px; } }
    </style>
</head>
<body>
    <div class="apple-bg"></div>
    <canvas id="data-stream"></canvas>

    <?php if (!isset($_SESSION['cb_auth'])): ?>
        <div class="login-overlay">
            <form class="glass-card" method="POST">
                <h2 style="font-weight:200; letter-spacing:5px; margin-bottom:5px;">CISCOBRAIN</h2>
                <p style="font-size:10px; color:#888; margin-bottom:30px; letter-spacing:2px;">SİSTEM ERİŞİMİ</p>
                
                <?php if($error) echo "<p style='color:red; font-size:12px;'>$error</p>"; ?>
                
                <input type="text" name="user" placeholder="Kullanıcı Adı" required autofocus>
                <input type="password" name="pass" placeholder="Şifre" required>
                <button type="submit" name="site_login" class="btn-blue">SİSTEMİ BAŞLAT</button>
            </form>
        </div>
    <?php else: ?>
        <?php include 'menu.php'; ?>
        <div class="hero">
            <h1>CISCOBRAIN</h1>
            <p style="color:#8e8e93; letter-spacing:10px; font-size:11px; font-weight:600; margin-top:20px;">NATIONAL NETWORK OS</p>
        </div>
    <?php endif; ?>

    <script src="anim.js"></script>
</body>
</html>
