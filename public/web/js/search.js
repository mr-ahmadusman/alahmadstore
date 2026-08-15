const input = document.getElementById('search-box');

const result = document.getElementById('search-suggestions');

if (input) {

    input.addEventListener('keyup', function () {

        let q = this.value;

        if (q.length < 2) {

            result.style.display = 'none';

            return;

        }

        fetch('/search/suggestions?q=' + q)

            .then(res => res.json())

            .then(data => {

                let html = '';

                if (data.products.length) {

                    html += '<div class="search-title">Products</div>';

                    data.products.forEach(item => {

                        html += `
<a href="/product/${item.slug}">
${item.name}
</a>
`;

                    });

                }

                if (data.categories.length) {

                    html += '<div class="search-title">Categories</div>';

                    data.categories.forEach(item => {

                        html += `
<a href="/category/${item.slug}">
${item.name}
</a>
`;

                    });

                }

                if (data.subcategories.length) {

                    html += '<div class="search-title">Subcategories</div>';

                    data.subcategories.forEach(item => {

                        html += `
<a href="/subcategory/${item.slug}">
${item.name}
</a>
`;

                    });

                }

                result.innerHTML = html;

                result.style.display = 'block';

            });

    });

    document.addEventListener('click', function (e) {

        if (!result.contains(e.target) && e.target != input) {

            result.style.display = 'none';

        }

    });

}
