<?php
require 'db.php';
if (session_status() === PHP_SESSION_NONE) session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
if ($_SESSION['role_id'] == 1) {
    header("Location: admin.php");
    exit;
}

$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit_request'])) {
    $user_id = $_SESSION['user_id'];
    $osnovanie_id = $_POST['osnovanie_id'];
    $sostav_family = mysqli_real_escape_string($conn, $_POST['sostav_family']);
    $tip_home = mysqli_real_escape_string($conn, $_POST['tip_home']);
    $status_id = 1; 
    $document_id = 1; 

    $sql = "INSERT INTO Requests (osnovanie_id, sostav_family, tip_home, document_id, user_id, status_id) 
            VALUES ('$osnovanie_id', '$sostav_family', '$tip_home', '$document_id', '$user_id', '$status_id')";
    
    if (mysqli_query($conn, $sql)) {
        $message = "<div class='success'>Заявка успешно отправлена! Вы можете отследить её статус в разделе <a href='my_requests.php'>Мои заявки</a>.</div>";
    } else {
        $message = "<div class='error'>Ошибка: " . mysqli_error($conn) . "</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Личный кабинет - Матпомощь</title>
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
                <span class="user-info"><?= htmlspecialchars($_SESSION['fio']) ?></span>
                <a href="my_requests.php">Мои заявки</a>
                <a href="login.php?logout=1">Выйти</a>
            </div>
        </div>
    </header>
    <main>
        <h2 class="page-title">Подать заявку на матпомощь</h2>
        <div class="auth-form">
            <?= $message ?>
            <form method="POST">
                <label>Основание для получения помощи</label>
                <select name="osnovanie_id" required>
                    <option value="1">Потеря кормильца</option>
                    <option value="2">Тяжелое заболевание</option>
                </select>
                <label>Состав семьи (кол-во человек)</label>
                <input type="text" name="sostav_family" required placeholder="Например: 4">
                <label>Тип жилья</label>
                <input type="text" name="tip_home" required placeholder="Например: Квартира">
                <button type="submit" name="submit_request">Отправить заявку</button>
            </form>
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
