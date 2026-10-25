<?php
/**
 * Страница конкретной модели автомобиля
 * Файл: cars/index.php
 */

// 1. Достаем id из URL (защита от SQL-инъекций и прочего мусора через (int))
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// 2. Путь к JSON-файлу с данными (поднимаемся на уровень выше из папки cars)
$dataFile = __DIR__ . '/../assets/data/cars.json';
$car = null;

// 3. Ищем нужную машину по ID
if ($id > 0 && file_exists($dataFile)) {
    $json = json_decode(file_get_contents($dataFile), true);

    if (!empty($json['cars'])) {
        foreach ($json['cars'] as $item) {
            if ((int)$item['id'] === $id) {
                $car = $item;
                break;
            }
        }
    }
}

// 4. Динамическое SEO (настраиваем ДО подключения шапки, чтобы вкладка браузера называлась правильно)
if ($car) {
    $pageTitle = "Porsche {$car['model']} — Характеристики и цвета";
    $pageDescription = "Все подробности о Porsche {$car['model']}: технические характеристики, доступные цвета, цена и галерея фото.";
} else {
    $pageTitle = 'Модель не найдена — Porsche Fan Site';
    $pageDescription = 'Запрашиваемая модель не найдена в нашем каталоге.';
}

// 5. Подключаем шапку сайта
require_once __DIR__ . '/../template/header.php';

// 6. Подключаем компонент страницы машины
require_once __DIR__ . '/../components/car-page/component.php';

// 7. Подключаем стили (абсолютный путь от корня сайта, чтобы работало из любой папки)
echo '<link rel="stylesheet" href="/template/components/car-page/style.css">';

// 8. Выводим страницу или красивую заглушку, если машины с таким ID нет
if ($car) {
    echo renderCarPage($car);
} else {
    echo '<div style="text-align:center; color:#fff; padding: 10rem 2rem; min-height: 60vh; display: flex; flex-direction: column; justify-content: center; align-items: center;">'
        . '<h1 style="font-size:2.5rem; margin-bottom: 1rem; font-weight: 800;">Модель не найдена</h1>'
        . '<p style="color:#aaa; margin-bottom: 2rem; font-size: 1.1rem;">Возможно, ссылка устарела или такой модели нет в каталоге.</p>'
        . '<a href="/models/index.php" style="color:#d4a017; text-decoration:none; font-weight: 600; border: 1px solid #d4a017; padding: 0.8rem 2rem; border-radius: 3rem; transition: all 0.3s ease;" onmouseover="this.style.background=\'#d4a017\'; this.style.color=\'#000\';" onmouseout="this.style.background=\'transparent\'; this.style.color=\'#d4a017\';">← Назад к моделям</a>'
        . '</div>';
}

// 9. Подключаем футер
require_once __DIR__ . '/../template/footer.php';