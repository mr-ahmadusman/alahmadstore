@extends('admin.layouts.app')
@section('content')
<main class="main-wrapper">
    <div class="container-fluid">
        <div class="inner-contents">

            <div class="container-fluid py-2">
                <div class="row">
                    <div class="col-lg-12">

                        @if(session('success'))
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
                                <h4 class="mb-0">Blog Posts</h4>
                                <button class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#addBlogModal">Add Blog</button>
                            </div>

                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table id="table-1" class="display text-center">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Title</th>
                                                <th>Date</th>
                                                <th>Image</th>
                                                <th>Description</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($blogs as $blog)
                                            <tr>
                                                <td>{{ $blog->id }}</td>
                                                <td>{{ $blog->title }}</td>
                                                <td>{{ $blog->date }}</td>
                                                <td>
                                                    @if($blog->image)
                                                    <img src="{{ asset($blog->image) }}" alt="Image" width="100"
                                                        onclick="showImageModal('/{{ $blog->image }}')"
                                                        style="cursor:pointer">
                                                    @endif
                                                </td>
                                                <td>{{ Str::limit($blog->description, 30) }}</td>
                                                <td>
                                                    <div class="dropdown">
                                                        <a href="#" data-bs-toggle="dropdown" class="fs-24 text-gray">
                                                            <i class="bi bi-three-dots-vertical"></i></a>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                                data-bs-target="#viewBlogModal"
                                                                onclick='viewBlog(@json($blog->title), @json($blog->date), @json($blog->description), @json($blog->image))'>View</a>

                                                            <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                                data-bs-target="#editBlogModal"
                                                                onclick='editBlog({{ $blog->id }}, @json($blog->title), @json($blog->date), @json($blog->description), @json($blog->image))'>Edit</a>

                                                            <form action="{{ route('blogs.destroy', $blog->id) }}"
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

            <!-- Add Blog Modal -->
            <div class="modal fade modal-xl" id="addBlogModal" tabindex="-1" aria-labelledby="addBlogModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="{{ route('blogs.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title">Add Blog</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3"><label>Title</label><input type="text" name="title"
                                        class="form-control" required></div>
                                <div class="mb-3"><label>Date</label><input type="date" name="date"
                                        class="form-control"></div>
                                <div class="mb-3"><label>Description</label><textarea name="description"
                                        class="form-control" rows="5"></textarea></div>
                                <div class="mb-3"><label>Image</label><input type="file" name="image"
                                        class="form-control" accept="image/*"></div>
                            </div>
                            <div class="modal-footer"><button type="submit" class="btn btn-primary">Save</button></div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Edit Blog Modal -->
            <div class="modal fade modal-xl" id="editBlogModal" tabindex="-1" aria-labelledby="editBlogModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form id="editBlogForm" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Blog</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" id="editBlogId">
                                <div class="mb-3"><label>Title</label><input type="text" id="editTitle" name="title"
                                        class="form-control" required></div>
                                <div class="mb-3"><label>Date</label><input type="date" id="editDate" name="date"
                                        class="form-control"></div>
                                <div class="mb-3"><label>Description</label><textarea id="editDescription"
                                        name="description" class="form-control" rows="5"></textarea></div>
                                <div class="mb-3"><label>Image</label><input type="file" name="image"
                                        class="form-control" accept="image/*"><img id="editImagePreview" src=""
                                        width="100" class="mt-2"></div>
                            </div>
                            <div class="modal-footer"><button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- View Blog Modal -->
            <div class="modal fade modal-xl" id="viewBlogModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-xl modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title">View Blog</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body row">
                            <div class="col-md-6 text-center">
                                <img id="viewBlogImage" src="" alt="Blog Image" class="img-fluid shadow"
                                    style="max-height: 350px; object-fit: contain;">
                            </div>
                            <div class="col-md-6">
                                <p><strong>Title:</strong> <span id="viewBlogTitle"></span></p>
                                <p><strong>Date:</strong> <span id="viewBlogDate"></span></p>
                                <p><strong>Description:</strong></p>
                                <div id="viewBlogDescription"></div>
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
                function viewBlog(title, date, description, image) {
                    document.getElementById('viewBlogTitle').textContent = title;
                    document.getElementById('viewBlogDate').textContent = date;
                    document.getElementById('viewBlogDescription').textContent = description;
                    document.getElementById('viewBlogImage').src = image ? '/' + image : '';
                }

                function editBlog(id, title, date, description, image) {
                    document.getElementById('editBlogId').value = id;
                    document.getElementById('editTitle').value = title;
                    document.getElementById('editDate').value = date;
                    document.getElementById('editDescription').value = description;
                    document.getElementById('editImagePreview').src = image ? '/' + image : '';

                    const form = document.getElementById('editBlogForm');
                    form.action = `/admin/blogs/${id}`;
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
