<?php
/**
 * Шапка сайта (Header)
 * Файл: template/header.php
 */

// 1. Значения по умолчанию, если страница не передала свои переменные
$pageTitle = $pageTitle ?? 'Porsche Fan Site — Фан-проект';
$pageDesc  = $pageDescription ?? 'Независимый фанатский проект, посвященный легендарным автомобилям Porsche. История, дизайн, технологии и модельный ряд.';
$pageImage = $pageImage ?? '/assets/images/og-preview.jpg'; // Картинка-заглушка для соцсетей
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- SEO: Заголовок и Описание -->
    <title><?= htmlspecialchars($pageTitle) ?></title>
    <meta name="description" content="<?= htmlspecialchars($pageDesc) ?>">
    <meta name="keywords" content="Porsche, Порше, 911, Taycan, Macan, Cayenne, Panamera, автомобили, спорткары, фан-сайт">

    <!-- Open Graph (для красивых ссылок в Telegram, VK, Discord) -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="<?= htmlspecialchars($pageTitle) ?>">
    <meta property="og:description" content="<?= htmlspecialchars($pageDesc) ?>">
    <meta property="og:image" content="<?= htmlspecialchars($pageImage) ?>">

    <!-- Favicon (иконка вкладки) - убедись, что файл favicon.png лежит в корне сайта -->
    <link rel="icon" href="/favicon.png" type="image/png">

    <!-- Подключение внешних библиотек (Bootstrap) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <!-- Подключение глобальных стилей сайта -->
    <link rel="stylesheet" href="/template/style.css">
    <link rel="stylesheet" href="/template/burger_menu.css">
</head>
<body>

<!-- ШАПКА САЙТА -->
<div class="header">
    <div class="header-top">
        <div class="headerUp">
            <!-- Логотип ведет на главную страницу -->
            <a href="/"><?php require_once __DIR__ . '/includes/logo.php'?></a>
        </div>
        <button class="burger-btn" id="burgerBtn" aria-label="Открыть меню">
            <i class="bi bi-list"></i>
        </button>
    </div>

    <!-- Десктопное меню -->
    <div class="headerDown desktop-only">
        <?php require_once __DIR__ . '/includes/navigation.php'?>
    </div>
</div>

<!-- ПОЛНОЭКРАННОЕ МОБИЛЬНОЕ МЕНЮ -->
<div class="fullscreen-menu" id="mobileMenu">
    <div class="fullscreen-menu-header">
        <div class="logo">
            <img src="/template/includes/photos/logo.png" alt="Porsche Logo" class="logo-img">
            <span>PORSCHE</span>
            <span style="color:#d4a017;">•</span>
            <span>FAN SITE</span>
        </div>
        <button class="close-btn" id="closeBtn" aria-label="Закрыть меню">
            <i class="bi bi-x-lg"></i>
        </button>
    </div>
    <div class="fullscreen-menu-content">
        <nav class="nav-menu mobile-nav">
            <a href="/models/index.php" class="nav-link">Модели</a>
            <a href="/history/index.php" class="nav-link">История</a>
            <a href="/design/index.php" class="nav-link">Дизайн</a>
            <a href="/tech/index.php" class="nav-link">Технологии</a>
        </nav>
    </div>
</div>

<!-- Начало основного контейнера сайта (закрывается в footer.php) -->
<div class="container">

    <!-- Скрипт для работы бургер-меню -->
    <script src="/template/burger_menu.js"></script>