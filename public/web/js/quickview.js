document.addEventListener('DOMContentLoaded', function () {
    let galleryTop, galleryThumbs;

    document.addEventListener('click', function (e) {
        const btn = e.target.closest('.quickview[data-product-id]');
        if (!btn) return;

        const productId = btn.dataset.productId;

        fetch('/product-quickview/' + productId)
            .then(res => res.json())
            .then(data => {
                document.getElementById('qv-title').textContent = data.name;
                document.getElementById('qv-sold-count').textContent = data.sold_count;
                document.getElementById('qv-description').textContent = data.short_description || '';

                const newPriceEl = document.getElementById('qv-new-price');
                const oldPriceEl = document.getElementById('qv-old-price');
                const percentEl = document.getElementById('qv-percent');

                if (data.discount_price) {
                    newPriceEl.textContent = 'Rs ' + data.discount_price;
                    oldPriceEl.textContent = 'Rs ' + data.price;
                    oldPriceEl.style.display = '';
                    percentEl.textContent = '-' + data.discount_percent + '%';
                    percentEl.style.display = '';
                } else {
                    newPriceEl.textContent = 'Rs ' + data.price;
                    oldPriceEl.style.display = 'none';
                    percentEl.style.display = 'none';
                }

                const stockEl = document.getElementById('qv-stock');
                if (data.stock > 0) {
                    stockEl.innerHTML = '<span>In stock<i class="bi bi-check2"></i></span>';
                } else {
                    stockEl.innerHTML = '<span class="text-danger">Out of stock</span>';
                }

                document.getElementById('qv-quantity').value = 1;
                document.getElementById('qv-add-to-cart-form').action = data.add_to_cart_url;
                document.getElementById('qv-wishlist-form').action = data.wishlist_url;
                document.getElementById('qv-buy-now').href = data.detail_url;

                // Gallery images build karo
                const topWrap = document.getElementById('qv-gallery-top');
                const thumbWrap = document.getElementById('qv-gallery-thumbs');
                topWrap.innerHTML = '';
                thumbWrap.innerHTML = '';

                data.images.forEach(function (imgUrl) {
                    topWrap.innerHTML += `<div class="swiper-slide"><a href="${data.detail_url}"><img src="${imgUrl}" class="img-fluid" alt="${data.name}"></a></div>`;
                    thumbWrap.innerHTML += `<div class="swiper-slide"><a href="javascript:void(0)"><img src="${imgUrl}" class="img-fluid" alt="${data.name}"></a></div>`;
                });

                // Purane swiper instances destroy karo, naye banao (kyunki content change hua)
                if (galleryTop) galleryTop.destroy(true, true);
                if (galleryThumbs) galleryThumbs.destroy(true, true);

                galleryThumbs = new Swiper('.gallery-thumbs', {
                    loop: data.images.length > 1,
                    spaceBetween: 15,
                    slidesPerView: 4,
                });
                galleryTop = new Swiper('.gallery-top', {
                    loop: data.images.length > 1,
                    spaceBetween: 15,
                    navigation: {
                        nextEl: '.quick-next',
                        prevEl: '.quick-prev',
                    },
                    thumbs: { swiper: galleryThumbs },
                });
            })
            .catch(err => console.error('Quickview fetch failed:', err));
    });

    // Quantity +/- buttons (modal ke andar)
    document.addEventListener('click', function (e) {
        if (e.target.closest('#quickview .inc')) {
            const input = document.getElementById('qv-quantity');
            input.value = parseInt(input.value) + 1;
        }
        if (e.target.closest('#quickview .dec')) {
            const input = document.getElementById('qv-quantity');
            if (parseInt(input.value) > 1) input.value = parseInt(input.value) - 1;
        }
    });

    // Add to cart form submit (AJAX, cart drawer ke sath integrate)
    document.addEventListener('submit', function (e) {
        if (e.target.id !== 'qv-add-to-cart-form') return;
        e.preventDefault();

        const form = e.target;
        const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
        const formData = new FormData(form);
        formData.set('quantity', document.getElementById('qv-quantity').value);

        fetch(form.action, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            },
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                document.querySelectorAll('.bigcounter, .cart-counter').forEach(el => {
                    el.textContent = data.cart_count;
                });
                const drawer = document.getElementById('cart-drawer');
                if (drawer && data.drawer_html) {
                    const wasActive = drawer.classList.contains('active');
                    drawer.outerHTML = data.drawer_html;
                    const newDrawer = document.getElementById('cart-drawer');
                    if (newDrawer) newDrawer.classList.add('active');
                }
                // Quickview modal band karke drawer dikhao
                const qvModal = bootstrap.Modal.getInstance(document.getElementById('quickview'));
                if (qvModal) qvModal.hide();
            }
        })
        .catch(err => console.error('Add to cart failed:', err));
    });
});
