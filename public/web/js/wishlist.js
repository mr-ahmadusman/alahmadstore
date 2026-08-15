document.addEventListener("DOMContentLoaded", function () {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

    function updateWishlistUI(data) {
        document.querySelectorAll(".wishlist-counter").forEach((el) => {
            el.textContent = data.wishlist_count;
        });
    }

    function showEmptyWishlistMessage() {
        const container = document.getElementById("wishlist-page-content");
        if (container) {
            container.innerHTML = `
                <div class="wishlist-area">
                    <div class="wishlist-details text-center py-5">
                        <h4>Your wishlist is currently empty</h4>
                        <a href="/search" class="btn btn-style2 mt-3">Continue shopping</a>
                    </div>
                </div>`;
        }
    }

    function submitWishlistForm(url) {
        fetch(url, {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": csrfToken,
                Accept: "application/json",
            },
        })
            .then((res) => res.json())
            .then((data) => {
                if (data.success) {
                    updateWishlistUI(data);
                    if (window.showToast)
                        window.showToast(data.message || "Product added to wishlist!");
                }
            })
            .catch((err) => console.error("Add to wishlist failed:", err));
    }

    // ---- Add to wishlist (home page / trending products) ----
    document.addEventListener("click", function (e) {
        const link = e.target.closest(".js-add-to-wishlist-link");
        if (link) {
            e.preventDefault();
            const form = link.nextElementSibling;
            if (form && form.classList.contains("add-to-wishlist-form")) {
                submitWishlistForm(form.action);
            }
        }
    });

    // ---- Quickview modal wishlist button ----
    document.addEventListener("click", function (e) {
        const btn = e.target.closest("#qv-wishlist-btn");
        if (btn) {
            e.preventDefault();
            const form = document.getElementById("qv-wishlist-form");
            if (form && form.action) {
                submitWishlistForm(form.action);
            }
        }
    });

    // ---- Remove from wishlist (wishlist page ke andar) ----
    document.addEventListener("click", function (e) {
        const removeBtn = e.target.closest(".js-wishlist-remove");
        if (!removeBtn) return;

        e.preventDefault();
        const url = removeBtn.getAttribute("href");
        const row = removeBtn.closest("[data-wishlist-row]");

        fetch(url, {
            method: "DELETE",
            headers: {
                "X-CSRF-TOKEN": csrfToken,
                Accept: "application/json",
            },
        })
            .then((res) => res.json())
            .then((data) => {
                if (data.success) {
                    updateWishlistUI(data);
                    if (row) row.remove();
                    if (window.showToast)
                        window.showToast(data.message || "Product removed from wishlist.");

                    if (data.wishlist_count === 0) {
                        showEmptyWishlistMessage();
                    }
                }
            })
            .catch((err) => console.error("Remove from wishlist failed:", err));
    });

    // ---- Clear entire wishlist ----
    document.addEventListener("click", function (e) {
        const clearBtn = e.target.closest(".js-wishlist-clear");
        if (!clearBtn) return;

        e.preventDefault();

        if (!confirm("Are you sure you want to clear your wishlist?")) {
            return;
        }

        const url = clearBtn.getAttribute("href");

        fetch(url, {
            method: "DELETE",
            headers: {
                "X-CSRF-TOKEN": csrfToken,
                Accept: "application/json",
            },
        })
            .then((res) => res.json())
            .then((data) => {
                if (data.success) {
                    updateWishlistUI(data);
                    if (window.showToast)
                        window.showToast(data.message || "Wishlist cleared successfully.");
                    showEmptyWishlistMessage();
                }
            })
            .catch((err) => console.error("Clear wishlist failed:", err));
    });
});
