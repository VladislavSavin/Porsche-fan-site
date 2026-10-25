/**
 * Логика работы мобильного меню (Бургер-меню)
 * Файл: template/burger_menu.js
 */
document.addEventListener('DOMContentLoaded', function () {
    // 1. Находим элементы на странице
    const burgerBtn = document.getElementById('burgerBtn');
    const closeBtn = document.getElementById('closeBtn');
    const mobileMenu = document.getElementById('mobileMenu');

    // Если элементов меню нет на странице, прекращаем выполнение скрипта
    if (!burgerBtn || !mobileMenu) return;

    const menuLinks = mobileMenu.querySelectorAll('.nav-link');

    // 2. Функция открытия меню
    function openMenu() {
        mobileMenu.classList.add('active');
        document.body.style.overflow = 'hidden'; // Блокируем скролл сайта
        burgerBtn.setAttribute('aria-expanded', 'true'); // Для скринридеров
    }

    // 3. Функция закрытия меню
    function closeMenu() {
        mobileMenu.classList.remove('active');
        document.body.style.overflow = ''; // Возвращаем скролл
        burgerBtn.setAttribute('aria-expanded', 'false');
    }

    // 4. Обработчики событий
    // Открытие по клику на бургер
    burgerBtn.addEventListener('click', openMenu);

    // Закрытие по крестику
    if (closeBtn) {
        closeBtn.addEventListener('click', closeMenu);
    }

    // Закрытие при клике на любую ссылку в меню (чтобы перейти на страницу)
    menuLinks.forEach(link => {
        link.addEventListener('click', closeMenu);
    });

    // Закрытие по нажатию клавиши ESC (для удобства на ПК)
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && mobileMenu.classList.contains('active')) {
            closeMenu();
        }
    });
});