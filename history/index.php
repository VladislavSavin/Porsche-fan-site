<?php
/**
 * Страница Истории
 * Файл: history/index.php
 */

// 1. Настройка SEO
$pageTitle = 'История Porsche — От 1948 до наших дней';
$pageDescription = 'Узнайте, как Фердинанд Порше создал легенду. Хронология великих моделей, победы в Ле-Мане и эволюция бренда.';

// 2. Подключаем шапку сайта
require_once __DIR__ . '/../template/header.php';

// --- 3. Hero-баннер (Архивный) ---
echo '<link rel="stylesheet" href="/template/components/banner-2/style.css">';
require_once __DIR__ . '/../components/banner-2/component.php';

echo renderHistoryHero([
    'badge'    => 'С 1948 ГОДА',
    'title'    => "История\nВеликого\nБренда",
    'subtitle' => 'От первого Porsche 356 до электрического Taycan. Более 75 лет эволюции, страсти и инноваций.',
    'year'     => '1948',
    'bg_image' => '/components/banner-2/images/banner-history.jpg'
]);

// --- 4. Основной контент (Таймлайн) ---
echo '<link rel="stylesheet" href="/template/components/history/style.css">';
require_once __DIR__ . '/../components/history/component.php';

echo renderHistory();

// 5. Подключаем футер
require_once __DIR__ . '/../template/footer.php';