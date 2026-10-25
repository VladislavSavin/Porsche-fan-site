<?php
/**
 * Кинематографичный архивный баннер (Hero) для страницы истории
 * Файл: components/banner-2/component.php
 *
 * @param array $data Данные баннера:
 * - badge    (string) Верхняя надпись (по умолчанию "LEGACY")
 * - title    (string) Главный заголовок (поддерживает перенос строки через \n)
 * - subtitle (string) Подзаголовок
 * - year     (string) Огромная цифра на фоне (по умолчанию "1948")
 * - bg_image (string) Путь к фоновому изображению
 * @return string Готовый HTML-код
 */
function renderHistoryHero($data = []) {
    // 1. Значения по умолчанию
    $defaults = [
        'badge'    => 'LEGACY',
        'title'    => "История\nВеликого\nБренда",
        'subtitle' => 'От первого Porsche 356 до электрического Taycan. Более 75 лет эволюции.',
        'year'     => '1948',
        'bg_image' => '/assets/images/history/hero-bg.jpg'
    ];

    $data = array_merge($defaults, $data);

    // 2. Буферизация вывода
    ob_start();
    ?>

    <section class="history-hero">
        <!-- Фоновое изображение -->
        <div class="history-hero__bg" style="background-image: url('<?= htmlspecialchars($data['bg_image']) ?>');"></div>

        <!-- Затемняющий слой -->
        <div class="history-hero__overlay"></div>

        <div class="history-hero__content">
            <!-- Огромная полупрозрачная цифра на фоне -->
            <div class="history-hero__year-bg"><?= htmlspecialchars($data['year']) ?></div>

            <?php if (!empty($data['badge'])): ?>
                <span class="history-hero__badge"><?= htmlspecialchars($data['badge']) ?></span>
            <?php endif; ?>

            <!-- Заголовок (выводим безопасно, сохраняя переносы строк) -->
            <h1 class="history-hero__title"><?= nl2br(htmlspecialchars($data['title'])) ?></h1>

            <?php if (!empty($data['subtitle'])): ?>
                <p class="history-hero__subtitle"><?= htmlspecialchars($data['subtitle']) ?></p>
            <?php endif; ?>
        </div>

        <!-- Индикатор скролла (прижат к низу экрана) -->
        <div class="history-hero__scroll">
            <span>Листайте вниз</span>
            <div class="history-hero__line"></div>
        </div>
    </section>

    <?php
    return ob_get_clean();
}