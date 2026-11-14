// script.js
document.addEventListener("DOMContentLoaded", function() {
    // --- Логика для слайдера ---
    const images = [
        "media/1.jpg",
        "media/2.jpg",
        "media/3.jpg",
        "media/4.jpg"
    ];
    
    let currentIndex = 0;
    const imgElement = document.getElementById('slideImg');

    // Если элемента нет на странице, скрипт слайдера не выполняется
    if (imgElement) {
        function showSlide(index) {
            if (index >= images.length) currentIndex = 0;
            if (index < 0) currentIndex = images.length - 1;
            imgElement.src = images[currentIndex];
        }

        window.nextSlide = function() {
            currentIndex++;
            showSlide(currentIndex);
        };

        window.prevSlide = function() {
            currentIndex--;
            showSlide(currentIndex);
        };

        setInterval(window.nextSlide, 3000);
    }

    // --- Логика для бургер-меню ---
    const burger = document.querySelector('.burger');
    const menu = document.querySelector('.header-right');

    if (burger && menu) {
        burger.addEventListener('click', function() {
            burger.classList.toggle('active');
            menu.classList.toggle('active');
        });
    }
});
