<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Главная - Портал Матпомощь</title>
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
                <a href="login.php">Вход</a>
                <a href="register.php">Регистрация</a>
            </div>
        </div>
    </header>

    <main>
        <h2 class="page-title">Добро пожаловать на портал государственной поддержки</h2>

        <div class="slider-container">
            <div class="slider">
                <img src="media/image06.jpg" alt="Слайд" id="slideImg">
            </div>
            <button class="slider-arrow" onclick="prevSlide()">&#10094;</button>
            <button class="slider-arrow" onclick="nextSlide()">&#10095;</button>
        </div>

        <div class="about">
            <h3>О портале</h3>
            <p>Наш портал создан для упрощения процедуры получения материальной помощи гражданам, оказавшимся в трудной жизненной ситуации. Здесь вы можете подать заявку, отслеживать её статус и получать консультации.</p>
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
