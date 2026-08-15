@extends('admin.layouts.app')
@section('content')
<main class="main-wrapper">
    <div class="container-fluid">
        <div class="inner-contents">


<div class="container-fluid py-2">
    <div class="row">
        <div class="col-lg-12">
            @if(session('message'))
                    <div class="alert alert-{{ session('type', 'info') }} alert-dismissible fade show shadow-lg border-0 d-flex align-items-center gap-2" role="alert">
                        <i class="bi bi-info-circle-fill fs-4 @if(session('type') === 'danger') text-danger @else text-success @endif"></i>
                        <div>{{ session('message') }}</div>
                        <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
             @endif
            <div class="card border-0 p-5">
                <div class="card-header pb-5 bg-transparent border-0 d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Social Media Links</h4>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addLinkModal">Add Links</button>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table id="table-1" class="display text-center">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Facebook</th>
                                    <th>Instagram</th>
                                    <th>TikTok</th>
                                    <th>WhatsApp</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($socials as $social)
                                <tr>
                                    <td>{{ $social->id }}</td>
                                    <td><a href="{{ $social->facebook }}" target="_blank"><i class="bi bi-facebook fs-18"></i></span></a></td>
                                    <td><a href="{{ $social->instagram }}" target="_blank"><i class="bi bi-instagram fs-18"></i></span></a></td>
                                    <td><a href="{{ $social->tiktok }}" target="_blank"><i class="bi bi-tiktok fs-18"></i></span></a></td>
                                   <td>
                                        <a href="{{ $social->whatsapp }}?text={{ urlencode('Hello Admin, I want to ask something') }}"
                                            target="_blank">
                                                <i class="bi bi-whatsapp"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <a href="#" data-bs-toggle="dropdown" class="fs-24 text-gray">
                                                <i class="bi bi-three-dots-vertical"></i>
                                            </a>
                                            <div class="dropdown-menu p-0">
                                                <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#editLinkModal"
                                                   onclick="openEditModal({{ $social->id }}, '{{ $social->facebook }}', '{{ $social->instagram }}', '{{ $social->tiktok }}', '{{ $social->whatsapp }}')">Edit</a>
                                                <form action="{{ route('socialmedia.delete', $social->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item text-danger">Delete</button>
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

<!-- Add Link Modal -->
<div class="modal fade" id="addLinkModal" tabindex="-1" aria-labelledby="addLinkModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('socialmedia.create') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addLinkModalLabel">Add Social Media Links</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Facebook</label>
                        <input type="url" name="facebook" class="form-control" required>
                        <label class="form-label">Instagram</label>
                        <input type="url" name="instagram" class="form-control" required>
                        <label class="form-label">TikTok</label>
                        <input type="url" name="tiktok" class="form-control" required>
                        <label class="form-label">WhatsApp</label>
                        <input type="url" name="whatsapp" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Links</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Link Modal -->
<div class="modal fade" id="editLinkModal" tabindex="-1" aria-labelledby="editLinkModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="editLinkForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="editLinkModalLabel">Edit Social Media Links</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Facebook</label>
                        <input type="url" name="facebook" id="editFacebook" class="form-control" required>
                        <label class="form-label">Instagram</label>
                        <input type="url" name="instagram" id="editInstagram" class="form-control" required>
                        <label class="form-label">TikTok</label>
                        <input type="url" name="tiktok" id="editTiktok" class="form-control" required>
                        <label class="form-label">WhatsApp</label>
                        <input type="url" name="whatsapp" id="editWhatsapp" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update Links</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function openEditModal(id, facebook, instagram, tiktok, whatsapp) {
        document.getElementById('editLinkForm').action = `/admin/socialmedia/${id}`;
        document.getElementById('editFacebook').value = facebook;
        document.getElementById('editInstagram').value = instagram;
        document.getElementById('editTiktok').value = tiktok;
        document.getElementById('editWhatsapp').value = whatsapp;
    }
</script>

        </div>
    </div>
</main>
@endsection
