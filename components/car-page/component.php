<?php
/**
 * Компонент страницы автомобиля
 * Файл: components/car-page/component.php
 *
 * @param array $car Данные авто из cars.json
 * @return string HTML
 */
function renderCarPage($car) {
    $photosBase = '/assets/images/';
    $folder     = $car['folder'] ?? '';

    // Нормализация цветов (на случай старого формата с "file")
    $colors = $car['colors'] ?? [];
    foreach ($colors as &$color) {
        if (isset($color['file']) && !isset($color['images'])) {
            $color['images'] = [$color['file']];
        }
    }
    unset($color);

    $firstColor  = $colors[0] ?? null;
    $firstImages = $firstColor['images'] ?? [];
    $mainImage   = (!empty($firstImages) && $folder)
        ? $photosBase . $folder . '/' . $firstImages[0]
        : '';

    ob_start();
    ?>
    <section class="car-page">
        <div class="car-page__main">

            <!-- ЛЕВАЯ КОЛОНКА: Фото и миниатюры -->
            <div class="car-page__media">
                <!-- Главное фото (с эффектом кроссфейда) -->
                <div class="main-photo-wrap">
                    <img class="car-page__photo photo-base"
                         id="carPhotoBase"
                         src="<?= htmlspecialchars($mainImage) ?>"
                         alt="Porsche <?= htmlspecialchars($car['model']) ?>">

                    <img class="car-page__photo photo-top"
                         id="carPhotoTop"
                         src="<?= htmlspecialchars($mainImage) ?>"
                         alt="Porsche <?= htmlspecialchars($car['model']) ?>"
                         style="opacity: 0;">
                </div>

                <!-- Миниатюры (галерея) -->
                <div class="thumbnail-gallery" id="thumbnailGallery"></div>
            </div>

            <!-- ПРАВАЯ КОЛОНКА: Всё остальное -->
            <div class="car-page__info">
                <h1 class="car-page__title">Porsche <?= htmlspecialchars($car['model']) ?></h1>
                <div class="car-page__subtitle"><?= htmlspecialchars($car['subtitle']) ?></div>

                <p class="car-page__description"><?= htmlspecialchars($car['description']) ?></p>

                <!-- Цвета -->
                <?php if (count($colors) > 1): ?>
                    <div class="car-page__colors">
                        <div class="colors-label">
                            Цвет: <span id="activeColorName"><?= htmlspecialchars($firstColor['name']) ?></span>
                        </div>
                        <div class="color-swatches">
                            <?php foreach ($colors as $i => $color):
                                // Берем первую картинку для атрибута data-image
                                $firstColorImage = $color['images'][0] ?? '';
                                ?>
                                <button type="button"
                                        class="color-swatch<?= $i === 0 ? ' active' : '' ?>"
                                        data-image="<?= htmlspecialchars($photosBase . $folder . '/' . $firstColorImage) ?>"
                                        data-name="<?= htmlspecialchars($color['name']) ?>"
                                        style="--swatch: <?= htmlspecialchars($color['hex']) ?>;"
                                        title="<?= htmlspecialchars($color['name']) ?>"
                                        aria-label="<?= htmlspecialchars($color['name']) ?>"></button>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Характеристики -->
                <?php if (!empty($car['specs']) && is_array($car['specs'])): ?>
                    <div class="car-page__specs">
                        <h3 class="specs-title">Характеристики</h3>
                        <div class="specs-grid">
                            <?php foreach ($car['specs'] as $label => $value): ?>
                                <div class="spec-item">
                                    <span class="spec-label"><?= htmlspecialchars($label) ?></span>
                                    <span class="spec-value"><?= htmlspecialchars($value) ?></span>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Цена -->
                <?php if (!empty($car['price'])): ?>
                    <div class="car-page__price"><?= htmlspecialchars($car['price']) ?></div>
                <?php endif; ?>

                <!-- Кнопка -->
                <button class="btn-order" type="button" data-model="<?= htmlspecialchars($car['model']) ?>">
                    Оставить заявку
                </button>
            </div>
        </div>
    </section>

    <!-- Модальное окно заявки -->
    <div class="modal" id="orderModal">
        <div class="modal__overlay" id="modalOverlay"></div>
        <div class="modal__content">
            <button class="modal__close" id="modalClose"><i class="bi bi-x-lg"></i></button>

            <!-- Шаг 1: Форма -->
            <div class="modal__step" id="modalFormStep">
                <h2 class="modal__title">Оставить заявку</h2>
                <p class="modal__subtitle">Porsche <span id="modalCarModel"></span></p>

                <form id="orderForm">
                    <div class="modal__input-group">
                        <input type="text" placeholder="Ваше имя" required>
                    </div>
                    <div class="modal__input-group">
                        <input type="tel" placeholder="Номер телефона" required>
                    </div>
                    <button type="submit" class="modal__btn">Отправить заявку</button>
                </form>
            </div>

            <!-- Шаг 2: Успех -->
            <div class="modal__step modal__success" id="modalSuccessStep" style="display: none;">
                <div class="success-icon">
                    <i class="bi bi-check-lg"></i>
                </div>
                <h2 class="modal__title">Заявка одобрена!</h2>
                <p class="modal__text">Наш менеджер свяжется с вами в ближайшее время для согласования деталей.</p>
                <button class="modal__btn" id="modalSuccessClose">Отлично</button>
            </div>
        </div>
    </div>

    <!-- Передаем данные из PHP в JS (с защитой от XSS) -->
    <script>
        window.carPageData = {
            colors: <?= json_encode($colors, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) ?>,
            photosBase: "<?= $photosBase . $folder . '/' ?>"
        };
    </script>
    <!-- Подключаем вынесенный скрипт -->
    <script src="/components/car-page/script.js"></script>
    <?php
    return ob_get_clean();
}