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
                            <div>{{ session('success') }}</div>
                            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif

                        <div class="card border-0 p-5">
                            <div class="card-header pb-5 bg-transparent border-0 d-flex align-items-center justify-content-between gap-3">
                                <h4 class="mb-0">Contact Messages</h4>
                                <span class="badge bg-primary fs-1">Total: {{ $contacts->count() }}</span>
                            </div>

                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table id="table-1" class="display text-center">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Message</th>
                                                <th>Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($contacts as $contact)
                                            <tr>
                                                <td>{{ $contact->id }}</td>
                                                <td>{{ $contact->name }}</td>
                                                <td>{{ $contact->email }}</td>
                                                <td>{{ $contact->phone ?? '-' }}</td>
                                                <td>{{ Str::limit($contact->message, 30) }}</td>
                                                <td>{{ $contact->created_at->format('d M Y') }}</td>
                                                <td>
                                                    <div class="dropdown">
                                                        <a href="#" data-bs-toggle="dropdown" class="fs-24 text-gray">
                                                            <i class="bi bi-three-dots-vertical"></i>
                                                        </a>
                                                        <div class="dropdown-menu p-0">
                                                            <a class="dropdown-item view-contact-btn" href="#" data-bs-toggle="modal"
                                                                data-bs-target="#viewContactModal"
                                                                data-name="{{ $contact->name }}"
                                                                data-email="{{ $contact->email }}"
                                                                data-phone="{{ $contact->phone ?? '-' }}"
                                                                data-message="{{ $contact->message }}"
                                                                data-date="{{ $contact->created_at->format('d M Y, h:i A') }}">View</a>

                                                            <form action="{{ route('admin.contacts.destroy', $contact->id) }}"
                                                                method="POST" onsubmit="return confirm('Are you sure?')">
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

            <!-- View Contact Modal -->
            <div class="modal fade" id="viewContactModal" tabindex="-1" aria-labelledby="viewContactModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title" id="viewContactModalLabel">Contact Message</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p class="mb-2"><strong>Name:</strong> <span id="viewContactName"></span></p>
                            <p class="mb-2"><strong>Email:</strong> <span id="viewContactEmail"></span></p>
                            <p class="mb-2"><strong>Phone:</strong> <span id="viewContactPhone"></span></p>
                            <p class="mb-2"><strong>Date:</strong> <span id="viewContactDate"></span></p>
                            <hr>
                            <p class="mb-0"><strong>Message:</strong></p>
                            <p id="viewContactMessage"></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                document.querySelectorAll('.view-contact-btn').forEach(function (btn) {
                    btn.addEventListener('click', function () {
                        document.getElementById('viewContactName').textContent = this.dataset.name;
                        document.getElementById('viewContactEmail').textContent = this.dataset.email;
                        document.getElementById('viewContactPhone').textContent = this.dataset.phone;
                        document.getElementById('viewContactDate').textContent = this.dataset.date;
                        document.getElementById('viewContactMessage').textContent = this.dataset.message;
                    });
                });
            </script>

        </div>
    </div>
</main>
@endsection
