<?php
/**
 * Страница Дизайна
 * Файл: design/index.php
 */

// 1. Настройка SEO (передается в header.php)
$pageTitle = 'Дизайн Porsche — Философия формы';
$pageDescription = 'Почему Porsche узнаваем с первого взгляда? Изучаем эволюцию дизайна, детали и интерактивное сравнение поколений 911.';

// 2. Подключаем шапку сайта
require_once __DIR__ . '/../template/header.php';

// 3. Подключаем стили компонента дизайна
echo '<link rel="stylesheet" href="/template/components/design/style.css">';

// 4. Подключаем сам компонент и выводим его
require_once __DIR__ . '/../components/design/component.php';
echo renderDesignPage();

// 5. Подключаем футер
require_once __DIR__ . '/../template/footer.php';