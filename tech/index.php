<?php
/**
 * Страница Технологий
 * Файл: tech/index.php
 */

// 1. Настройка SEO (передается в header.php)
$pageTitle = 'Технологии Porsche — Инженерия будущего';
$pageDescription = 'Коробка PDK, оппозитные двигатели, 800-вольтовая архитектура Taycan и другие инновации, которые делают Porsche быстрее.';

// 2. Подключаем шапку сайта
require_once __DIR__ . '/../template/header.php';

// --- 3. Секция технологий ---
echo '<link rel="stylesheet" href="/template/components/tech/style.css">';
require_once __DIR__ . '/../components/tech/component.php';

echo renderTechPage();

// 4. Подключаем футер
require_once __DIR__ . '/../template/footer.php';