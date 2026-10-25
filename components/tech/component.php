<?php
/**
 * Компонент страницы Технологий
 * Файл: components/tech/component.php
 *
 * Выводит сетку с инженерными технологиями Porsche, счетчиками и 3D-эффектом.
 */
function renderTechPage() {
    // 1. Данные для технологий
    $technologies = [
        [
            'title' => 'Коробка передач PDK',
            'subtitle' => 'Скорость мысли',
            'spec_value' => 0.02,
            'spec_decimals' => 2,
            'spec_suffix' => ' сек',
            'spec_text' => 'на переключение',
            'desc' => 'Двойное сцепление позволяет переключать передачи без разрыва потока мощности. Быстрее, чем моргает глаз.',
            'icon' => 'bi-lightning-charge'
        ],
        [
            'title' => 'Оппозитный двигатель',
            'subtitle' => 'Сердце спорткара',
            'spec_value' => 9000,
            'spec_decimals' => 0,
            'spec_suffix' => '',
            'spec_text' => 'максимальные обороты',
            'desc' => 'Плоский силуэт двигателя снижает центр тяжести, обеспечивая идеальную развесовку и управляемость.',
            'icon' => 'bi-gear-wide-connected'
        ],
        [
            'title' => 'Матричные LED-фары',
            'subtitle' => 'Видеть невидимое',
            'spec_value' => 84,
            'spec_decimals' => 0,
            'spec_suffix' => '',
            'spec_text' => 'светодиода на фару',
            'desc' => 'Интеллектуальная система света вырезает встречные машины из светового пучка, не ослепляя других водителей.',
            'icon' => 'bi-lightbulb'
        ],
        [
            'title' => 'Керамические тормоза (PCCB)',
            'subtitle' => 'Мгновенная остановка',
            'spec_value' => 100,
            'spec_decimals' => 0,
            'spec_suffix' => '%',
            'spec_text' => 'замедление без устали',
            'desc' => 'Композитные тормозные диски из карбида кремния обеспечивают феноменальную стойкость к перегреву и весят на 50% меньше чугуна.',
            'icon' => 'bi-disc'
        ],
        [
            'title' => 'Активная подвеска (PASM)',
            'subtitle' => 'Баланс комфорта',
            'spec_value' => 3,
            'spec_decimals' => 0,
            'spec_suffix' => ' режима',
            'spec_text' => 'жесткости амортизаторов',
            'desc' => 'Электронная система непрерывно регулирует жесткость амортизаторов, подстраиваясь под стиль вождения и качество дороги.',
            'icon' => 'bi-sliders'
        ],
        [
            'title' => 'Полный привод (PTM)',
            'subtitle' => 'Сцепление с дорогой',
            'spec_value' => 100,
            'spec_decimals' => 0,
            'spec_suffix' => '%',
            'spec_text' => 'мгновенная передача момента',
            'desc' => 'Многодисковая муфта с электронным управлением моментально перебрасывает крутящий момент на переднюю ось, когда это необходимо.',
            'icon' => 'bi-arrow-left-right'
        ],
        [
            'title' => 'Архитектура 800V',
            'subtitle' => 'Электрическая мощь',
            'spec_value' => 5,
            'spec_decimals' => 0,
            'spec_suffix' => ' мин',
            'spec_text' => 'до 100 км запаса хода',
            'desc' => 'Инновационная 800-вольтовая система Taycan позволяет заряжать батарею на 100 км пробега всего за 5 минут на станциях быстрой зарядки.',
            'icon' => 'bi-battery-charging'
        ],
        [
            'title' => 'Активная аэродинамика',
            'subtitle' => 'Прижаты к земле',
            'spec_value' => 100,
            'spec_decimals' => 0,
            'spec_suffix' => '%',
            'spec_text' => 'контроля на скорости',
            'desc' => 'Спойлеры и закрылки автоматически меняют угол наклона в зависимости от скорости, создавая необходимое прижимное усилие.',
            'icon' => 'bi-wind'
        ]
    ];

    // 2. Буферизация вывода
    ob_start();
    ?>

    <section class="tech-section">
        <div class="tech-header">
            <span class="tech-badge">ИНЖЕНЕРНАЯ МЫСЛЬ</span>
            <h2 class="tech-title">Технологии Porsche</h2>
            <p class="tech-subtitle">Где страсть встречается с точным расчетом</p>
        </div>

        <div class="tech-grid">
            <?php foreach ($technologies as $tech): ?>
                <!-- Карточка технологии (с классом для анимации и атрибутом для 3D-наклона) -->
                <div class="tech-card tech-card--animated" data-tilt>
                    <div class="tech-card__glow"></div>

                    <div class="tech-card__header">
                        <div class="tech-icon">
                            <i class="bi <?= htmlspecialchars($tech['icon']) ?>"></i>
                        </div>
                        <span class="tech-card__subtitle"><?= htmlspecialchars($tech['subtitle']) ?></span>
                    </div>

                    <h3 class="tech-card__title"><?= htmlspecialchars($tech['title']) ?></h3>

                    <div class="tech-card__spec-wrap">
                        <!-- Число для анимации счетчика -->
                        <span class="tech-card__spec"
                              data-target="<?= htmlspecialchars($tech['spec_value']) ?>"
                              data-decimals="<?= htmlspecialchars($tech['spec_decimals']) ?>">
                              0<?= $tech['spec_decimals'] > 0 ? '.' . str_repeat('0', $tech['spec_decimals']) : '' ?>
                        </span>
                        <span class="tech-card__spec-suffix"><?= htmlspecialchars($tech['spec_suffix']) ?></span>
                        <span class="tech-card__spec-text"><?= htmlspecialchars($tech['spec_text']) ?></span>
                    </div>

                    <p class="tech-card__desc"><?= htmlspecialchars($tech['desc']) ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- Подключаем внешний скрипт для анимаций и 3D-эффекта -->
    <script src="/components/tech/script.js"></script>

    <?php
    return ob_get_clean();
}