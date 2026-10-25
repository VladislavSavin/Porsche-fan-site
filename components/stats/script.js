/**
 * Анимация цифр (счетчик) для блока статистики
 * Файл: components/stats/script.js
 */
document.addEventListener('DOMContentLoaded', function () {
    const numbers = document.querySelectorAll('.stat-number');

    // Если на странице нет блока статистики, выходим
    if (numbers.length === 0) return;

    // Храним состояние анимаций для каждого элемента (frameId и timeoutId)
    const animations = new Map();

    /**
     * Запуск анимации подсчета для конкретного элемента
     * @param {HTMLElement} obj - Элемент, в котором меняется число
     * @param {number} target - Конечное значение
     * @param {number} duration - Длительность анимации в мс
     */
    function animateValue(obj, target, duration = 1500) {
        // Если анимация для этого элемента уже идет, останавливаем ее перед новой
        if (animations.has(obj)) {
            cancelAnimationFrame(animations.get(obj).frameId);
            clearTimeout(animations.get(obj).timeoutId);
        }

        const isDecimal = target % 1 !== 0;
        let startTimestamp = null;

        const step = (timestamp) => {
            if (!startTimestamp) startTimestamp = timestamp;
            const progress = Math.min((timestamp - startTimestamp) / duration, 1);
            const current = progress * target;

            // Форматируем: если дробное - 1 знак после запятой, иначе - целое
            obj.innerHTML = isDecimal ? current.toFixed(1) : Math.floor(current);

            if (progress < 1) {
                const frameId = window.requestAnimationFrame(step);
                animations.set(obj, { frameId, timeoutId: animations.get(obj)?.timeoutId });
            } else {
                // 1. Подсчет закончился. Добавляем класс для мигания (CSS)
                obj.classList.add('blink');

                // 2. Ждем, пока промигает, затем сбрасываем
                const timeoutId = setTimeout(() => {
                    obj.classList.remove('blink');
                    obj.innerHTML = isDecimal ? '0.0' : '0';

                    // 3. Небольшая пауза перед новым запуском и запуск заново
                    const restartTimeout = setTimeout(() => {
                        animateValue(obj, target, duration);
                    }, 1000);

                    animations.set(obj, { frameId: null, timeoutId: restartTimeout });
                }, 3000); // Время мигания (3 секунды)

                animations.set(obj, { frameId: null, timeoutId });
            }
        };

        const initialFrame = window.requestAnimationFrame(step);
        animations.set(obj, { frameId: initialFrame, timeoutId: null });
    }

    /**
     * Остановка анимации (когда блок уходит с экрана)
     */
    function stopAnimation(obj) {
        if (animations.has(obj)) {
            cancelAnimationFrame(animations.get(obj).frameId);
            clearTimeout(animations.get(obj).timeoutId);
            animations.delete(obj);
        }
        obj.classList.remove('blink');
    }

    // Наблюдатель за появлением блока на экране
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            const target = parseFloat(entry.target.dataset.target);

            if (entry.isIntersecting) {
                // Блок появился на экране — запускаем анимацию
                animateValue(entry.target, target);
            } else {
                // Блок скрылся — останавливаем (чтобы не грузить процессор)
                stopAnimation(entry.target);
            }
        });
    }, { threshold: 0.5 }); // Срабатывает, когда видно 50% элемента

    // Запускаем наблюдение за каждым числом
    numbers.forEach(num => observer.observe(num));
});