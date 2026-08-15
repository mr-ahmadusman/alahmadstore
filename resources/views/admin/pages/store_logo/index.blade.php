@extends('admin.layouts.app')
@section('content')
<main class="main-wrapper">
    <div class="container-fluid">
        <div class="inner-contents">
<div class="container-fluid py-2" style="margin: auto;">
    <div class="row">
        <div class="col-lg-12">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show shadow-lg border-0 d-flex align-items-center gap-2" role="alert" style="background-color: #d1e7dd;">
                    <i class="bi bi-check-circle-fill text-success fs-4"></i>
                    <div>
                        {{ session('success') }}
                    </div>
                    <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="card border-0 p-5">
                <div class="card-header pb-5 bg-transparent border-0 d-flex align-items-center justify-content-between gap-3">
                    <h4 class="mb-0">Store Logo</h4>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addLogoModal">Add Logo</button>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table id="table-1" class="display text-center">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Logo</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($logos as $logo)
                                <tr>
                                    <td>{{ $logo->id }}</td>
                                    <td><img src="{{ asset($logo->image) }}" width="60" alt="Logo"></td>
                                    <td>
                                        <div class="dropdown">
                                            <a href="#" data-bs-toggle="dropdown" class="fs-24 text-gray">
                                                <i class="bi bi-three-dots-vertical"></i>
                                            </a>
                                            <div class="dropdown-menu p-0">
                                                <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                    data-bs-target="#viewLogoModal"
                                                    onclick="document.getElementById('viewLogoImg').src='{{ asset($logo->image) }}'">View</a>

                                                <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                    data-bs-target="#editLogoModal"
                                                    onclick="openEditModal({{ $logo->id }}, '{{ asset($logo->image) }}')">Edit</a>

                                                <form action="{{ route('logos.destroy', $logo->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
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

<!-- Add Logo Modal -->
<div class="modal fade" id="addLogoModal" tabindex="-1" aria-labelledby="addLogoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('logos.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addLogoModalLabel">Add Store Logo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="logoFile" class="form-label">Logo Image</label>
                        <input class="form-control" type="file" id="logoFile" name="image" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Logo</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Logo Modal -->
<div class="modal fade" id="editLogoModal" tabindex="-1" aria-labelledby="editLogoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="editLogoForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="editLogoModalLabel">Edit Store Logo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="editLogoFile" class="form-label">Logo Image</label>
                        <input class="form-control" type="file" id="editLogoFile" name="image">
                        <img id="editLogoPreview" src="" alt="Current Logo" class="img-fluid mt-2"
                            style="max-width: 100px; display: none;">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update Logo</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- View Logo Modal -->
<div class="modal fade" id="viewLogoModal" tabindex="-1" aria-labelledby="viewLogoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewLogoModalLabel">View Store Logo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img src="" alt="Logo" class="img-fluid mb-3" id="viewLogoImg">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript for Edit Modal -->
<script>
    function openEditModal(logoId, logoUrl) {
        const form = document.getElementById('editLogoForm');
        form.action = `/admin/logo/${logoId}`;
        const preview = document.getElementById('editLogoPreview');
        preview.src = logoUrl;
        preview.style.display = 'block';
    }
</script>

        </div>
    </div>
</main>
@endsection
