/**
 * Анимация появления блоков при скролле для страницы Истории
 * Файл: components/history/script.js
 */
document.addEventListener('DOMContentLoaded', function () {
    const animElements = document.querySelectorAll('.reveal-anim');

    // Если элементов для анимации нет, выходим
    if (animElements.length === 0) return;

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                // Добавляем класс, который запускает CSS-анимацию
                entry.target.classList.add('is-visible');

                // Отключаем наблюдение за элементом, так как он уже появился
                observer.unobserve(entry.target);
            }
        });
    }, {
        threshold: 0.2 // Срабатывает, когда элемент виден на 20%
    });

    // Запускаем наблюдение за каждым элементом
    animElements.forEach(el => observer.observe(el));
});