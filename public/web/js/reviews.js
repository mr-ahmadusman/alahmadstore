document.addEventListener('DOMContentLoaded', function () {

    // ---- Home page review slider (Owl Carousel) ----
    if (typeof $ !== 'undefined' && $('#home-review-slider').length) {
        const $homeReviewSlider = $('#home-review-slider').owlCarousel({
            loop: false,
            margin: 0,
            nav: false,
            dots: true,
            responsive: {
                0:   { items: 1 },
                576: { items: 2 },
                992: { items: 3 }
            }
        });

        $('.swiper-prev-home-review').on('click', function () {
            $homeReviewSlider.trigger('prev.owl.carousel');
        });
        $('.swiper-next-home-review').on('click', function () {
            $homeReviewSlider.trigger('next.owl.carousel');
        });
    }

   
    // ---- Star rating input (product review form) ----
    const stars = document.querySelectorAll('#starRatingInput i');
    const ratingInput = document.getElementById('ratingValue');

    if (stars.length && ratingInput) {
        stars.forEach(function (star) {
            star.addEventListener('click', function () {
                const value = parseInt(this.dataset.value);
                ratingInput.value = value;
                stars.forEach(function (s) {
                    const sVal = parseInt(s.dataset.value);
                    s.classList.toggle('active', sVal <= value);
                    s.classList.toggle('fas', sVal <= value);
                    s.classList.toggle('far', sVal > value);
                });
            });
        });
    }

    // ---- Review media lightbox / slider ----
    const lightbox = document.getElementById('reviewLightbox');
    if (!lightbox) return;

    const items = Array.from(document.querySelectorAll('.review-media-item'));
    if (!items.length) return;

    const media = items.map(function (el) {
        return { type: el.dataset.type, src: el.dataset.src };
    });

    const imgEl = lightbox.querySelector('.review-lightbox-img');
    const videoEl = lightbox.querySelector('.review-lightbox-video');
    const closeBtn = lightbox.querySelector('.review-lightbox-close');
    const prevBtn = lightbox.querySelector('.review-lightbox-prev');
    const nextBtn = lightbox.querySelector('.review-lightbox-next');

    let currentIndex = 0;

    function render() {
        const item = media[currentIndex];
        videoEl.pause();

        if (item.type === 'video') {
            imgEl.style.display = 'none';
            videoEl.style.display = 'block';
            videoEl.src = item.src;
            videoEl.play().catch(function () {});
        } else {
            videoEl.style.display = 'none';
            imgEl.style.display = 'block';
            imgEl.src = item.src;
        }
    }

    function open(index) {
        currentIndex = index;
        render();
        lightbox.classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function close() {
        lightbox.classList.remove('active');
        videoEl.pause();
        videoEl.src = '';
        document.body.style.overflow = '';
    }

    function showPrev() {
        currentIndex = (currentIndex - 1 + media.length) % media.length;
        render();
    }

    function showNext() {
        currentIndex = (currentIndex + 1) % media.length;
        render();
    }

    items.forEach(function (el, index) {
        el.addEventListener('click', function () {
            open(index);
        });
    });

    closeBtn.addEventListener('click', close);
    prevBtn.addEventListener('click', showPrev);
    nextBtn.addEventListener('click', showNext);

    // Background click (not stage) closes modal
    lightbox.addEventListener('click', function (e) {
        if (e.target === lightbox) close();
    });

    // Keyboard navigation
    document.addEventListener('keydown', function (e) {
        if (!lightbox.classList.contains('active')) return;
        if (e.key === 'Escape') close();
        if (e.key === 'ArrowLeft') showPrev();
        if (e.key === 'ArrowRight') showNext();
    });
});
