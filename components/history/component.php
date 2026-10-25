<?php
/**
 * Компонент страницы Истории
 * Файл: components/history/component.php
 *
 * Выводит таймлайн с историческими событиями и цитатой основателя.
 */
function renderHistory() {
    // 1. Данные для таймлайна
    $events = [
        [
            'year' => '1948',
            'title' => 'Рождение легенды: Porsche 356',
            'text' => 'Фердинанд Порше создает первый спортивный автомобиль под маркой Porsche. Легкий, маневренный и невероятно быстрый.',
            'image' => '/components/history/images/1948-356.jpg'
        ],
        [
            'year' => '1963',
            'title' => 'Дебют Porsche 911',
            'text' => 'На Франкфуртском автосалоне представлен 911-й (изначально 901). Он задал вектор развития бренда на десятилетия вперед.',
            'image' => '/components/history/images/1963-911.jpg'
        ],
        [
            'year' => '1970',
            'title' => 'Триумф в Ле-Мане',
            'text' => 'Porsche 917K одерживает первую из 19 абсолютных побед в легендарном 24-часовом марафоне Ле-Ман.',
            'image' => '/components/history/images/1970-917.jpg'
        ],
        [
            'year' => '2003',
            'title' => 'Смелое решение: Cayenne',
            'text' => 'Выход первого внедорожника Porsche. Многие критиковали это, но Cayenne спас компанию и принес ей рекордные прибыли.',
            'image' => '/components/history/images/2003-cayenne.jpg'
        ],
        [
            'year' => '2019',
            'title' => 'Электрическое будущее: Taycan',
            'text' => 'Porsche доказывает, что электромобиль может быть настоящим спорткаром, выпуская Taycan с 800-вольтовой архитектурой.',
            'image' => '/components/history/images/2019-taycan.jpg'
        ]
    ];

    // 2. Буферизация вывода
    ob_start();
    ?>

    <section class="history-section" id="timeline">
        <div class="history-blocks-wrap">
            <?php foreach ($events as $index => $event):
                // Чередуем стороны для блоков (зигзагом)
                $isReverse = $index % 2 !== 0 ? 'reverse' : '';
                ?>
                <div class="history-block <?= $isReverse ?>">
                    <!-- Точка на центральной линии -->
                    <div class="timeline-dot"></div>

                    <!-- Картинка (выезжает при скролле) -->
                    <div class="history-block__image reveal-anim">
                        <img src="<?= htmlspecialchars($event['image']) ?>" alt="<?= htmlspecialchars($event['title']) ?>" loading="lazy" onerror="this.style.display='none'">
                        <!-- Золотой бейдж с годом -->
                        <div class="history-year-badge"><?= htmlspecialchars($event['year']) ?></div>
                    </div>

                    <!-- Текстовый блок (выезжает при скролле) -->
                    <div class="history-block__content reveal-anim">
                        <!-- Огромная цифра года на фоне -->
                        <div class="history-bg-year"><?= htmlspecialchars($event['year']) ?></div>
                        <h3 class="history-block__title"><?= htmlspecialchars($event['title']) ?></h3>
                        <p class="history-block__desc"><?= htmlspecialchars($event['text']) ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Цитата основателя -->
        <div class="history-quote">
            <div class="quote-icon">“</div>
            <p class="quote-text">Изначально я искал спортивный автомобиль, но не смог его найти. Тогда я решил создать его сам.</p>
            <p class="quote-author">— Ферри Порше, основатель компании</p>
        </div>
    </section>

    <!-- Подключаем внешний скрипт для анимации появления -->
    <script src="/components/history/script.js"></script>

    <?php
    return ob_get_clean();
}