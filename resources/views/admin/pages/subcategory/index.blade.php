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
                    <h4 class="mb-0">Subcategories</h4>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addSubcategoryModal">Add Subcategory</button>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table id="table-1" class="display text-center">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Description</th>
                                    <th>Parent Category</th>
                                    <th>Image</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($subcategories as $subcategory)
                                <tr>
                                    <td>{{ $subcategory->id }}</td>
                                    <td>{{ $subcategory->name }}</td>
                                    <td>{{ $subcategory->slug }}</td>
                                    <td>{{ Str::limit($subcategory->description, 30) }}</td>
                                    <td>{{ $subcategory->category->name }}</td>
                                    <td>
                                        @if($subcategory->image)
                                            <img src="/{{ $subcategory->image }}" alt="Image" width="100" style="cursor:pointer"
                                                 onclick="showImageModal('/{{ $subcategory->image }}')">
                                        @endif
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <a href="#" data-bs-toggle="dropdown" class="fs-24 text-gray">
                                                <i class="bi bi-three-dots-vertical"></i>
                                            </a>
                                            <div class="dropdown-menu p-0">
                                                <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                    data-bs-target="#viewSubcategoryModal"
                                                    onclick="viewSubcategory('{{ $subcategory->name }}', '{{ $subcategory->slug }}', '{{ $subcategory->description }}', '{{ $subcategory->image }}', '{{ $subcategory->category->name }}')">View</a>

                                                <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                    data-bs-target="#editSubcategoryModal"
                                                    onclick="openEditSubcategoryModal({{ $subcategory->id }}, '{{ $subcategory->name }}', '{{ $subcategory->description }}', '{{ $subcategory->image }}', {{ $subcategory->category_id }})">Edit</a>

                                                <form action="{{ route('admin.subcategories.destroy', $subcategory->id) }}"
                                                    method="POST" onsubmit="return confirm('Are you sure?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="dropdown-item text-danger"
                                                        type="submit">Delete</button>
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

<!-- Add Subcategory Modal -->
<div class="modal fade modal-xl" id="addSubcategoryModal" tabindex="-1" aria-labelledby="addSubcategoryModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="addSubcategoryForm" method="POST" action="{{ route('admin.subcategories.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addSubcategoryModalLabel">Add Subcategory</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Parent Category</label>
                        <select class="form-control" id="category_id" name="category_id" required>
                            <option value="">-- Select Category --</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input class="form-control" type="text" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input class="form-control" type="file" id="image" name="image" accept="image/*">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Subcategory</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Subcategory Modal -->
<div class="modal fade modal-xl" id="editSubcategoryModal" tabindex="-1" aria-labelledby="editSubcategoryModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="editSubcategoryForm" method="POST" enctype="multipart/form-data" action="">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="editSubcategoryModalLabel">Edit Subcategory</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="subcategory_id" id="editSubcategoryId">
                    <div class="mb-3">
                        <label for="editCategoryId" class="form-label">Parent Category</label>
                        <select class="form-control" id="editCategoryId" name="category_id" required>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="editName" class="form-label">Name</label>
                        <input class="form-control" type="text" id="editName" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="editDescription" class="form-label">Description</label>
                        <textarea class="form-control" id="editDescription" name="description"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="editImage" class="form-label">Image</label>
                        <input class="form-control" type="file" id="editImage" name="image" accept="image/*">
                        <img id="editImagePreview" src="" alt="Current Image" width="100" class="mt-2">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update Subcategory</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- View Subcategory Modal -->
<div class="modal fade" id="viewSubcategoryModal" tabindex="-1" aria-labelledby="viewSubcategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="viewSubcategoryModalLabel">View Subcategory</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row align-items-center">
                    <div class="col-md-6 text-center mb-3 mb-md-0">
                        <img id="viewImage" src="" alt="Subcategory Image" class="img-fluid  shadow" style="max-height: 350px; object-fit: contain;">
                    </div>
                    <div class="col-md-6">
                        <p class="mb-2"><strong>Name:</strong> <span id="viewName"></span></p>
                        <p class="mb-2"><strong>Slug:</strong> <span id="viewSlug"></span></p>
                        <p class="mb-2"><strong>Description:</strong> <span id="viewDescription"></span></p>
                        <p class="mb-2"><strong>Parent Category:</strong> <span id="viewParentCategory"></span></p>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <span class="text-muted small">Subcategory Details</span>
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
    function openEditSubcategoryModal(id, name, description, image, categoryId) {
        const form = document.getElementById('editSubcategoryForm');
        form.action = '/admin/subcategories/' + id;
        document.getElementById('editSubcategoryId').value = id;
        document.getElementById('editName').value = name;
        document.getElementById('editDescription').value = description;
        document.getElementById('editImagePreview').src = image ? '/' + image : '';
        document.getElementById('editCategoryId').value = categoryId;
    }

    function viewSubcategory(name, slug, description, image, parentCategory) {
        document.getElementById('viewName').textContent = name;
        document.getElementById('viewSlug').textContent = slug;
        document.getElementById('viewDescription').textContent = description;
        document.getElementById('viewParentCategory').textContent = parentCategory;
        var imgPath = image ? (image.startsWith('/') ? image : '/' + image) : '';
        document.getElementById('viewImage').src = imgPath;
    }

    function showImageModal(imageUrl) {
        document.getElementById('previewImage').src = imageUrl;
        var imageModal = new bootstrap.Modal(document.getElementById('imagePreviewModal'));
        imageModal.show();
    }
</script>
        </div>
    </div>
</main>


@endsection
