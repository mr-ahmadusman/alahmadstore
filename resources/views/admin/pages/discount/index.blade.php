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
                                <h4 class="mb-0">Discounts</h4>
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addDiscountModal">Add Discount</button>
                            </div>

                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table id="table-1" class="display text-center">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Image</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($discounts as $discount)
                                            <tr>
                                                <td>{{ $discount->id }}</td>
                                                <td>{{ $discount->name }}</td>
                                                <td>
                                                    @if($discount->image)
                                                        <img src="/{{ $discount->image }}" alt="Image" width="100" style="cursor:pointer"
                                                            onclick="showImageModal('/{{ $discount->image }}')">
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="dropdown">
                                                        <a href="#" data-bs-toggle="dropdown" class="fs-24 text-gray">
                                                            <i class="bi bi-three-dots-vertical"></i>
                                                        </a>
                                                        <div class="dropdown-menu p-0">
                                                            <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                                data-bs-target="#viewDiscountModal"
                                                                onclick="viewDiscount('{{ $discount->name }}', '{{ $discount->image }}')">View</a>

                                                            <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                                data-bs-target="#editDiscountModal"
                                                                onclick="openEditDiscountModal({{ $discount->id }}, '{{ $discount->name }}', '{{ $discount->image }}')">Edit</a>

                                                            <form action="{{ route('discount.delete', $discount->id) }}"
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

            <!-- Add Discount Modal -->
            <div class="modal fade modal-xl" id="addDiscountModal" tabindex="-1" aria-labelledby="addDiscountModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form id="addDiscountForm" method="POST" action="{{ route('discount.create') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title" id="addDiscountModalLabel">Add Discount</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input class="form-control" type="text" id="name" name="name" required>
                                </div>
                                <div class="mb-3">
                                    <label for="image" class="form-label">Image</label>
                                    <input class="form-control" type="file" id="image" name="image" accept="image/*">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save Discount</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Edit Discount Modal -->
            <div class="modal fade modal-xl" id="editDiscountModal" tabindex="-1" aria-labelledby="editDiscountModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form id="editDiscountForm" method="POST" enctype="multipart/form-data" action="">
                            @csrf
                            @method('PUT')
                            <div class="modal-header">
                                <h5 class="modal-title" id="editDiscountModalLabel">Edit Discount</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="discount_id" id="editDiscountId">
                                <div class="mb-3">
                                    <label for="editName" class="form-label">Name</label>
                                    <input class="form-control" type="text" id="editName" name="name" required>
                                </div>
                                <div class="mb-3">
                                    <label for="editImage" class="form-label">Image</label>
                                    <input class="form-control" type="file" id="editImage" name="image" accept="image/*">
                                    <img id="editImagePreview" src="" alt="Current Image" width="100" class="mt-2">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Update Discount</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- View Discount Modal -->
            <div class="modal fade" id="viewDiscountModal" tabindex="-1" aria-labelledby="viewDiscountModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title" id="viewDiscountModalLabel">View Discount</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row align-items-center">
                                <div class="col-md-6 text-center mb-3 mb-md-0">
                                    <img id="viewImage" src="" alt="Discount Image" class="img-fluid shadow" style="max-height: 350px; object-fit: contain;">
                                </div>
                                <div class="col-md-6">
                                    <p class="mb-2"><strong>Name:</strong> <span id="viewName"></span></p>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <span class="text-muted small">Discount Details</span>
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
                function openEditDiscountModal(id, name, image) {
                    const form = document.getElementById('editDiscountForm');
                    form.action = '/admin/discounts/' + id;
                    document.getElementById('editDiscountId').value = id;
                    document.getElementById('editName').value = name;
                    document.getElementById('editImagePreview').src = image ? '/' + image : '';
                }

                function viewDiscount(name, image) {
                    document.getElementById('viewName').textContent = name;
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
