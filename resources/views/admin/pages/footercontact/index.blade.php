@extends('admin.layouts.app')
@section('content')
<main class="main-wrapper">
    <div class="container-fluid">
        <div class="inner-contents">

<div class="container-fluid">
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
                    <h4 class="mb-0">Footer Contact Content </h4>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addFooterContactModal">Add
                        Footer Contact</button>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table id="table-1" class="display text-center">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Address</th>
                                    <th>Phone</th>
                                    <th>Mail</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($footerContacts as $footerContact)
                                <tr>
                                    <td>{{ $footerContact->id }}</td>
                                    <td>{{ $footerContact->address }}</td>
                                    <td>{{ $footerContact->phone }}</td>
                                    <td>{{ $footerContact->mail }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <a href="#" data-bs-toggle="dropdown" class="fs-24 text-gray">
                                                <i class="bi bi-three-dots-vertical"></i>
                                            </a>
                                            <div class="dropdown-menu p-0">
                                                <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                    data-bs-target="#viewFooterContactModal"
                                                    onclick="viewFooterContact('{{ $footerContact->address }}', '{{ $footerContact->phone }}', '{{ $footerContact->mail }}')">View</a>
                                                <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                    data-bs-target="#editFooterContactModal"
                                                    onclick="openEditFooterContactModal({{ $footerContact->id }}, '{{ $footerContact->address }}', '{{ $footerContact->phone }}', '{{ $footerContact->mail }}')">Edit</a>
                                                <form action="{{ route('footercontact.destroy', $footerContact->id) }}"
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

<!-- Add FooterContact Modal -->
<div class="modal fade modal-xl" id="addFooterContactModal" tabindex="-1" aria-labelledby="addFooterContactModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('footercontact.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addFooterContactModalLabel">Add Footer Contact</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <textarea class="form-control" id="address" name="address" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input class="form-control" type="text" id="phone" name="phone" required>
                    </div>
                    <div class="mb-3">
                        <label for="mail" class="form-label">Mail</label>
                        <input class="form-control" type="email" id="mail" name="mail" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Contact</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit FooterContact Modal -->
<div class="modal fade modal-xl" id="editFooterContactModal" tabindex="-1" aria-labelledby="editFooterContactModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="editFooterContactForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="editFooterContactModalLabel">Edit Footer Contact</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="editAddress" class="form-label">Address</label>
                        <textarea class="form-control" id="editAddress" name="address" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="editPhone" class="form-label">Phone</label>
                        <input class="form-control" type="text" id="editPhone" name="phone" required>
                    </div>
                    <div class="mb-3">
                        <label for="editMail" class="form-label">Mail</label>
                        <input class="form-control" type="email" id="editMail" name="mail" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update Contact</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- View FooterContact Modal -->
<div class="modal fade modal-xl" id="viewFooterContactModal" tabindex="-1" aria-labelledby="viewFooterContactModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewFooterContactModalLabel">View Footer Contact</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <p><strong>Address:</strong> <span id="viewAddress"></span></p>
                <p><strong>Phone:</strong> <span id="viewPhone"></span></p>
                <p><strong>Mail:</strong> <span id="viewMail"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript for Edit Modal -->
<script>
    function openEditFooterContactModal(id, address, phone, mail) {
        const form = document.getElementById('editFooterContactForm');
        form.action = `/admin/footercontact/${id}`;
        document.getElementById('editAddress').value = address;
        document.getElementById('editPhone').value = phone;
        document.getElementById('editMail').value = mail;
    }
    function viewFooterContact(address, phone, mail) {
        document.getElementById('viewAddress').textContent = address;
        document.getElementById('viewPhone').textContent = phone;
        document.getElementById('viewMail').textContent = mail;
    }
</script>
        </div>
    </div>
</main>
@endsection
