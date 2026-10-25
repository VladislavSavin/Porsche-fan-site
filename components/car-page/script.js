/**
 * Логика страницы автомобиля (галерея, смена цветов, модальное окно)
 * Файл: components/car-page/script.js
 */
document.addEventListener('DOMContentLoaded', function () {
    // Проверяем, что мы находимся на странице машины и данные переданы
    if (!window.carPageData) return;

    const carColorsData = window.carPageData.colors;
    const photosBase = window.carPageData.photosBase;

    // Элементы галереи
    const basePhoto = document.getElementById('carPhotoBase');
    const topPhoto = document.getElementById('carPhotoTop');
    const nameLabel = document.getElementById('activeColorName');
    const swatches = document.querySelectorAll('.color-swatch');
    const thumbGallery = document.getElementById('thumbnailGallery');

    let currentColorIndex = 0;
    let currentImageIndex = 0;
    let isAnimating = false;

    // ==========================================
    // 1. ЛОГИКА ГАЛЕРЕИ И ЦВЕТОВ
    // ==========================================

    // Плавная смена главного фото (кроссфейд)
    function changeMainImage(newSrc) {
        if (isAnimating || !newSrc || !basePhoto || !topPhoto) return;
        isAnimating = true;

        const tmp = new Image();
        tmp.onload = () => {
            topPhoto.src = newSrc;

            setTimeout(() => {
                topPhoto.style.opacity = 1;
            }, 50);

            setTimeout(() => {
                basePhoto.src = newSrc;
                topPhoto.style.transition = 'none';
                topPhoto.style.opacity = 0;

                setTimeout(() => {
                    topPhoto.style.transition = 'opacity 0.6s ease-in-out';
                    isAnimating = false;
                }, 50);
            }, 650);
        };
        tmp.src = newSrc;
    }

    // Отрисовка миниатюр
    function renderThumbnails(images) {
        if (!thumbGallery) return;
        thumbGallery.innerHTML = '';
        if (!images || images.length === 0) return;

        images.forEach((imgName, index) => {
            const thumb = document.createElement('div');
            thumb.className = `thumbnail-item ${index === currentImageIndex ? 'active' : ''}`;

            const img = document.createElement('img');
            img.src = photosBase + imgName;
            img.alt = 'Porsche фото ' + (index + 1);

            thumb.appendChild(img);

            // Клик по миниатюре
            thumb.addEventListener('click', () => {
                if (currentImageIndex === index) return;

                document.querySelectorAll('.thumbnail-item').forEach(t => t.classList.remove('active'));
                thumb.classList.add('active');

                currentImageIndex = index;
                changeMainImage(photosBase + imgName);
            });

            thumbGallery.appendChild(thumb);
        });
    }

    // Обработка кликов по цветам
    swatches.forEach((swatch, index) => {
        swatch.addEventListener('click', () => {
            if (swatch.classList.contains('active') || isAnimating) return;

            swatches.forEach(s => s.classList.remove('active'));
            swatch.classList.add('active');

            currentColorIndex = index;

            if (nameLabel) nameLabel.textContent = carColorsData[index].name;

            const newImages = carColorsData[index].images;

            // Если у нового цвета картинок меньше, сбрасываем на первую
            if (currentImageIndex >= newImages.length) {
                currentImageIndex = 0;
            }

            renderThumbnails(newImages);

            if (newImages.length > 0) {
                changeMainImage(photosBase + newImages[currentImageIndex]);
            }
        });
    });

    // Инициализация галереи при загрузке
    if (carColorsData.length > 0 && carColorsData[0].images.length > 0) {
        renderThumbnails(carColorsData[0].images);
    }

    // ==========================================
    // 2. ЛОГИКА МОДАЛЬНОГО ОКНА
    // ==========================================
    const orderBtn = document.querySelector('.btn-order');
    const modal = document.getElementById('orderModal');
    const modalOverlay = document.getElementById('modalOverlay');
    const modalClose = document.getElementById('modalClose');
    const modalCarModel = document.getElementById('modalCarModel');
    const modalFormStep = document.getElementById('modalFormStep');
    const modalSuccessStep = document.getElementById('modalSuccessStep');
    const orderForm = document.getElementById('orderForm');
    const modalSuccessClose = document.getElementById('modalSuccessClose');

    // Функция закрытия модалки
    function closeModal() {
        if (!modal) return;
        modal.classList.remove('active');
        document.body.style.overflow = '';

        setTimeout(() => {
            if (modalFormStep) modalFormStep.style.display = 'block';
            if (modalSuccessStep) modalSuccessStep.style.display = 'none';
            if (orderForm) orderForm.reset();
        }, 400);
    }

    // Открытие модалки
    if (orderBtn && modal) {
        orderBtn.addEventListener('click', () => {
            if (modalCarModel) modalCarModel.textContent = orderBtn.dataset.model || 'Porsche';
            modal.classList.add('active');
            document.body.style.overflow = 'hidden';
        });
    }

    // Вешаем события закрытия
    if (modalClose) modalClose.addEventListener('click', closeModal);
    if (modalOverlay) modalOverlay.addEventListener('click', closeModal);
    if (modalSuccessClose) modalSuccessClose.addEventListener('click', closeModal);

    // Обработка отправки формы
    if (orderForm) {
        orderForm.addEventListener('submit', (e) => {
            e.preventDefault();
            if (modalFormStep) modalFormStep.style.display = 'none';
            if (modalSuccessStep) modalSuccessStep.style.display = 'block';
        });
    }
});