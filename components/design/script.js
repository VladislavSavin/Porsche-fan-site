/**
 * Логика интерактивного слайдера "До/После" на странице Дизайна
 * Файл: components/design/script.js
 */
document.addEventListener('DOMContentLoaded', function () {
    const slider = document.getElementById('evoSlider');
    const imgWrap = document.getElementById('evoImgWrap');
    const handle = document.getElementById('evoHandle');

    // Защита: если элементов нет (например, мы на другой странице), выходим
    if (!slider || !imgWrap || !handle) return;

    let isDragging = false;

    // Функция перемещения ползунка
    function moveSlider(x) {
        const rect = slider.getBoundingClientRect();
        // Вычисляем позицию в процентах от 0 до 100
        let position = ((x - rect.left) / rect.width) * 100;

        // Ограничиваем движение рамками картинки
        if (position < 0) position = 0;
        if (position > 100) position = 100;

        // Применяем стили
        imgWrap.style.width = `${position}%`;
        handle.style.left = `${position}%`;
    }

    // --- Обработка мыши (для ПК) ---
    slider.addEventListener('mousedown', (e) => {
        isDragging = true;
        moveSlider(e.clientX);
    });

    window.addEventListener('mouseup', () => {
        isDragging = false;
    });

    window.addEventListener('mousemove', (e) => {
        if (!isDragging) return;
        moveSlider(e.clientX);
    });

    // --- Обработка касаний (для смартфонов) ---
    slider.addEventListener('touchstart', (e) => {
        isDragging = true;
        moveSlider(e.touches[0].clientX);
    }, { passive: true });

    window.addEventListener('touchend', () => {
        isDragging = false;
    });

    window.addEventListener('touchmove', (e) => {
        if (!isDragging) return;
        moveSlider(e.touches[0].clientX);
    }, { passive: true });
});