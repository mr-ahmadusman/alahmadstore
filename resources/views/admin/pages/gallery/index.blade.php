@extends('admin.layouts.app')

@section('content')
    <main class="main-wrapper">
        <div class="container-fluid">
            <div class="inner-contents">

                <div class="container-fluid ">
                    <div class="row">
                        <div class="col-lg-12">

                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show shadow-lg border-0 d-flex align-items-center gap-2"
                                    role="alert" style="background-color: #d1e7dd;">
                                    <i class="bi bi-check-circle-fill text-success fs-4"></i>
                                    <div>{{ session('success') }}</div>
                                    <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif

                            <div class="card border-0 p-5">
                                <div
                                    class="card-header pb-5 bg-transparent border-0 d-flex justify-content-between align-items-center">
                                    <h4 class="mb-0">Gallery</h4>
                                    <button class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#addGalleryModal">Add Gallery Item</button>
                                </div>

                                <div class="card-body p-0">
                                    <div class="table-responsive">
                                        <table id="table-1" class="display text-center">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Title</th>
                                                    <th>Background Image</th>
                                                    <th>Photo</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($galleries as $gallery)
                                                    <tr>
                                                        <td>{{ $gallery->id }}</td>
                                                        <td>{{ $gallery->title }}</td>
                                                        <td>
                                                            @if ($gallery->background_image)
                                                                <img src="{{ asset($gallery->background_image) }}"
                                                                    alt="Background" width="100"
                                                                    onclick="showImageModal('{{ asset($gallery->background_image) }}')"
                                                                    style="cursor:pointer">
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if ($gallery->photo)
                                                                <img src="{{ asset($gallery->photo) }}" alt="Photo"
                                                                    width="100"
                                                                    onclick="showImageModal('{{ asset($gallery->photo) }}')"
                                                                    style="cursor:pointer">
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <div class="dropdown">
                                                                <a href="#" data-bs-toggle="dropdown"
                                                                    class="fs-24 text-gray">
                                                                    <i class="bi bi-three-dots-vertical"></i>
                                                                </a>
                                                                <div class="dropdown-menu">
                                                                    <a class="dropdown-item" href="#"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#viewGalleryModal"
                                                                        onclick='viewGallery(@json($gallery->title), @json($gallery->background_image), @json($gallery->photo))'>View</a>

                                                                    <a class="dropdown-item" href="#"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#editGalleryModal"
                                                                        onclick='editGallery({{ $gallery->id }}, @json($gallery->title), @json($gallery->background_image), @json($gallery->photo))'>Edit</a>

                                                                    <form
                                                                        action="{{ route('gallery.destroy', $gallery->id) }}"
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

                <!-- Add Gallery Modal -->
                <div class="modal fade modal-xl" id="addGalleryModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="{{ route('gallery.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-header">
                                    <h5 class="modal-title">Add Gallery Item</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label>Title</label>
                                        <input type="text" name="title" class="form-control">
                                        @error('title')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label>Background Image</label>
                                        <input type="file" name="background_image" class="form-control" accept="image/*">
                                        @error('background_image')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label>Photo</label>
                                        <input type="file" name="photo" class="form-control" accept="image/*">
                                        @error('photo')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Edit Gallery Modal -->
                <div class="modal fade modal-xl" id="editGalleryModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form id="editGalleryForm" method="POST" enctype="multipart/form-data">
                                <!-- Removed invalid action; JS will set it -->
                                @csrf
                                @method('PUT')
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Gallery Item</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" id="editGalleryId">
                                    <!-- Not needed, but kept; add name="id" if required -->
                                    <div class="mb-3">
                                        <label>Title</label>
                                        <input type="text" id="editTitle" name="title" class="form-control">
                                        @error('title')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label>Background Image</label>
                                        <input type="file" name="background_image" class="form-control"
                                            accept="image/*">
                                        <img id="editBackgroundPreview" src="" width="100" class="mt-2">
                                        @error('background_image')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label>Photo</label>
                                        <input type="file" name="photo" class="form-control" accept="image/*">
                                        <img id="editPhotoPreview" src="" width="100" class="mt-2">
                                        @error('photo')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- View Gallery Modal -->
                <div class="modal fade modal-xl" id="viewGalleryModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-xl modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header bg-primary text-white">
                                <h5 class="modal-title">View Gallery Item</h5>
                                <button type="button" class="btn-close btn-close-white"
                                    data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body row">
                                <div class="col-md-6 text-center">
                                    <img id="viewBackgroundImage" src="" alt="Background Image"
                                        class="img-fluid shadow mb-3" style="max-height: 250px; object-fit: contain;">
                                    <img id="viewPhoto" src="" alt="Photo" class="img-fluid shadow"
                                        style="max-height: 250px; object-fit: contain;">
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Title:</strong> <span id="viewTitle"></span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Image Preview Modal -->
                <div class="modal fade modal-xl" id="imagePreviewModal" tabindex="-1">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content text-center">
                            <div class="modal-body">
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                <img id="previewImage" style="max-width: 100%; max-height: 70vh; border-radius: 8px;" />
                            </div>
                        </div>
                    </div>
                </div>

                <script>
                    function viewGallery(title, background_image, photo) {
                        document.getElementById('viewTitle').textContent = title ?? '';
                        document.getElementById('viewBackgroundImage').src = background_image ? '/' + background_image : '';

                        document.getElementById('viewPhoto').src = photo ? '/' + photo : '';
                    }

                    function editGallery(id, title, background_image, photo) {
                        document.getElementById('editGalleryId').value = id;
                        document.getElementById('editTitle').value = title ?? '';
                        document.getElementById('editBackgroundPreview').src = background_image ? '/' + background_image : '';

                        document.getElementById('editPhotoPreview').src = photo ? '/' + photo : '';

                        const form = document.getElementById('editGalleryForm');
                        form.action = `/admin/gallery/${id}`;
                    }

                    function showImageModal(imageUrl) {
                        document.getElementById('previewImage').src = imageUrl;
                        new bootstrap.Modal(document.getElementById('imagePreviewModal')).show();
                    }
                </script>


            </div>
        </div>
    </main>
@endsection
