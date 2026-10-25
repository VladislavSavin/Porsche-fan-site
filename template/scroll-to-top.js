/**
 * Динамическая кнопка "Наверх" с индикатором прогресса
 * Файл: template/scroll-to-top.js
 */
document.addEventListener('DOMContentLoaded', function () {
    const scrollBtn = document.getElementById('scrollTopBtn');
    const progressBar = document.querySelector('.progress-circle__bar');

    if (!scrollBtn || !progressBar) return;

    // Длина окружности для десктопа (2 * Pi * 28)
    const CIRCUMFERENCE = 176;

    window.addEventListener('scroll', function () {
        // 1. Вычисляем позицию скролла
        const scrollTop = window.scrollY;
        const docHeight = document.documentElement.scrollHeight - window.innerHeight;

        // 2. Вычисляем процент прокрутки (от 0 до 1)
        let scrollPercent = scrollTop / docHeight;
        if (scrollPercent > 1) scrollPercent = 1;
        if (scrollPercent < 0) scrollPercent = 0;

        // 3. Заполняем круг прогресса
        // Смещение = (Длина окружности) - (Длина окружности * процент)
        const dashoffset = CIRCUMFERENCE - (CIRCUMFERENCE * scrollPercent);
        progressBar.style.strokeDashoffset = dashoffset;

        // 4. Показываем/скрываем кнопку (если прокрутили больше 300px)
        if (scrollTop > 300) {
            scrollBtn.classList.add('show');
        } else {
            scrollBtn.classList.remove('show');
        }
    }, { passive: true });

    // 5. Плавный скролл наверх при клике
    scrollBtn.addEventListener('click', function () {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
});