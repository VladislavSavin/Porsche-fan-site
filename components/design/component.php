<?php
/**
 * Компонент страницы Дизайна
 * Файл: components/design/component.php
 *
 * Выводит философию дизайна, сетку с деталями и интерактивный слайдер эволюции.
 */
function renderDesignPage() {
    // Данные для блока "Детали"
    $details = [
        [
            'title' => 'Фары',
            'subtitle' => 'Взгляд в будущее',
            'text' => 'Узнаваемый силуэт четырехточечных LED-фар стал визитной карточкой современных моделей Porsche, продолжая эволюцию света.',
            'image' => '/components/design/images/headlight.jpg'
        ],
        [
            'title' => 'Аэродинамика',
            'subtitle' => 'Форма, рожденная ветром',
            'text' => 'Активный спойлер не просто украшение. Он автоматически меняет угол наклона, прижимая автомобиль к земле на высоких скоростях.',
            'image' => '/components/design/images/spoiler.jpg'
        ],
        [
            'title' => 'Кокпит',
            'subtitle' => 'Центр управления',
            'text' => 'Водитель в центре внимания. Эргономика салона выстроена так, чтобы все приборы были интуитивно понятны с первого взгляда.',
            'image' => '/components/design/images/interior.jpg'
        ],
        [
            'title' => 'Колеса',
            'subtitle' => 'Точка контакта',
            'text' => 'Легкосплавные диски и мощные тормозные суппорты — залог того, что вся мощь двигателя будет эффективно передана на асфальт.',
            'image' => '/components/design/images/wheel.jpg'
        ]
    ];

    ob_start();
    ?>
    <!-- 1. Вступление (Журнальный разворот) -->
    <section class="design-intro">
        <div class="design-intro-container">
            <div class="design-intro-text-block">
                <span class="design-badge">ФИЛОСОФИЯ ФОРМЫ</span>
                <h2 class="design-intro-title">Дизайн, который<br>не устаревает</h2>
                <p class="design-intro-text">За десятилетия силуэт Porsche менялся, но оставался узнаваемым. Мы не гонимся за модой, мы создаем классику, в которой каждая линия имеет функциональный смысл.</p>
            </div>
            <div class="design-intro-stats">
                <div class="intro-stat">
                    <span class="intro-stat-num">75+</span>
                    <span class="intro-stat-desc">лет эволюции</span>
                </div>
                <div class="intro-stat">
                    <span class="intro-stat-num">1</span>
                    <span class="intro-stat-desc">узнаваемый силуэт</span>
                </div>
                <div class="intro-stat">
                    <span class="intro-stat-num">∞</span>
                    <span class="intro-stat-desc">эмоций за рулем</span>
                </div>
            </div>
        </div>
    </section>

    <!-- 2. Сетка с деталями -->
    <section class="design-grid-section">
        <div class="design-grid">
            <?php foreach ($details as $item): ?>
                <div class="design-card">
                    <div class="design-card__img-wrap">
                        <img src="<?= htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item['title']) ?>" onerror="this.style.display='none'">
                    </div>
                    <div class="design-card__content">
                        <span class="design-card__subtitle"><?= htmlspecialchars($item['subtitle']) ?></span>
                        <h3 class="design-card__title"><?= htmlspecialchars($item['title']) ?></h3>
                        <p class="design-card__text"><?= htmlspecialchars($item['text']) ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- 3. Блок Эволюции (Интерактивный слайдер) -->
    <section class="design-evolution">
        <div class="evolution-header">
            <h2 class="evolution-title">Эволюция 911</h2>
            <p class="evolution-subtitle">Потяните ползунок, чтобы увидеть разницу</p>
        </div>

        <div class="evolution-slider-container">
            <div class="evolution-slider" id="evoSlider">
                <!-- Нижняя картинка (Современная) -->
                <img src="/components/design/images/modern.jpg" alt="Porsche 911 Modern" class="evolution-img img-modern" onerror="this.src='https://images.unsplash.com/photo-1503376713246-7f3b8b6382bb?q=80&w=1200&auto=format&fit=crop'">

                <!-- Верхняя картинка (Классическая), которая обрезается -->
                <div class="evolution-img-wrap" id="evoImgWrap">
                    <img src="/components/design/images/classic.jpg" alt="Porsche 911 Classic" class="evolution-img img-classic" onerror="this.src='https://images.unsplash.com/photo-1580273916550-e323be2ae537?q=80&w=1200&auto=format&fit=crop'">
                </div>

                <!-- Ползунок -->
                <div class="evolution-handle" id="evoHandle">
                    <div class="evolution-button">
                        <i class="bi bi-arrow-left-right"></i>
                    </div>
                </div>

                <!-- Года на картинке -->
                <div class="evolution-badge badge-left">1963</div>
                <div class="evolution-badge badge-right">2024</div>
            </div>

            <!-- Текст под слайдером -->
            <div class="evolution-desc-grid">
                <div class="evolution-desc-item">
                    <h4>Наследие</h4>
                    <p>«С него началась легенда. Чистая механика, минимализм и вечная классика.»</p>
                </div>
                <div class="evolution-desc-item">
                    <h4>Будущее</h4>
                    <p>«Технологии будущего в узнаваемом силуэте. Эволюция без компромиссов.»</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Подключаем внешний скрипт для слайдера -->
    <script src="/components/design/script.js"></script>
    <?php
    return ob_get_clean();
}