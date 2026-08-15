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
                                <h4 class="mb-0">Famous</h4>
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addFamousModal">Add Famous</button>
                            </div>

                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table id="table-1" class="display text-center">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Title</th>
                                                <th>Percentage Off</th>
                                                <th>Image</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($famous as $item)
                                            <tr>
                                                <td>{{ $item->id }}</td>
                                                <td>{{ $item->title }}</td>
                                                <td>{{ $item->percentage }}</td>
                                                <td>
                                                    @if($item->image)
                                                        <img src="/{{ $item->image }}" alt="Image" width="100" style="cursor:pointer"
                                                            onclick="showImageModal('/{{ $item->image }}')">
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="dropdown">
                                                        <a href="#" data-bs-toggle="dropdown" class="fs-24 text-gray">
                                                            <i class="bi bi-three-dots-vertical"></i>
                                                        </a>
                                                        <div class="dropdown-menu p-0">
                                                            <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                                data-bs-target="#viewFamousModal"
                                                                onclick="viewFamous('{{ $item->title }}', '{{ $item->percentage }}', '{{ $item->image }}')">View</a>

                                                            <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                                data-bs-target="#editFamousModal"
                                                                onclick="openEditFamousModal({{ $item->id }}, '{{ $item->title }}', '{{ $item->percentage }}', '{{ $item->image }}')">Edit</a>

                                                            <form action="{{ route('admin.famous.destroy', $item->id) }}"
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

            <!-- Add Famous Modal -->
            <div class="modal fade modal-xl" id="addFamousModal" tabindex="-1" aria-labelledby="addFamousModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form id="addFamousForm" method="POST" action="{{ route('admin.famous.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title" id="addFamousModalLabel">Add Famous</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="title" class="form-label">Title</label>
                                    <input class="form-control" type="text" id="title" name="title" required>
                                </div>
                                <div class="mb-3">
                                    <label for="percentage" class="form-label">Percentage Off (e.g. 60% Off)</label>
                                    <input class="form-control" type="text" id="percentage" name="percentage" placeholder="e.g. 60% Off" required>
                                </div>
                                <div class="mb-3">
                                    <label for="image" class="form-label">Image</label>
                                    <input class="form-control" type="file" id="image" name="image" accept="image/*" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save Famous</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Edit Famous Modal -->
            <div class="modal fade modal-xl" id="editFamousModal" tabindex="-1" aria-labelledby="editFamousModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form id="editFamousForm" method="POST" enctype="multipart/form-data" action="">
                            @csrf
                            @method('PUT')
                            <div class="modal-header">
                                <h5 class="modal-title" id="editFamousModalLabel">Edit Famous</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="famous_id" id="editFamousId">
                                <div class="mb-3">
                                    <label for="editTitle" class="form-label">Title</label>
                                    <input class="form-control" type="text" id="editTitle" name="title" required>
                                </div>
                                <div class="mb-3">
                                    <label for="editPercentage" class="form-label">Percentage Off (e.g. 60% Off)</label>
                                    <input class="form-control" type="text" id="editPercentage" name="percentage" required>
                                </div>
                                <div class="mb-3">
                                    <label for="editImage" class="form-label">Image</label>
                                    <input class="form-control" type="file" id="editImage" name="image" accept="image/*">
                                    <img id="editImagePreview" src="" alt="Current Image" width="100" class="mt-2">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Update Famous</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- View Famous Modal -->
            <div class="modal fade" id="viewFamousModal" tabindex="-1" aria-labelledby="viewFamousModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title" id="viewFamousModalLabel">View Famous</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row align-items-center">
                                <div class="col-md-6 text-center mb-3 mb-md-0">
                                    <img id="viewImage" src="" alt="Famous Image" class="img-fluid  shadow" style="max-height: 350px; object-fit: contain;">
                                </div>
                                <div class="col-md-6">
                                    <p class="mb-2"><strong>Title:</strong> <span id="viewTitle"></span></p>
                                    <p class="mb-2"><strong>Percentage Off:</strong> <span id="viewPercentage"></span></p>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <span class="text-muted small">Famous Details</span>
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
                function openEditFamousModal(id, title, percentage, image) {
                    const form = document.getElementById('editFamousForm');
                    form.action = '/admin/famous/' + id;
                    document.getElementById('editFamousId').value = id;
                    document.getElementById('editTitle').value = title;
                    document.getElementById('editPercentage').value = percentage;
                    document.getElementById('editImagePreview').src = image ? '/' + image : '';
                }

                function viewFamous(title, percentage, image) {
                    document.getElementById('viewTitle').textContent = title;
                    document.getElementById('viewPercentage').textContent = percentage;
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
