<?php
require 'db.php';
if (session_status() === PHP_SESSION_NONE) session_start();

if (isset($_SESSION['user_id'])) {
    header("Location: profile.php");
    exit;
}

$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $login = mysqli_real_escape_string($conn, $_POST['login']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $fio = mysqli_real_escape_string($conn, $_POST['fio']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $role_id = 2;

    $check = mysqli_query($conn, "SELECT * FROM Users WHERE login='$login'");
    if (mysqli_num_rows($check) > 0) {
        $message = "<div class='error'>Логин уже занят!</div>";
    } else {
        $sql = "INSERT INTO Users (login, password, fio, phone, email, role_id) 
                VALUES ('$login', '$password', '$fio', '$phone', '$email', '$role_id')";
        if (mysqli_query($conn, $sql)) {
            $message = "<div class='success'>Регистрация успешна! <a href='login.php'>Войти</a></div>";
        } else {
            $message = "<div class='error'>Ошибка: " . mysqli_error($conn) . "</div>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация - Матпомощь</title>
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
                <a href="login.php">Вход</a>
            </div>
        </div>
    </header>
    <main>
        <h2 class="page-title">Регистрация</h2>
        <div class="auth-form">
            <?= $message ?>
            <form method="POST">
                <label>Логин</label>
                <input type="text" name="login" required>
                <label>Пароль</label>
                <input type="password" name="password" required>
                <label>ФИО</label>
                <input type="text" name="fio" required>
                <label>Телефон</label>
                <input type="text" name="phone" required>
                <label>Email</label>
                <input type="email" name="email" required>
                <button type="submit">Зарегистрироваться</button>
            </form>
            <p>Уже есть аккаунт? <a href="login.php">Войти</a></p>
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
