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
                            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                        @endif
                        <div class="card border-0 p-5">
                            <div
                                class="card-header pb-5 bg-transparent border-0 d-flex align-items-center justify-content-between gap-3">
                                <h4 class="mb-0">About List</h4>
                                <button class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#addAboutModal">Add About</button>
                            </div>

                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table id="table-1" class="display text-center">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Banner Title</th>
                                                <th>Banner Image</th>
                                                <th>Feature Description</th>
                                                <th>Team Name</th>
                                                <th>Team Title</th>
                                                <th>Team Description</th>
                                                <th>Team Image</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($abouts as $about)
                                            <tr>
                                                <td>{{ $about->id }}</td>
                                                <td>{{ $about->banner_title }}</td>
                                                <td>
                                                    @if($about->banner_image)
                                                    <img src="{{ asset($about->banner_image) }}"
                                                        alt="Banner Image" width="80"
                                                        class="preview-img-trigger"
                                                        data-bs-toggle="modal" data-bs-target="#imagePreviewModal"
                                                        data-image="{{ asset($about->banner_image) }}"
                                                        style="cursor: pointer;">
                                                    @endif
                                                </td>
                                                <td>{{ Str::limit($about->feature_description, 30) }}</td>
                                                <td>{{ $about->t_name }}</td>
                                                <td>{{ $about->t_title }}</td>
                                                <td>{{ Str::limit($about->t_description, 30) }}</td>
                                                <td>
                                                    @if($about->t_image)
                                                    <img src="{{ asset($about->t_image) }}" alt="Team Image"
                                                        width="80"
                                                        class="preview-img-trigger"
                                                        data-bs-toggle="modal" data-bs-target="#imagePreviewModal"
                                                        data-image="{{ asset($about->t_image) }}"
                                                        style="cursor: pointer;">
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="dropdown">
                                                        <a href="#" data-bs-toggle="dropdown" class="fs-24 text-gray">
                                                            <i class="bi bi-three-dots-vertical"></i>
                                                        </a>
                                                        <div class="dropdown-menu p-0">
                                                            <a class="dropdown-item view-about-btn" href="#"
                                                                data-bs-toggle="modal" data-bs-target="#viewAboutModal"
                                                                data-banner_title="{{ $about->banner_title }}"
                                                                data-feature_description="{{ $about->feature_description }}"
                                                                data-t_name="{{ $about->t_name }}"
                                                                data-t_title="{{ $about->t_title }}"
                                                                data-t_description="{{ $about->t_description }}"
                                                                data-banner_image="{{ asset($about->banner_image) }}"
                                                                data-t_image="{{ asset($about->t_image) }}">View</a>

                                                            <a class="dropdown-item edit-about-btn" href="#"
                                                                data-bs-toggle="modal" data-bs-target="#editAboutModal"
                                                                data-update-url="{{ route('about.update', $about->id) }}"
                                                                data-banner_title="{{ $about->banner_title }}"
                                                                data-feature_description="{{ $about->feature_description }}"
                                                                data-t_name="{{ $about->t_name }}"
                                                                data-t_title="{{ $about->t_title }}"
                                                                data-t_description="{{ $about->t_description }}"
                                                                data-banner_image="{{ asset($about->banner_image) }}"
                                                                data-t_image="{{ asset($about->t_image) }}">Edit</a>

                                                            <form action="{{ route('about.destroy', $about->id) }}"
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

            <!-- Add About Modal -->
            <div class="modal fade modal-xl" id="addAboutModal" tabindex="-1" aria-labelledby="addAboutModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form id="addAboutForm" method="POST" action="{{ route('about.store') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title" id="addAboutModalLabel">Add About Content</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="banner_title" class="form-label">Banner Title</label>
                                            <input class="form-control" type="text" id="banner_title"
                                                name="banner_title">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="banner_image" class="form-label">Banner Image</label>
                                            <input class="form-control" type="file" id="banner_image"
                                                name="banner_image" accept="image/*">
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="feature_description" class="form-label">Feature Description</label>
                                    <textarea class="form-control" id="feature_description"
                                        name="feature_description" rows="4"></textarea>
                                </div>
                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="t_name" class="form-label">Team Name</label>
                                            <input class="form-control" type="text" id="t_name" name="t_name">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="t_title" class="form-label">Team Title</label>
                                            <input class="form-control" type="text" id="t_title" name="t_title">
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="t_description" class="form-label">Team Description</label>
                                            <textarea class="form-control" id="t_description"
                                                name="t_description" rows="4"></textarea>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="t_image" class="form-label">Team Image</label>
                                            <input class="form-control" type="file" id="t_image" name="t_image"
                                                accept="image/*">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save About Content</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Edit About Modal -->
            <div class="modal fade" id="editAboutModal" tabindex="-1" aria-labelledby="editAboutModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editAboutModalLabel">Edit About</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <form id="editAboutForm" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="modal-body">
                                <input type="hidden" id="editAboutId" name="id">

                                <div class="mb-3">
                                    <label>Banner Title</label>
                                    <input type="text" id="edit_banner_title" name="banner_title" class="form-control">
                                </div>

                                <div class="mb-3">
                                    <label>Feature Description</label>
                                    <textarea id="edit_feature_description" name="feature_description"
                                        class="form-control" rows="4"></textarea>
                                </div>

                                <div class="mb-3">
                                    <label>Team Name</label>
                                    <input type="text" id="edit_t_name" name="t_name" class="form-control">
                                </div>

                                <div class="mb-3">
                                    <label>Team Title</label>
                                    <input type="text" id="edit_t_title" name="t_title" class="form-control">
                                </div>

                                <div class="mb-3">
                                    <label>Team Description</label>
                                    <textarea id="edit_t_description" name="t_description"
                                        class="form-control" rows="4"></textarea>
                                </div>

                                <div class="mb-3">
                                    <label>Banner Image</label>
                                    <input type="file" id="edit_banner_image" name="banner_image" class="form-control">
                                    <img id="edit_banner_image_preview" src="" alt="Banner" class="img-fluid mt-2"
                                        style="max-height: 120px; display: none;">
                                </div>

                                <div class="mb-3">
                                    <label>Team Image</label>
                                    <input type="file" id="edit_t_image" name="t_image" class="form-control">
                                    <img id="edit_t_image_preview" src="" alt="Team" class="img-fluid mt-2"
                                        style="max-height: 120px; display: none;">
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


            <!-- View About Modal -->
            <div class="modal fade" id="viewAboutModal" tabindex="-1" aria-labelledby="viewAboutModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-xl modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title" id="viewAboutModalLabel">View About</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row align-items-center">
                                <div class="col-md-6 text-center mb-3 mb-md-0">
                                    <img id="view_banner_image" src="" alt="Banner Image" class="img-fluid shadow mb-3"
                                        style="max-height: 200px; object-fit: contain;">
                                    <img id="view_t_image" src="" alt="Team Image" class="img-fluid shadow"
                                        style="max-height: 200px; object-fit: contain;">
                                </div>
                                <div class="col-md-6">
                                    <p class="mb-2"><strong>Banner Title:</strong> <span id="view_banner_title"></span>
                                    </p>
                                    <p class="mb-2"><strong>Feature Description:</strong> <span
                                            id="view_feature_description"></span></p>
                                    <p class="mb-2"><strong>Team Name:</strong> <span id="view_t_name"></span></p>
                                    <p class="mb-2"><strong>Team Title:</strong> <span id="view_t_title"></span></p>
                                    <p class="mb-2"><strong>Team Description:</strong> <span
                                            id="view_t_description"></span></p>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <span class="text-muted small">About Details</span>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Image Preview Modal -->
            <div class="modal fade" id="imagePreviewModal" tabindex="-1" aria-labelledby="imagePreviewModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-body text-center">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            <img id="previewImage" src="" alt="Preview"
                                style="max-width: 100%; max-height: 70vh; box-shadow: 0 2px 16px #0002; border-radius: 8px;">
                        </div>
                    </div>
                </div>
            </div>

            <script>
                document.addEventListener('click', function (e) {
                    // Image preview (banner/team thumbnail click)
                    const imgTrigger = e.target.closest('.preview-img-trigger');
                    if (imgTrigger) {
                        document.getElementById('previewImage').src = imgTrigger.dataset.image || '';
                        return;
                    }

                    // View About
                    const viewBtn = e.target.closest('.view-about-btn');
                    if (viewBtn) {
                        const d = viewBtn.dataset;
                        document.getElementById('view_banner_title').textContent = d.banner_title || '';
                        document.getElementById('view_feature_description').textContent = d.feature_description || '';
                        document.getElementById('view_t_name').textContent = d.t_name || '';
                        document.getElementById('view_t_title').textContent = d.t_title || '';
                        document.getElementById('view_t_description').textContent = d.t_description || '';
                        document.getElementById('view_banner_image').src = d.banner_image || '';
                        document.getElementById('view_t_image').src = d.t_image || '';
                        return;
                    }

                    // Edit About
                    const editBtn = e.target.closest('.edit-about-btn');
                    if (editBtn) {
                        const d = editBtn.dataset;

                        document.getElementById('editAboutForm').action = d.updateUrl;
                        document.getElementById('edit_banner_title').value = d.banner_title || '';
                        document.getElementById('edit_feature_description').value = d.feature_description || '';
                        document.getElementById('edit_t_name').value = d.t_name || '';
                        document.getElementById('edit_t_title').value = d.t_title || '';
                        document.getElementById('edit_t_description').value = d.t_description || '';

                        const bannerPreview = document.getElementById('edit_banner_image_preview');
                        bannerPreview.src = d.bannerImage || d.banner_image || '';
                        bannerPreview.style.display = (d.banner_image) ? 'block' : 'none';

                        const teamPreview = document.getElementById('edit_t_image_preview');
                        teamPreview.src = d.t_image || '';
                        teamPreview.style.display = (d.t_image) ? 'block' : 'none';
                    }
                });
            </script>
        </div>
    </div>
</main>

@endsection
