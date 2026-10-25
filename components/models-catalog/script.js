/**
 * Логика фильтрации карточек автомобилей в каталоге
 * Файл: components/models-catalog/script.js
 */
document.addEventListener('DOMContentLoaded', function () {
    const filterBtns = document.querySelectorAll('.filter-btn');
    const groups = document.querySelectorAll('.catalog-group');

    // Если на странице нет фильтров или групп, выходим
    if (filterBtns.length === 0 || groups.length === 0) return;

    filterBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            // 1. Переключаем активный класс у кнопок
            filterBtns.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');

            const filterValue = btn.getAttribute('data-filter');

            // 2. Скрываем/показываем группы машин
            groups.forEach(group => {
                const groupCategory = group.getAttribute('data-group');

                if (filterValue === 'all' || filterValue === groupCategory) {
                    group.style.display = 'block';
                    // Добавляем анимацию появления
                    group.style.animation = 'none'; // Сброс анимации
                    group.offsetHeight; // Триггер перерисовки (reflow)
                    group.style.animation = 'fadeInUp 0.6s ease forwards';
                } else {
                    group.style.display = 'none';
                }
            });
        });
    });
});