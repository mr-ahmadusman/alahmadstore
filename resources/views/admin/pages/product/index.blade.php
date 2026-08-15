@extends('admin.layouts.app')
@section('content')
<main class="main-wrapper">
    <div class="container-fluid">
        <div class="inner-contents">

<div class="container-fluid py-2" style="margin: auto;">
    <div class="row">
        <div class="col-lg-12">
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-lg border-0 d-flex align-items-center gap-2"
                role="alert" style="background-color: #d1e7dd;">
                <i class="bi bi-check-circle-fill text-success fs-4"></i>
                <div>
                    {{ session('success') }}
                </div>
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <div class="card border-0 p-5">
                <div
                    class="card-header pb-5 bg-transparent border-0 d-flex align-items-center justify-content-between gap-3">
                    <h4 class="mb-0">Products</h4>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProductModal">Add Product</button>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table id="table-1" class="display text-center">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Discount Price</th>
                                    <th>Category</th>
                                    <th>Subcategory</th>
                                    <th>Stock</th>
                                    <th>Status</th>
                                    <th>Image</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($products as $product)
                                <tr>
                                    <td>{{ $product->id }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>Rs {{ number_format($product->price, 2) }}</td>
                                    <td>Rs {{ $product->discount_price ? number_format($product->discount_price, 2) : 'N/A' }}</td>
                                    <td>{{ $product->category->name }}</td>
                                    <td>{{ $product->subcategory->name }}</td>
                                    <td>{{ $product->stock }}</td>
                                    <td>
                                       <form action="{{ route('admin.products.togglestatus', $product->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-sm {{ $product->status ? 'btn-success' : 'btn-danger' }}">
                                                {{ $product->status ? 'Active' : 'Inactive' }}
                                            </button>
                                        </form>
                                    </td>
                                    <td>
                                        @if($product->image)
                                            <img src="/{{ $product->image }}" alt="Image" width="100" style="cursor:pointer"
                                                 class="preview-image-trigger"
                                                 data-image="/{{ $product->image }}">
                                        @endif
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <a href="#" data-bs-toggle="dropdown" class="fs-24 text-gray">
                                                <i class="bi bi-three-dots-vertical"></i>
                                            </a>
                                            <div class="dropdown-menu p-0">
                                                {{-- View button: all product data safely passed as JSON in data-product --}}
                                                <a class="dropdown-item view-product-btn" href="#" data-bs-toggle="modal"
                                                    data-bs-target="#viewProductModal"
                                                    data-product='@json($product)'
                                                    data-category="{{ $product->category->name }}"
                                                    data-subcategory="{{ $product->subcategory->name }}">View</a>

                                                {{-- Edit button: all product data safely passed as JSON in data-product --}}
                                                <a class="dropdown-item edit-product-btn" href="#" data-bs-toggle="modal"
                                                    data-bs-target="#editProductModal"
                                                    data-product='@json($product)'
                                                    data-update-url="{{ route('admin.products.update', $product->id) }}">Edit</a>

                                                <a class="dropdown-item" href="{{ route('admin.product-images.index', $product->id) }}">Images</a>

                                                    <form action="{{ route('admin.products.destroy', $product->id) }}"
                                                        method="POST" onsubmit="return confirm('Are you sure?')" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="dropdown-item text-danger" type="submit">Delete</button>
                                                    </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Product Modal -->
<div class="modal fade modal-xl" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="addProductForm" method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addProductModalLabel">Add Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="category_id" class="form-label">Category</label>
                                <select class="form-control" id="category_id" name="category_id" required onchange="loadSubcategories(this.value)">
                                    <option value="">-- Select Category --</option>
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="subcategory_id" class="form-label">Subcategory</label>
                                <select class="form-control" id="subcategory_id" name="subcategory_id" required>
                                    <option value="">-- Select Subcategory --</option>
                                    @foreach($subcategories as $sub)
                                        <option value="{{ $sub->id }}">{{ $sub->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="name" class="form-label">Product Name</label>
                        <input class="form-control" type="text" id="name" name="name" required>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="price" class="form-label">Price (Rs)</label>
                                <input class="form-control" type="number" step="0.01" id="price" name="price" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="discount_price" class="form-label">Discount Price (Rs)</label>
                                <input class="form-control" type="number" step="0.01" id="discount_price" name="discount_price">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="stock" class="form-label">Stock</label>
                                <input class="form-control" type="number" id="stock" name="stock" value="0" min="0">
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="short_description" class="form-label">Short Description</label>
                        <textarea class="form-control" id="short_description" name="short_description" rows="2"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="4"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Product Image</label>
                        <input class="form-control" type="file" id="image" name="image" accept="image/*">
                    </div>

                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="status" name="status" value="1" checked>
                        <label class="form-check-label" for="status">Active</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Product</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Product Modal -->
<div class="modal fade modal-xl" id="editProductModal" tabindex="-1" aria-labelledby="editProductModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="editProductForm" method="POST" enctype="multipart/form-data" action="">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="editProductModalLabel">Edit Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="product_id" id="editProductId">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="editCategoryId" class="form-label">Category</label>
                                <select class="form-control" id="editCategoryId" name="category_id" required onchange="loadEditSubcategories(this.value)">
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="editSubcategoryId" class="form-label">Subcategory</label>
                                <select class="form-control" id="editSubcategoryId" name="subcategory_id" required>
                                    @foreach($subcategories as $sub)
                                        <option value="{{ $sub->id }}">{{ $sub->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="editName" class="form-label">Product Name</label>
                        <input class="form-control" type="text" id="editName" name="name" required>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="editPrice" class="form-label">Price (Rs)</label>
                                <input class="form-control" type="number" step="0.01" id="editPrice" name="price" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="editDiscountPrice" class="form-label">Discount Price (Rs)</label>
                                <input class="form-control" type="number" step="0.01" id="editDiscountPrice" name="discount_price">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="editStock" class="form-label">Stock</label>
                                <input class="form-control" type="number" id="editStock" name="stock" min="0">
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="editShortDescription" class="form-label">Short Description</label>
                        <textarea class="form-control" id="editShortDescription" name="short_description" rows="2"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="editDescription" class="form-label">Description</label>
                        <textarea class="form-control" id="editDescription" name="description" rows="4"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="editImage" class="form-label">Product Image</label>
                        <input class="form-control" type="file" id="editImage" name="image" accept="image/*">
                        <img id="editImagePreview" src="" alt="Current Image" width="100" class="mt-2">
                    </div>

                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="editStatus" name="status" value="1">
                        <label class="form-check-label" for="editStatus">Active</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update Product</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- View Product Modal -->
<div class="modal fade" id="viewProductModal" tabindex="-1" aria-labelledby="viewProductModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="viewProductModalLabel">View Product</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row align-items-center">
                    <div class="col-md-6 text-center mb-3 mb-md-0">
                        <img id="viewImage" src="" alt="Product Image" class="img-fluid shadow" style="max-height: 350px; object-fit: contain;">
                    </div>
                    <div class="col-md-6">
                        <p class="mb-2"><strong>Name:</strong> <span id="viewName"></span></p>
                        <p class="mb-2"><strong>Slug:</strong> <span id="viewSlug"></span></p>
                        <p class="mb-2"><strong>Price:</strong> Rs <span id="viewPrice"></span></p>
                        <p class="mb-2"><strong>Discount Price:</strong> Rs <span id="viewDiscountPrice"></span></p>
                        <p class="mb-2"><strong>Stock:</strong> <span id="viewStock"></span></p>
                        <p class="mb-2"><strong>Status:</strong> <span id="viewStatus"></span></p>
                        <p class="mb-2"><strong>Category:</strong> <span id="viewCategory"></span></p>
                        <p class="mb-2"><strong>Subcategory:</strong> <span id="viewSubcategory"></span></p>
                        <p class="mb-2"><strong>Short Description:</strong> <span id="viewShortDescription"></span></p>
                        <p class="mb-2"><strong>Description:</strong> <span id="viewDescription"></span></p>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <span class="text-muted small">Product Details</span>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Image Preview Modal -->
<div class="modal fade" id="imagePreviewModal" tabindex="-1" aria-labelledby="imagePreviewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-body text-center">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <img id="previewImage" src="" alt="Preview" style="max-width: 100%; max-height: 70vh; box-shadow: 0 2px 16px #0002; border-radius: 8px;">
            </div>
        </div>
    </div>
</div>

<script>
    // ---- VIEW MODAL: read data safely from data-product JSON (no more broken quotes) ----
    document.querySelectorAll('.view-product-btn').forEach(function (btn) {
        btn.addEventListener('click', function () {
            const product = JSON.parse(this.dataset.product);
            const category = this.dataset.category || '';
            const subcategory = this.dataset.subcategory || '';

            document.getElementById('viewName').textContent = product.name ?? '';
            document.getElementById('viewSlug').textContent = product.slug ?? '';
            document.getElementById('viewShortDescription').textContent = product.short_description ?? '';
            document.getElementById('viewDescription').textContent = product.description ?? '';
            document.getElementById('viewCategory').textContent = category;
            document.getElementById('viewSubcategory').textContent = subcategory;
            document.getElementById('viewPrice').textContent = product.price ?? '';
            document.getElementById('viewDiscountPrice').textContent = product.discount_price ?? 'N/A';
            document.getElementById('viewStock').textContent = product.stock ?? '';
            document.getElementById('viewStatus').textContent = product.status == 1 ? 'Active' : 'Inactive';

            const imgPath = product.image ? (product.image.startsWith('/') ? product.image : '/' + product.image) : '';
            document.getElementById('viewImage').src = imgPath;
        });
    });

    // ---- EDIT MODAL: read data safely from data-product JSON (no more broken quotes) ----
    document.querySelectorAll('.edit-product-btn').forEach(function (btn) {
        btn.addEventListener('click', function () {
            const product = JSON.parse(this.dataset.product);
            const updateUrl = this.dataset.updateUrl;

            const form = document.getElementById('editProductForm');
            form.action = updateUrl;

            document.getElementById('editProductId').value = product.id;
            document.getElementById('editName').value = product.name ?? '';
            document.getElementById('editShortDescription').value = product.short_description ?? '';
            document.getElementById('editDescription').value = product.description ?? '';
            document.getElementById('editImagePreview').src = product.image ? '/' + product.image : '';
            document.getElementById('editCategoryId').value = product.category_id;
            document.getElementById('editPrice').value = product.price ?? '';
            document.getElementById('editDiscountPrice').value = product.discount_price ?? '';
            document.getElementById('editStock').value = product.stock ?? '';
            document.getElementById('editStatus').checked = product.status == 1;

            // Load subcategories for the selected category, then pre-select the correct one
            loadEditSubcategories(product.category_id, product.subcategory_id);
        });
    });

    // ---- IMAGE PREVIEW MODAL (converted from inline onclick to a listener) ----
    document.querySelectorAll('.preview-image-trigger').forEach(function (img) {
        img.addEventListener('click', function () {
            showImageModal(this.dataset.image);
        });
    });

    function showImageModal(imageUrl) {
        document.getElementById('previewImage').src = imageUrl;
        var imageModal = new bootstrap.Modal(document.getElementById('imagePreviewModal'));
        imageModal.show();
    }

    function loadSubcategories(categoryId) {
        if(categoryId) {
            fetch('/admin/subcategories/by-category/' + categoryId)
                .then(response => response.json())
                .then(data => {
                    const subcategorySelect = document.getElementById('subcategory_id');
                    subcategorySelect.innerHTML = '<option value="">-- Select Subcategory --</option>';

                    data.forEach(subcategory => {
                        const option = document.createElement('option');
                        option.value = subcategory.id;
                        option.textContent = subcategory.name;
                        subcategorySelect.appendChild(option);
                    });
                });
        }
    }

    // Now accepts an optional selectedSubcategoryId so edit modal pre-selects the right one
    function loadEditSubcategories(categoryId, selectedSubcategoryId) {
        if(categoryId) {
            fetch('/admin/subcategories/by-category/' + categoryId)
                .then(response => response.json())
                .then(data => {
                    const subcategorySelect = document.getElementById('editSubcategoryId');
                    const currentSubcategoryId = selectedSubcategoryId ?? subcategorySelect.value;

                    subcategorySelect.innerHTML = '';

                    data.forEach(subcategory => {
                        const option = document.createElement('option');
                        option.value = subcategory.id;
                        option.textContent = subcategory.name;
                        option.selected = subcategory.id == currentSubcategoryId;
                        subcategorySelect.appendChild(option);
                    });
                });
        }
    }
</script>


        </div>
    </div>
</main>

@endsection
