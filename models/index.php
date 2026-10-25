<?php
/**
 * Страница каталога моделей (Модельный ряд)
 * Файл: models/index.php
 */

// 1. Настройка SEO (передается в header.php)
$pageTitle = 'Модельный ряд Porsche — Fan Site';
$pageDescription = 'Полный каталог автомобилей Porsche: 911, Taycan, Macan, Cayenne и Panamera. Характеристики, фото, доступные цвета и цены.';

// 2. Подключаем шапку сайта
require_once __DIR__ . '/../template/header.php';

// 3. Подключаем стили каталога
echo '<link rel="stylesheet" href="/template/components/models-catalog/style.css">';

// 4. Подключаем и выводим компонент каталога
require_once __DIR__ . '/../components/models-catalog/component.php';
echo renderModelsCatalog();

// 5. Подключаем футер
require_once __DIR__ . '/../template/footer.php';