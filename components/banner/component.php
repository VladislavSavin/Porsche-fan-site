<?php
/**
 * Компонент универсального баннера (Hero)
 * Файл: components/banner/component.php
 *
 * @param array $data Настройки баннера:
 * - badge    (string) Верхняя надпись (например, "С 1948 ГОДА")
 * - title    (string) Главный заголовок
 * - subtitle (string) Подзаголовок
 * - btn_text (string) Текст кнопки (если пусто - кнопки не будет)
 * - btn_link (string) Ссылка кнопки (по умолчанию #)
 * - bg_image (string|null) Путь к фоновому изображению
 * @return string Готовый HTML-код баннера
 */
function renderBanner($data = []) {
    // 1. Значения по умолчанию (если что-то не передали)
    $defaults = [
        'badge'    => '',
        'title'    => '',
        'subtitle' => '',
        'btn_text' => '',
        'btn_link' => '#',
        'bg_image' => null,
    ];

    // Объединяем переданные данные с дефолтными
    $data = array_merge($defaults, $data);

    // 2. Формируем стиль для фона, если картинка передана
    $style = '';
    if (!empty($data['bg_image'])) {
        $style = ' style="background-image: url(\'' . htmlspecialchars($data['bg_image']) . '\');"';
    }

    // 3. Буферизация вывода (чтобы вернуть HTML как строку)
    ob_start(); ?>

    <section class="banner"<?= $style ?>>
        <div class="banner-overlay"></div>
        <div class="banner-content">

            <?php if ($data['badge'] !== ''): ?>
                <span class="banner-badge"><?= htmlspecialchars($data['badge']) ?></span>
            <?php endif; ?>

            <?php if ($data['title'] !== ''): ?>
                <h1 class="banner-title"><?= htmlspecialchars($data['title']) ?></h1>
            <?php endif; ?>

            <?php if ($data['subtitle'] !== ''): ?>
                <p class="banner-subtitle"><?= htmlspecialchars($data['subtitle']) ?></p>
            <?php endif; ?>

            <?php if ($data['btn_text'] !== ''): ?>
                <a href="<?= htmlspecialchars($data['btn_link']) ?>" class="banner-btn">
                    <?= htmlspecialchars($data['btn_text']) ?>
                </a>
            <?php endif; ?>

        </div>
    </section>

    <?php
    return ob_get_clean();
}

/**
 * Блок для разработчика: если открыть этот файл напрямую в браузере,
 * покажется тестовый баннер (для превью компонента без сборки страницы).
 */
if (basename($_SERVER['PHP_SELF']) === 'component.php') {
    echo renderBanner([
        'badge'    => 'С 1948 ГОДА',
        'title'    => 'PORSCHE',
        'subtitle' => 'Спортивные автомобили, рождённые из мечты',
        'btn_text' => 'Смотреть модели',
        'btn_link' => '#cars',
    ]);
}