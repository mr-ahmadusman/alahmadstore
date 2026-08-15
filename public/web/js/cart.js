document.addEventListener('DOMContentLoaded', function () {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

    // ---- Cart drawer HTML replace hone ke baad bhi "open/active" state bani rahe ----
    function updateCartUI(data) {
        document.querySelectorAll('.bigcounter, .cart-counter').forEach(el => {
            el.textContent = data.cart_count;
        });

        const drawer = document.getElementById('cart-drawer');
        if (drawer && data.drawer_html) {
            const wasActive = drawer.classList.contains('active'); // drawer khula tha ya nahi, yaad rakho
            drawer.outerHTML = data.drawer_html;                   // naya HTML lagao

            const newDrawer = document.getElementById('cart-drawer'); // naya element dobara select karo
            if (wasActive && newDrawer) {
                newDrawer.classList.add('active'); // agar khula tha, to naye element pe bhi 'active' laga do
            }
        }
    }

    function openCartDrawer() {
    const drawer = document.getElementById('cart-drawer');
    if (drawer) drawer.classList.add('active');
    document.querySelector('.bg-screen')?.classList.add('active');
    document.body.classList.add('hidden');
    }

    // ---- Header cart icon click — drawer khole, cart page pe navigate NA kare ----
    document.addEventListener('click', function (e) {
        const cartIcon = e.target.closest('.js-cart-icon');
        if (cartIcon) {
            e.preventDefault();
            openCartDrawer();
        }
    });

    // ---- Home page "Add to cart" link (href="#0") — jump na kare, form AJAX submit kare ----
    document.addEventListener('click', function (e) {
        const link = e.target.closest('.js-add-to-cart-link');
        if (link) {
            e.preventDefault();
            const form = link.nextElementSibling;
            if (form && form.classList.contains('js-add-to-cart-form')) {
                form.requestSubmit();
            }
        }
    });

    // ---- Add to cart form submit (home page + product detail page dono) ----
    document.addEventListener('submit', function (e) {
        if (!e.target.classList.contains('js-add-to-cart-form')) return;
        e.preventDefault();

        const form = e.target;

        fetch(form.action, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            },
            body: new FormData(form)
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                updateCartUI(data);
                openCartDrawer();
                if (window.showToast) window.showToast('Product added to cart!');
            }
        })
        .catch(err => console.error('Add to cart failed:', err));
    });

    // ---- Quantity +/- aur remove (drawer ke andar), event delegation se ----
    // Delegation zaroori hai kyunke drawer baar-baar outerHTML se replace hota hai,
    // isliye buttons pe seedha listener nahi laga sakte — document pe lagana hoga.
    document.addEventListener('click', function (e) {

        // Increase / Decrease
        const qtyBtn = e.target.closest('.js-qty-adjust');
        if (qtyBtn) {
            e.preventDefault();

            const wrap = qtyBtn.closest('.cart-item');
            const removeLink = wrap.querySelector('.cart-remove');
            const itemId = removeLink.getAttribute('href').split('/').pop();
            const action = qtyBtn.classList.contains('ju-qty-adjust-plus') ? 'increase' : 'decrease';

            fetch(`/cart/update/${itemId}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: new URLSearchParams({ action: action })
            })
            .then(res => res.json())
            .then(data => { if (data.success) updateCartUI(data); })
            .catch(err => console.error('Update quantity failed:', err));

            return;
        }

        // Remove item
        const removeBtn = e.target.closest('.cart-remove');
        if (removeBtn) {
            e.preventDefault();
            const url = removeBtn.getAttribute('href');

            fetch(url, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                }
            })
            .then(res => res.json())
            .then(data => { if (data.success) updateCartUI(data); })
            .catch(err => console.error('Remove item failed:', err));
        }
    });
});
