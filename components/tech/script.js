/**
 * Логика страницы Технологий (Анимация цифр, появление и 3D-наклон)
 * Файл: components/tech/script.js
 */
document.addEventListener('DOMContentLoaded', function () {
    // ==========================================
    // 1. АНИМАЦИЯ ЧИСЕЛ (Counter)
    // ==========================================
    const animateCounter = (el) => {
        const target = parseFloat(el.getAttribute('data-target'));
        const decimals = parseInt(el.getAttribute('data-decimals'));
        const duration = 2000; // 2 секунды
        let startTimestamp = null;

        const step = (timestamp) => {
            if (!startTimestamp) startTimestamp = timestamp;
            const progress = Math.min((timestamp - startTimestamp) / duration, 1);

            // Плавное замедление в конце (easeOutQuart)
            const easeOutProgress = 1 - Math.pow(1 - progress, 4);
            const current = target * easeOutProgress;

            // Форматируем число с нужным количеством знаков после запятой
            el.textContent = current.toFixed(decimals);

            if (progress < 1) {
                window.requestAnimationFrame(step);
            } else {
                el.textContent = target.toFixed(decimals); // Финальное число
            }
        };
        window.requestAnimationFrame(step);
    };

    // ==========================================
    // 2. АНИМАЦИЯ ПОЯВЛЕНИЯ (Scroll Reveal)
    // ==========================================
    const cards = document.querySelectorAll('.tech-card--animated');

    if (cards.length > 0) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');

                    // Запускаем счетчик внутри этой карточки (только один раз)
                    const spec = entry.target.querySelector('.tech-card__spec');
                    if (spec && !spec.classList.contains('counted')) {
                        spec.classList.add('counted');
                        animateCounter(spec);
                    }

                    observer.unobserve(entry.target); // Отписываемся после появления
                }
            });
        }, { threshold: 0.2 });

        cards.forEach(card => observer.observe(card));
    }

    // ==========================================
    // 3. 3D НАКЛОН ПРИ НАВЕДЕНИИ (Tilt)
    // ==========================================
    const tiltCards = document.querySelectorAll('[data-tilt]');

    if (tiltCards.length > 0) {
        tiltCards.forEach(card => {
            card.addEventListener('mousemove', (e) => {
                const rect = card.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;

                const centerX = rect.width / 2;
                const centerY = rect.height / 2;

                const rotateX = ((y - centerY) / centerY) * -5; // Максимум 5 градусов
                const rotateY = ((x - centerX) / centerX) * 5;

                card.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) translateY(-10px)`;
            });

            card.addEventListener('mouseleave', () => {
                card.style.transform = `perspective(1000px) rotateX(0) rotateY(0) translateY(0)`;
            });
        });
    }
});