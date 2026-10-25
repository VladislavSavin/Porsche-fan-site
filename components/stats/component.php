<?php
/**
 * Компонент статистики с анимацией цифр
 * Файл: components/stats/component.php
 *
 * @param array|null $stats Массив с данными статистики. Если null - используются значения по умолчанию.
 * @return string HTML
 */
function renderStats($stats = null) {
    // 1. Значения по умолчанию (если ничего не передано)
    if ($stats === null) {
        $stats = [
            ['value' => 385, 'suffix' => '',     'label' => 'л.с.', 'desc' => 'Мощность двигателя'],
            ['value' => 4.2, 'suffix' => 'с',    'label' => '',     'desc' => 'Разгон до 100 км/ч'],
            ['value' => 290, 'suffix' => '',     'label' => 'км/ч', 'desc' => 'Максимальная скорость'],
        ];
    }

    // 2. Буферизация вывода
    ob_start();
    ?>

    <section class="stats-section">
        <div class="stats-container">
            <?php foreach ($stats as $stat): ?>
                <div class="stat-item">
                    <div class="stat-number-wrapper">
                        <!-- Само число (анимируется) -->
                        <span class="stat-number" data-target="<?= htmlspecialchars($stat['value']) ?>">
                            0
                        </span>
                        <!-- Суффикс (км/ч, с и т.д.) -->
                        <span class="stat-suffix"><?= htmlspecialchars($stat['suffix']) ?></span>
                    </div>
                    <div class="stat-label"><?= htmlspecialchars($stat['label']) ?></div>
                    <div class="stat-desc"><?= htmlspecialchars($stat['desc']) ?></div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- Подключаем внешний скрипт для анимации цифр -->
    <script src="/components/stats/script.js"></script>

    <?php
    return ob_get_clean();
}

// Блок для разработчика: превью компонента напрямую
if (basename($_SERVER['PHP_SELF']) === 'component.php') {
    echo renderStats();
}