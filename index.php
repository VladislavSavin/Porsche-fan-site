<?php
/**
 * Главная страница сайта
 * Файл: index.php
 */

// 1. Настройка SEO
$pageTitle = 'Porsche Fan Site — Главная';
$pageDescription = 'Добро пожаловать в мир Porsche. Изучайте историю бренда, философию дизайна и инновационные технологии.';

// 2. Подключаем шапку сайта
require_once __DIR__ . '/template/header.php';

// --- 3. Hero-баннер ---
echo '<link rel="stylesheet" href="/template/components/banner/style.css">';
require_once __DIR__ . '/components/banner/component.php';
echo renderBanner([
    'badge'    => 'С 1948 ГОДА',
    'title'    => 'PORSCHE',
    'subtitle' => 'Спортивные автомобили, рождённые из мечты',
    'btn_text' => 'Смотреть модели',
    'btn_link' => '/models/index.php',
    'bg_image' => '/components/banner/data/black-porsche-911-gt3.jpg',
]);

// --- 4. Блок статистики ---
echo '<link rel="stylesheet" href="/template/components/stats/style.css">';
require_once __DIR__ . '/components/stats/component.php';
echo renderStats();

// --- 5. Галерея-слайдер ---
echo '<link rel="stylesheet" href="/template/components/gallery/style.css">';
require_once __DIR__ . '/components/gallery/component.php';
echo renderGallery('С каждой милей ты понимаешь: это не просто машина, это стиль жизни.');

// 6. Подключаем футер
require_once __DIR__ . '/template/footer.php';