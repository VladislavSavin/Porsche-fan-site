<?php
/**
 * Компонент галереи-слайдера с цитатой
 * Файл: components/gallery/component.php
 *
 * @param string $quote Вдохновляющая фраза
 * @return string HTML
 */
function renderGallery($quote = "Автомобиль — это не просто средство передвижения. Это продолжение вашей души.") {
    // 1. Указываем правильные пути к папке images
    $photosDir = __DIR__ . '/images/';
    $photosUrl = '/components/gallery/images/';

    if (!is_dir($photosDir)) {
        return '<!-- Ошибка: Папка с фото для галереи не найдена -->';
    }

    // 2. Ищем все картинки в папке
    $images = glob($photosDir . '*.{jpg,jpeg,png,webp,JPG,JPEG,PNG}', GLOB_BRACE);

    if (empty($images)) {
        return '<!-- В папке галереи пока нет картинок -->';
    }

    // 3. Буферизация вывода
    ob_start();
    ?>

    <section class="gallery-slider-section">
        <div class="gallery-slider-container">

            <!-- Левая часть: Текст -->
            <div class="gallery-text-block">
                <div class="quote-mark">“</div>
                <h2 class="gallery-quote"><?= htmlspecialchars($quote) ?></h2>
                <div class="quote-line"></div>
            </div>

            <!-- Правая часть: Слайдер -->
            <div class="gallery-slider-block">
                <div class="slider-window">
                    <div class="slider-track" id="sliderTrack">
                        <?php foreach ($images as $index => $imgPath):
                            $fileName = basename($imgPath);
                            ?>
                            <div class="slider-item">
                                <img src="<?= htmlspecialchars($photosUrl . $fileName) ?>"
                                     alt="Porsche Gallery <?= $index + 1 ?>"
                                     loading="lazy">
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Кнопки управления -->
                <div class="slider-controls">
                    <button class="slider-btn prev-btn" id="prevBtn" aria-label="Предыдущий слайд">
                        <i class="bi bi-chevron-left"></i>
                    </button>

                    <div class="slider-dots" id="sliderDots"></div>

                    <button class="slider-btn next-btn" id="nextBtn" aria-label="Следующий слайд">
                        <i class="bi bi-chevron-right"></i>
                    </button>
                </div>
            </div>

        </div>
    </section>

    <!-- Подключаем внешний скрипт для галереи -->
    <script src="/components/gallery/script.js"></script>

    <?php
    return ob_get_clean();
}

// Блок для разработчика (превью компонента напрямую)
if (basename($_SERVER['PHP_SELF']) === 'component.php') {
    echo renderGallery();
}