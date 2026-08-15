@extends('admin.layouts.app')
@section('content')
<!-- Main Wrapper-->
<main class="main-wrapper">
    <div class="container-fluid">
        <div class="inner-contents">

              <!-- Filters -->
              <div class="card border-0 p-4 mb-3">
                <form method="GET" action="{{ route('admin.orders.index') }}" class="row g-3 align-items-end">
                    <div class="col-md-3">
                        <label class="form-label">Order Status</label>
                        <select name="order_status" class="form-select">
                            <option value="">All</option>
                            <option value="pending" @selected(request('order_status')=='pending')>Pending</option>
                            <option value="processing" @selected(request('order_status')=='processing')>Processing</option>
                            <option value="shipped" @selected(request('order_status')=='shipped')>Shipped</option>
                            <option value="delivered" @selected(request('order_status')=='delivered')>Delivered</option>
                            <option value="cancelled" @selected(request('order_status')=='cancelled')>Cancelled</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Start Date</label>
                        <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">End Date</label>
                        <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}">
                    </div>
                    <div class="col-md-3 d-flex gap-2">
                        <button type="submit" class="btn btn-primary">Filter</button>
                        <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-secondary">Reset</a>
                    </div>
                </form>
              </div>

              <!-- Orders Table  -->
              <div class="card border-0 p-5">
                <div class="card-header pb-4 bg-transparent border-0 d-flex align-items-center justify-content-between gap-3">
                    <h4 class="mb-0">Orders</h4>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table id="table-1" class="display text-center align-middle">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Total</th>
                                    <th>Payment</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($orders as $order)
                                    <tr data-id="{{ $order->id }}">
                                        <td>#{{ $order->id }}</td>
                                        <td>{{ $order->name }}</td>
                                        <td>{{ number_format($order->total_amount, 2) }}</td>
                                        <td><span class="badge {{ $order->payment_status === 'paid' ? 'badge-soft-success' : 'badge-soft-warning' }}">{{ ucfirst($order->payment_status) }}</span></td>
                                        <td><span class="badge bg-secondary">{{ ucfirst($order->order_status) }}</span></td>
                                        <td>{{ $order->created_at?->format('Y-m-d H:i') }}</td>
                                        <td>
                                            <button class="btn btn-sm btn-primary btn-view" data-id="{{ $order->id }}">
                                                <i class="bi bi-eye"></i> View
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="7">No orders yet.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
              </div>

              <!-- Details Modal -->
              <div class="modal fade" id="orderModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-xl modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Order Details</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div id="order-details" class="row g-4">

                                <!-- Left Side: Order Info + Status Update -->
                                <div class="col-md-5">
                                    <div class="mb-2"><strong>Order ID:</strong> <span id="od-id"></span></div>
                                    <div class="mb-2"><strong>Full Name:</strong> <span id="od-name"></span></div>
                                    <div class="mb-2"><strong>Street Address:</strong> <span id="od-address"></span></div>
                                    <div class="mb-2"><strong>Town / City:</strong> <span id="od-city"></span></div>
                                    <div class="mb-2"><strong>Postcode / Zip:</strong> <span id="od-postal"></span></div>
                                    <div class="mb-2"><strong>Email:</strong> <span id="od-email"></span></div>
                                    <div class="mb-2"><strong>Phone:</strong> <span id="od-phone"></span></div>
                                    <div class="mb-2"><strong>Total:</strong> <span id="od-total"></span></div>
                                    <div class="mb-2"><strong>Payment:</strong> <span id="od-payment"></span></div>
                                    <div class="mb-3"><strong>Status:</strong> <span id="od-status"></span></div>

                                    <hr>

                                    <div class="mb-3">
                                        <label class="form-label">Update Order Status</label>
                                        <div class="input-group">
                                            <select id="select-order-status" class="form-select">
                                                <option value="pending">Pending</option>
                                                <option value="processing">Processing</option>
                                                <option value="shipped">Shipped</option>
                                                <option value="delivered">Delivered</option>
                                                <option value="cancelled">Cancelled</option>
                                            </select>
                                            <button class="btn btn-outline-primary" id="btn-update-status">Update</button>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Update Payment Status</label>
                                        <div class="input-group">
                                            <select id="select-payment-status" class="form-select">
                                                <option value="unpaid">Unpaid</option>
                                                <option value="paid">Paid</option>
                                            </select>
                                            <button class="btn btn-outline-success" id="btn-update-payment">Update</button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Right Side: Items with bigger images -->
                                <div class="col-md-7">
                                    <h6>Items</h6>
                                    <div id="od-items" style="max-height: 420px; overflow-y: auto;">
                                        <!-- items injected here as cards via JS -->
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
              </div>

        </div>
    </div>
</main>

<script>
    window.csrfToken = '{{ csrf_token() }}';
    document.addEventListener('DOMContentLoaded', () => {
        const modalEl = document.getElementById('orderModal');
        const modal = new bootstrap.Modal(modalEl);
        let currentOrderId = null;

        document.querySelectorAll('.btn-view').forEach(btn => {
            btn.addEventListener('click', async (e) => {
                const id = e.currentTarget.dataset.id;
                currentOrderId = id;
                await loadOrder(id);
                modal.show();
            });
        });

        async function loadOrder(id) {
            const url = "{{ route('admin.orders.show', ['order' => ':id']) }}".replace(':id', id);
            const res = await fetch(url);
            if (!res.ok) return;
            const data = await res.json();
            const o = data.order;

            document.getElementById('od-id').textContent = '#' + o.id;
            document.getElementById('od-name').textContent = o.name || '-';
            document.getElementById('od-address').textContent = o.address || '-';
            document.getElementById('od-city').textContent = o.city || '-';
            document.getElementById('od-postal').textContent = o.postal_code || '-';
            document.getElementById('od-email').textContent = o.email || '-';
            document.getElementById('od-phone').textContent = o.phone || '-';
            document.getElementById('od-total').textContent = Number(o.total_amount).toFixed(2);
            document.getElementById('od-payment').textContent = o.payment_status;
            document.getElementById('od-status').textContent = o.order_status;

            document.getElementById('select-order-status').value = o.order_status;
            document.getElementById('select-payment-status').value = o.payment_status;

            // Items — cards with slightly smaller images
            const itemsContainer = document.getElementById('od-items');
            itemsContainer.innerHTML = '';
            (data.items || []).forEach(it => {
                const imgSrc = it.image ? '/' + it.image : '';
                const card = document.createElement('div');
                card.className = 'd-flex align-items-center gap-3 border-bottom pb-3 mb-3';
                card.innerHTML = `
                    <div style="width:70px;height:70px;flex-shrink:0;">
                        ${imgSrc
                            ? `<img src="${imgSrc}" alt="${it.product_name}" style="width:100%;height:100%;object-fit:cover;border-radius:8px;box-shadow:0 1px 6px rgba(0,0,0,0.25);">`
                            : `<div style="width:100%;height:100%;background:#2a2a3d;border-radius:8px;display:flex;align-items:center;justify-content:center;color:#888;font-size:12px;">No Image</div>`
                        }
                    </div>
                    <div class="flex-grow-1">
                        <div class="fw-semibold">${it.product_name}</div>
                        <div class="text-muted small">Qty: ${it.qty} &times; ${Number(it.price).toFixed(2)}</div>
                        <div class="fw-semibold">Subtotal: ${Number(it.subtotal).toFixed(2)}</div>
                    </div>
                `;
                itemsContainer.appendChild(card);
            });
        }

        document.getElementById('btn-update-status').addEventListener('click', async () => {
            if (!currentOrderId) return;
            const status = document.getElementById('select-order-status').value;
            const url = "{{ route('admin.orders.updateStatus', ['order' => ':id']) }}".replace(':id', currentOrderId);
            await post(url, { order_status: status });
            await loadOrder(currentOrderId);
            refreshRow(currentOrderId);
        });

        document.getElementById('btn-update-payment').addEventListener('click', async () => {
            if (!currentOrderId) return;
            const payment_status = document.getElementById('select-payment-status').value;
            const url = "{{ route('admin.orders.updatePaymentStatus', ['order' => ':id']) }}".replace(':id', currentOrderId);
            await post(url, { payment_status });
            await loadOrder(currentOrderId);
            refreshRow(currentOrderId);
        });

        async function post(url, body) {
            const res = await fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': window.csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify(body)
            });
            return res.ok;
        }

        function refreshRow(id) {
            const row = document.querySelector(`tr[data-id="${id}"]`);
            if (!row) return;
            const paySel = document.getElementById('select-payment-status').value;
            const ordSel = document.getElementById('select-order-status').value;
            row.children[3].innerHTML = `<span class="badge ${paySel === 'paid' ? 'badge-soft-success' : 'badge-soft-warning'}">${paySel.charAt(0).toUpperCase()+paySel.slice(1)}</span>`;
            row.children[4].innerHTML = `<span class="badge bg-secondary">${ordSel.charAt(0).toUpperCase()+ordSel.slice(1)}</span>`;
        }
    });
</script>

@endsection
