<?php
require 'db.php';
if (session_status() === PHP_SESSION_NONE) session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role_id'] != 1) {
    die("<div style='padding:20px; text-align:center; font-family:sans-serif;'>Доступ запрещен. <a href='login.php'>Войти как админ</a></div>");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['change_status'])) {
    $req_id = intval($_POST['req_id']);
    $new_status = intval($_POST['new_status']);
    mysqli_query($conn, "UPDATE Requests SET status_id=$new_status WHERE id_request=$req_id");
    header("Location: admin.php");
    exit;
}

$sql = "SELECT r.id_request, u.fio, o.name_osnovanie, r.sostav_family, r.tip_home, s.status_name, r.status_id 
        FROM Requests r
        JOIN Users u ON r.user_id = u.id_user
        JOIN Osnovanie o ON r.osnovanie_id = o.id_osnovanie
        JOIN Statuses s ON r.status_id = s.id_status
        ORDER BY r.id_request DESC";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Админ-панель - Матпомощь</title>
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
                <span class="user-info">Администратор</span>
                <a href="login.php?logout=1">Выйти</a>
            </div>
        </div>
    </header>
    <main>
        <h2 class="page-title">Все заявки</h2>
        <div class="zayavki-list">
            <?php if (mysqli_num_rows($result) > 0): ?>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <div class="zayavka-card">
                        <h3>Заявка #<?= $row['id_request'] ?></h3>
                        <p><b>Заявитель:</b> <?= htmlspecialchars($row['fio']) ?></p>
                        <p><b>Основание:</b> <?= $row['name_osnovanie'] ?></p>
                        <p><b>Семья:</b> <?= $row['sostav_family'] ?>, <b>Жилье:</b> <?= $row['tip_home'] ?></p>
                        
                        <?php 
                            $badgeClass = 'badge-new';
                            if ($row['status_name'] == 'Одобрена') $badgeClass = 'badge-done';
                            if ($row['status_name'] == 'Отклонена') $badgeClass = 'badge-rejected';
                        ?>
                        <p><b>Текущий статус:</b> <span class="badge <?= $badgeClass ?>"><?= $row['status_name'] ?></span></p>

                        <form method="POST" class="status-form">
                            <input type="hidden" name="req_id" value="<?= $row['id_request'] ?>">
                            <label>Изменить статус:</label>
                            <select name="new_status">
                                <option value="1" <?= $row['status_id'] == 1 ? 'selected' : '' ?>>Новая</option>
                                <option value="2" <?= $row['status_id'] == 2 ? 'selected' : '' ?>>Одобрена</option>
                                <option value="3" <?= $row['status_id'] == 3 ? 'selected' : '' ?>>Отклонена</option>
                            </select>
                            <button type="submit" name="change_status" style="margin-top:10px; padding:8px 15px; background:#1abc9c; color:#fff; border:none; border-radius:4px; cursor:pointer; width:100%; font-weight:bold;">Сохранить</button>
                        </form>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p style="grid-column: 1/-1;">Заявок пока нет.</p>
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
