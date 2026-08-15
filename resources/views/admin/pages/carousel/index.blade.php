@extends('admin.layouts.app')
@section('content')
    <main class="main-wrapper">
        <div class="container-fluid">
            <div class="inner-contents">

                <div class="container-fluid py-2" style="margin: auto;">
                    <div class="row">
                        <div class="col-lg-12">
                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show shadow-lg border-0 d-flex align-items-center gap-2"
                                    role="alert" style="background-color: #d1e7dd;">
                                    <i class="bi bi-check-circle-fill text-success fs-4"></i>
                                    <div>
                                        {{ session('success') }}
                                    </div>
                                    <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            <div class="card border-0 p-5">
                                <div
                                    class="card-header pb-5 bg-transparent border-0 d-flex align-items-center justify-content-between gap-3">
                                    <h4 class="mb-0">Carousel Images</h4>
                                    <button class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#addCarouselModal">Add Carousel</button>
                                </div>

                                <div class="card-body p-0">
                                    <div class="table-responsive">
                                        <table id="table-1" class="display text-center">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Title</th>
                                                    <th>Sub Title</th>
                                                    <th>Image</th>
                                                    <th>Mobile Image</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($carousels as $carousel)
                                                    <tr>
                                                        <td>{{ $carousel->id }}</td>
                                                        <td>{{ $carousel->title }}</td>
                                                        <td>{{ $carousel->sub_title }}</td>
                                                        <td>
                                                            @if ($carousel->image)
                                                                <img src="/{{ $carousel->image }}" alt="Image"
                                                                    width="100" style="cursor:pointer"
                                                                    onclick="showImageModal('/{{ $carousel->image }}')">
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if ($carousel->mobile_image)
                                                                <img src="/{{ $carousel->mobile_image }}" alt="Mobile Image"
                                                                    width="60" style="cursor:pointer"
                                                                    onclick="showImageModal('/{{ $carousel->mobile_image }}')">
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <div class="dropdown">
                                                                <a href="#" data-bs-toggle="dropdown"
                                                                    class="fs-24 text-gray">
                                                                    <i class="bi bi-three-dots-vertical"></i>
                                                                </a>
                                                                <div class="dropdown-menu p-0">
                                                                    <a class="dropdown-item" href="#"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#viewCarouselModal"
                                                                        onclick="viewCarousel('{{ $carousel->title }}', '{{ $carousel->sub_title }}', '{{ $carousel->image }}', '{{ $carousel->mobile_image }}')">View</a>
                                                                    <a class="dropdown-item" href="#"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#editCarouselModal"
                                                                        onclick="openEditCarouselModal({{ $carousel->id }}, '{{ $carousel->title }}', '{{ $carousel->sub_title }}', '{{ $carousel->image }}', '{{ $carousel->mobile_image }}')">Edit</a>
                                                                    <form
                                                                        action="{{ route('carousel.destroy', $carousel->id) }}"
                                                                        method="POST"
                                                                        onsubmit="return confirm('Are you sure?')">
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

                <!-- Add Carousel Modal -->
                <div class="modal fade modal-xl" id="addCarouselModal" tabindex="-1"
                    aria-labelledby="addCarouselModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form id="addCarouselForm" method="POST" action="{{ route('carousel.store') }}"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addCarouselModalLabel">Add Carousel</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="title" class="form-label">Title</label>
                                        <input class="form-control" type="text" id="title" name="title" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="sub_title" class="form-label">Sub Title</label>
                                        <input class="form-control" type="text" id="sub_title" name="sub_title">
                                    </div>
                                    <div class="mb-3">
                                        <label for="image" class="form-label">Image (Desktop / Full Website)</label>
                                        <input class="form-control" type="file" id="image" name="image"
                                            accept="image/*" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="mobile_image" class="form-label">Mobile View Image</label>
                                        <input class="form-control" type="file" id="mobile_image" name="mobile_image"
                                            accept="image/*">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save Carousel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Edit Carousel Modal -->
                <div class="modal fade modal-xl" id="editCarouselModal" tabindex="-1"
                    aria-labelledby="editCarouselModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form id="editCarouselForm" method="POST" enctype="multipart/form-data" action="">
                                @csrf
                                @method('PUT')
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editCarouselModalLabel">Edit Carousel</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" name="carousel_id" id="editCarouselId">
                                    <div class="mb-3">
                                        <label for="editTitle" class="form-label">Title</label>
                                        <input class="form-control" type="text" id="editTitle" name="title"
                                            required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="editSubTitle" class="form-label">Sub Title</label>
                                        <input class="form-control" type="text" id="editSubTitle" name="sub_title">
                                    </div>
                                    <div class="mb-3">
                                        <label for="editImage" class="form-label">Image (Desktop / Full Website)</label>
                                        <input class="form-control" type="file" id="editImage" name="image"
                                            accept="image/*">
                                        <img id="editImagePreview" src="" alt="Current Image" width="100"
                                            class="mt-2">
                                    </div>
                                    <div class="mb-3">
                                        <label for="editMobileImage" class="form-label">Mobile View Image</label>
                                        <input class="form-control" type="file" id="editMobileImage" name="mobile_image"
                                            accept="image/*">
                                        <img id="editMobileImagePreview" src="" alt="Current Mobile Image" width="100"
                                            class="mt-2">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Update Carousel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- View Carousel Modal -->
                <div class="modal fade" id="viewCarouselModal" tabindex="-1" aria-labelledby="viewCarouselModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-xl modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header bg-primary text-white">
                                <h5 class="modal-title" id="viewCarouselModalLabel">View Carousel</h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row align-items-center">
                                    <div class="col-md-6 text-center mb-3 mb-md-0">
                                        <p class="mb-1"><strong>Desktop Image</strong></p>
                                        <img id="viewImage" src="" alt="Carousel Image"
                                            class="img-fluid shadow mb-3" style="max-height: 250px; object-fit: contain;">
                                        <p class="mb-1"><strong>Mobile Image</strong></p>
                                        <img id="viewMobileImage" src="" alt="Carousel Mobile Image"
                                            class="img-fluid shadow" style="max-height: 250px; object-fit: contain;">
                                    </div>
                                    <div class="col-md-6">
                                        <p class="mb-2"><strong>Title:</strong> <span id="viewTitle"></span></p>
                                        <p class="mb-2"><strong>Sub Title:</strong> <span id="viewSubTitle"></span></p>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <span class="text-muted small">Carousel Details</span>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <script>
                    function openEditCarouselModal(id, title, sub_title, image, mobileImage) {
                        const form = document.getElementById('editCarouselForm');
                        // Use the named route if available (adjust if your route prefix changes)
                        form.action = '/admin/carousel/' + id;
                        document.getElementById('editCarouselId').value = id;
                        document.getElementById('editTitle').value = title;
                        document.getElementById('editSubTitle').value = sub_title;
                        document.getElementById('editImagePreview').src = image ? '/' + image : '';
                        document.getElementById('editMobileImagePreview').src = mobileImage ? '/' + mobileImage : '';
                    }

                    function viewCarousel(title, sub_title, image, mobileImage) {
                        document.getElementById('viewTitle').textContent = title;
                        document.getElementById('viewSubTitle').textContent = sub_title;
                        // If image already has a slash, don't double it
                        var imgPath = image ? (image.startsWith('/') ? image : '/' + image) : '';
                        document.getElementById('viewImage').src = imgPath;
                        var mobileImgPath = mobileImage ? (mobileImage.startsWith('/') ? mobileImage : '/' + mobileImage) : '';
                        document.getElementById('viewMobileImage').src = mobileImgPath;
                    }
                </script>

                <!-- Image Preview Modal -->
                <div class="modal fade  " id="imagePreviewModal" tabindex="-1" aria-labelledby="imagePreviewModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content">

                            <div class="modal-body text-center">
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                                <img id="previewImage" src="" alt="Preview"
                                    style="max-width: 100%; max-height: 70vh; box-shadow: 0 2px 16px #0002; border-radius: 8px;">
                            </div>
                        </div>
                    </div>
                </div>
                <script>
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
