/**
 * Логика карусели (слайдера) для галереи на главной странице
 * Файл: components/gallery/script.js
 */
document.addEventListener('DOMContentLoaded', function () {
    const track = document.getElementById('sliderTrack');

    // Если трека нет, значит мы не на главной странице, выходим
    if (!track) return;

    const items = track.querySelectorAll('.slider-item');
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');
    const dotsContainer = document.getElementById('sliderDots');
    const sliderContainer = document.querySelector('.gallery-slider-block');

    if (items.length === 0 || !dotsContainer) return;

    let currentIndex = 0;
    const totalSlides = items.length;
    let autoPlayInterval;

    // 1. Создаем точки навигации
    items.forEach((_, i) => {
        const dot = document.createElement('div');
        dot.classList.add('slider-dot');
        if (i === 0) dot.classList.add('active');

        // Обработчик клика по точке
        dot.addEventListener('click', () => goToSlide(i));
        dotsContainer.appendChild(dot);
    });

    const dots = document.querySelectorAll('.slider-dot');

    // 2. Функции управления
    function updateSlider() {
        track.style.transform = `translateX(-${currentIndex * 100}%)`;
        dots.forEach((dot, i) => {
            dot.classList.toggle('active', i === currentIndex);
        });
    }

    function goToSlide(index) {
        currentIndex = index;
        updateSlider();
    }

    function nextSlide() {
        currentIndex = (currentIndex + 1) % totalSlides;
        updateSlider();
    }

    function prevSlide() {
        currentIndex = (currentIndex - 1 + totalSlides) % totalSlides;
        updateSlider();
    }

    // 3. Привязываем события к кнопкам
    if (nextBtn) nextBtn.addEventListener('click', nextSlide);
    if (prevBtn) prevBtn.addEventListener('click', prevSlide);

    // 4. Автопрокрутка (раз в 5 секунд)
    function startAutoPlay() {
        autoPlayInterval = setInterval(nextSlide, 5000);
    }

    function stopAutoPlay() {
        clearInterval(autoPlayInterval);
    }

    startAutoPlay();

    // 5. UX-фишка: Пауза при наведении на слайдер
    if (sliderContainer) {
        sliderContainer.addEventListener('mouseenter', stopAutoPlay);
        sliderContainer.addEventListener('mouseleave', startAutoPlay);
    }
});