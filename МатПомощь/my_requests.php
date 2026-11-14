<?php
require 'db.php';
if (session_status() === PHP_SESSION_NONE) session_start();

if (!isset($_SESSION['user_id'])) { 
    header("Location: login.php"); 
    exit; 
}

$user_id = $_SESSION['user_id'];
$sql = "SELECT r.id_request, o.name_osnovanie, r.sostav_family, r.tip_home, s.status_name 
        FROM Requests r
        JOIN Osnovanie o ON r.osnovanie_id = o.id_osnovanie
        JOIN Statuses s ON r.status_id = s.id_status
        WHERE r.user_id = $user_id
        ORDER BY r.id_request DESC";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Мои заявки - Матпомощь</title>
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
                <a href="profile.php">Новая заявка</a>
                <a href="login.php?logout=1">Выйти</a>
            </div>
        </div>
    </header>
    <main>
        <h2 class="page-title">Мои заявки</h2>
        <div class="zayavki-list">
            <?php if (mysqli_num_rows($result) > 0): ?>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <div class="zayavka-card">
                        <h3>Заявка #<?= $row['id_request'] ?></h3>
                        <p><b>Основание:</b> <?= $row['name_osnovanie'] ?></p>
                        <p><b>Состав семьи:</b> <?= $row['sostav_family'] ?></p>
                        <p><b>Жилье:</b> <?= $row['tip_home'] ?></p>
                        
                        <?php 
                            $badgeClass = 'badge-new';
                            if ($row['status_name'] == 'Одобрена') $badgeClass = 'badge-done';
                            if ($row['status_name'] == 'Отклонена') $badgeClass = 'badge-rejected';
                        ?>
                        <p><b>Статус:</b> <span class="badge <?= $badgeClass ?>"><?= $row['status_name'] ?></span></p>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p style="grid-column: 1/-1;">У вас пока нет заявок. <a href="profile.php">Создать первую</a></p>
            <?php endif; ?>
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
