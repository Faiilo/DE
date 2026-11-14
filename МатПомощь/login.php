<?php
require 'db.php';
if (session_status() === PHP_SESSION_NONE) session_start();

if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: login.php");
    exit;
}

if (isset($_SESSION['user_id'])) {
    if ($_SESSION['role_id'] == 1) {
        header("Location: admin.php");
    } else {
        header("Location: profile.php");
    }
    exit;
}

$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login_btn'])) {
    $login = mysqli_real_escape_string($conn, $_POST['login']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $sql = "SELECT * FROM Users WHERE login='$login' AND password='$password'";
    $result = mysqli_query($conn, $sql);
    
    if ($result && mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);
        $_SESSION['user_id'] = $user['id_user'];
        $_SESSION['role_id'] = $user['role_id'];
        $_SESSION['fio'] = $user['fio'];
        
        if ($user['role_id'] == 1) {
            header("Location: admin.php");
        } else {
            header("Location: profile.php");
        }
        exit;
    } else {
        $message = "<div class='error'>Неверный логин или пароль!</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вход - Матпомощь</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <div class="header-inner">
            <div class="logo">
                <a href="index.php">
                    <img src="media/image02.jpg" alt="Логотип" style="height: 60px; width: auto; border-radius: 4px;">
                </a>
            </div>
            <button class="burger" aria-label="Меню">
                <span></span><span></span><span></span>
            </button>
            <div class="header-right">
                <a href="index.php">Главная</a>
                <a href="register.php">Регистрация</a>
            </div>
        </div>
    </header>
    
    <main>
        <h2 class="page-title">Вход в систему</h2>
        <div class="auth-form">
            <?= $message ?>
            <form method="POST">
                <label>Логин</label>
                <input type="text" name="login" required>
                
                <label>Пароль</label>
                <input type="password" name="password" required>
                
                <button type="submit" name="login_btn">Войти</button>
            </form>
            <p>Нет аккаунта? <a href="register.php">Регистрация</a></p>
        </div>
    </main>

    <footer>
        <div class="footer-inner">
            <div class="footer-contacts">
                <p><b>Контакты:</b></p>
                <p>Телефон: 8(888)888-88-88</p>
                <p>Email: info@matpomosh.ru</p>
            </div>
            <div class="footer-copy">&copy; <?= date('Y') ?> Мат.Помощь</div>
        </div>
    </footer>
    <script src="script.js"></script>
</body>
</html>
