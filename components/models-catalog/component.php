<?php
/**
 * Компонент каталога моделей (Модельный ряд)
 * Файл: components/models-catalog/component.php
 *
 * Выводит машины, сгруппированные по категориям, с возможностью фильтрации.
 */
function renderModelsCatalog() {
    // 1. Путь к JSON с данными (на два уровня вверх и в assets/data)
    $dataFile = __DIR__ . '/../../assets/data/cars.json';
    $photosPath = '/assets/images/'; // Путь к общим картинкам машин

    if (!file_exists($dataFile)) {
        return '<div style="color:red; text-align:center; padding: 2rem;">Ошибка: Файл базы данных cars.json не найден по пути ' . $dataFile . '</div>';
    }

    // 2. Загружаем данные
    $jsonData = file_get_contents($dataFile);
    $carsData = json_decode($jsonData, true);
    $cars = $carsData['cars'] ?? [];

    // 3. Группируем машины по категориям
    $groupedCars = [];
    $categoryNames = [
        '911' => '911',
        'macan' => 'Macan',
        'taycan' => 'Taycan',
        'cayenne' => 'Cayenne',
        'panamera' => 'Panamera'
    ];

    foreach ($cars as $car) {
        $cat = $car['category'] ?? 'other';
        $groupedCars[$cat][] = $car;
    }

    // 4. Буферизация вывода
    ob_start();
    ?>
    <section class="catalog-section">
        <div class="catalog-header">
            <h1 class="catalog-title">Модельный ряд</h1>
            <p class="catalog-subtitle">Выберите свой Porsche</p>
        </div>

        <!-- Фильтры (Вкладки) -->
        <div class="catalog-filters">
            <button class="filter-btn active" data-filter="all">Все</button>
            <button class="filter-btn" data-filter="911">911</button>
            <button class="filter-btn" data-filter="macan">Macan</button>
            <button class="filter-btn" data-filter="taycan">Taycan</button>
            <button class="filter-btn" data-filter="cayenne">Cayenne</button>
            <button class="filter-btn" data-filter="panamera">Panamera</button>
        </div>

        <!-- Вывод групп машин -->
        <?php foreach ($groupedCars as $catKey => $catCars):
            $displayName = $categoryNames[$catKey] ?? ucfirst($catKey);
            ?>
            <div class="catalog-group" data-group="<?= htmlspecialchars($catKey) ?>">
                <h2 class="catalog-group-title"><?= htmlspecialchars($displayName) ?></h2>

                <div class="catalog-grid">
                    <?php foreach ($catCars as $car):
                        $image = htmlspecialchars($photosPath . $car['image']);
                        ?>
                        <div class="catalog-card" data-category="<?= htmlspecialchars($catKey) ?>">
                            <div class="catalog-card__image-wrap">
                                <div class="catalog-card__glow"></div>
                                <img class="catalog-card__img" src="<?= $image ?>" alt="Porsche <?= htmlspecialchars($car['model']) ?>" loading="lazy">
                            </div>

                            <div class="catalog-card__body">
                                <div class="catalog-card__subtitle"><?= htmlspecialchars($car['subtitle']) ?></div>
                                <h3 class="catalog-card__title"><?= htmlspecialchars($car['model']) ?></h3>

                                <!-- Быстрые характеристики (4 главные) -->
                                <?php if (!empty($car['specs']) && is_array($car['specs'])):
                                    $displaySpecs = [];
                                    // Ищем нужные характеристики по ключевым словам
                                    foreach ($car['specs'] as $label => $value) {
                                        if (strpos($label, 'Мощность') !== false) $displaySpecs['Мощность'] = $value;
                                        if (strpos($label, 'Разгон') !== false) $displaySpecs['Разгон'] = $value;
                                        if (strpos($label, 'скорость') !== false || strpos($label, 'Скорость') !== false) $displaySpecs['Скорость'] = $value;
                                        if (strpos($label, 'Объём') !== false) $displaySpecs['Объём'] = $value;
                                        if (strpos($label, 'Батарея') !== false) $displaySpecs['Батарея'] = $value;
                                    }
                                    ?>
                                    <div class="catalog-card__quick-specs">
                                        <?php foreach ($displaySpecs as $label => $value): ?>
                                            <div class="quick-spec">
                                                <span class="quick-spec__label"><?= htmlspecialchars($label) ?></span>
                                                <span class="quick-spec__value"><?= htmlspecialchars($value) ?></span>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>

                                <div class="catalog-card__bottom">
                                    <?php if (!empty($car['price'])): ?>
                                        <div class="catalog-card__price"><?= htmlspecialchars($car['price']) ?></div>
                                    <?php endif; ?>

                                    <!-- Ссылка на страницу конкретной машины -->
                                    <a href="/cars/index.php?id=<?= (int)$car['id'] ?>" class="catalog-card__btn">
                                        Подробнее
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </section>

    <!-- Подключаем внешний скрипт для работы фильтров -->
    <script src="/components/models-catalog/script.js"></script>

    <?php
    return ob_get_clean();
}