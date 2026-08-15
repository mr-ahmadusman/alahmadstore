@extends('admin.layouts.app')
@section('content')
<main class="main-wrapper">
    <div class="container-fluid">
        <div class="inner-contents">

            <!-- Page Header -->
            <div class="page-header d-flex align-items-center justify-content-between mr-bottom-30 flex-wrap gap-3">
                <div class="left-part">
                    <h2 class="text-dark">Ramzan Khaddar  Dashboard</h2>
                    <p class="text-gray mb-0">Welcome back! Here's what's happening today.</p>
                </div>
                <div class="right-part">
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-primary rounded-2 ff-heading fs-18 fw-bold py-4">
                        <i class="bi bi-cart-fill me-1"></i> View All Orders
                    </a>
                </div>
            </div>

            <div class="row">
                <!-- ================= LEFT SIDE ================= -->
                <div class="col-xxl-6 col-lg-12">
                    <div class="row">

                        <!-- Total Earnings -->
                        <div class="col col-12">
                            <div class="card border-0 shadow-sm py-3">
                                <div class="card-body py-0">
                                    <div class="d-flex align-items-center justify-content-between gap-2 flex-wrap">
                                        <div class="d-flex align-items-center gap-3 flex-wrap">
                                            <div class="rounded-circle d-flex align-items-center justify-content-center"
                                                 style="width:70px;height:70px;background:rgba(111,66,193,0.15);">
                                                <i class="bi bi-currency-rupee fs-28" style="color:#6f42c1;"></i>
                                            </div>
                                            <div>
                                                <h4 class="mb-2">Total Earnings</h4>
                                                <h2 class="fs-38 mb-0">Rs. {{ number_format($totalEarnings, 0) }}</h2>
                                            </div>
                                        </div>
                                        <div>
                                            <h5 class="fw-semibold mb-1">From all paid orders</h5>
                                            <p class="text-gray mb-0">
                                                <span class="text-success fw-bold">
                                                    <i class="bi bi-graph-up-arrow"></i> Live
                                                </span> data
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Total Orders -->
                        <div class="col col-lg-6">
                            <div class="card border-0 shadow-sm pd-top-40 pd-bottom-40">
                                <div class="card-body py-0">
                                    <h4 class="mb-3">Total Orders</h4>
                                    <h2 class="fs-38 d-flex align-items-center gap-3">
                                        {{ $totalOrders }}
                                        <div class="badge bg-warning fs-16 text-dark">
                                            <i class="bi bi-clock me-1"></i> {{ $pendingOrders }} Pending
                                        </div>
                                    </h2>
                                </div>
                            </div>
                        </div>

                        <!-- Total Products -->
                        <div class="col col-lg-6">
                            <div class="card border-0 shadow-sm pd-top-40 pd-bottom-40">
                                <div class="card-body py-0">
                                    <h4 class="mb-3">Total Products</h4>
                                    <h2 class="fs-38 d-flex align-items-center gap-3">
                                        {{ $totalProducts }}
                                        <div class="badge bg-success fs-16">
                                            <i class="bi bi-box-seam me-1"></i> In Store
                                        </div>
                                    </h2>
                                </div>
                            </div>
                        </div>

                        <!-- Customers -->
                        <div class="col col-lg-6">
                            <div class="card border-0 shadow-sm p-5">
                                <div class="card-body p-0 d-flex align-items-center justify-content-between gap-3 flex-wrap">
                                    <div class="flex-shrink-0">
                                        <h4 class="mb-3">Customers</h4>
                                        <h2 class="fs-38 d-flex align-items-center gap-3">
                                            {{ $totalCustomers }}
                                            <div class="text-success fs-16">
                                                <i class="bi bi-people-fill"></i>
                                            </div>
                                        </h2>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Orders -->
                        <div class="col col-lg-6">
                            <div class="card border-0 shadow-sm pd-top-40 pd-bottom-40">
                                <div class="card-body py-0">
                                    <h4 class="mb-3">Pending Orders</h4>
                                    <div class="d-flex align-items-center gap-3 mt-3">
                                        <div class="flex-grow-1">
                                            <div class="progress rounded-1 bg-light-200 mb-2" style="height:10px;">
                                                @php
                                                    $pendingPercent = $totalOrders > 0 ? round(($pendingOrders / $totalOrders) * 100) : 0;
                                                @endphp
                                                <div class="progress-bar bg-warning rounded-1" style="width: {{ $pendingPercent }}%"></div>
                                            </div>
                                            <p class="text-gray mb-0">{{ $pendingPercent }}% of total orders</p>
                                        </div>
                                        <h2 class="fs-38">{{ $pendingOrders }}</h2>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Top Sales -->
                        <div class="col col-12">
                            <div class="card border-0 shadow-sm">
                                <div class="card-header bg-transparent border-0 p-5 pb-0 d-flex align-items-center justify-content-between">
                                    <div>
                                        <h4 class="mb-0">Top Selling Products</h4>
                                        <p class="text-gray mb-0">Best performers</p>
                                    </div>
                                    <a href="{{ route('admin.products.index') }}" class="btn btn-sm btn-outline-primary rounded-pill">View All</a>
                                </div>
                                <div class="card-body pt-3">
                                    @forelse($topSales as $index => $item)
                                        <div class="d-flex align-items-center justify-content-between py-3 {{ !$loop->last ? 'border-bottom' : '' }}">
                                            <div class="d-flex align-items-center gap-3">
                                                <span class="rounded-circle text-white d-flex align-items-center justify-content-center fw-bold"
                                                      style="width:28px;height:28px;background:#6f42c1;font-size:13px;">
                                                    {{ $index + 1 }}
                                                </span>
                                                @php $img = optional($item->product)->image; @endphp
                                                <img src="{{ $img ? asset($img) : asset('admin/assets/img/no-image.png') }}"
                                                     width="42" height="42" style="object-fit:cover;border-radius:8px;" alt="">
                                                <div>
                                                    <p class="mb-0 fw-semibold">{{ $item->product_name }}</p>
                                                    <span class="text-gray fs-13">Rs. {{ number_format(optional($item->product)->price ?? 0, 0) }}</span>
                                                </div>
                                            </div>
                                            <div class="text-end">
                                                <p class="mb-0 fw-semibold text-primary">{{ $item->total_qty }} Sales</p>
                                                <span class="text-gray fs-13">Rs. {{ number_format($item->total_revenue, 0) }}</span>
                                            </div>
                                        </div>
                                    @empty
                                        <p class="text-gray text-center py-4 mb-0">No sales yet.</p>
                                    @endforelse
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- ================= RIGHT SIDE ================= -->
                <div class="col-xxl-6 col-lg-12">

                    <!-- Revenue & Orders Chart -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-transparent border-0 p-5 pb-0 d-flex align-items-center justify-content-between flex-wrap gap-3">
                            <h4 class="mb-0">Revenue & Orders</h4>
                            <div class="d-flex align-items-center gap-3">
                                <span class="fs-14"><span class="indicator bg-primary"></span> Revenue</span>
                                <span class="fs-14"><span class="indicator bg-info"></span> Orders</span>
                            </div>
                        </div>
                        <div class="card-body pt-2">
                            <div id="revenueOrdersChart"></div>
                        </div>
                    </div>

                    <!-- Recent Orders -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-transparent border-0 p-5 pb-0 d-flex align-items-center justify-content-between">
                            <div>
                                <h4 class="mb-0">Recent Orders</h4>
                                <p class="text-gray mb-0">Latest 5 orders</p>
                            </div>
                            <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-outline-primary rounded-pill">View All</a>
                        </div>
                        <div class="card-body pt-3">
                            <div class="table-responsive">
                                <table class="table align-middle mb-0">
                                    <thead>
                                        <tr class="text-gray">
                                            <th>Order</th>
                                            <th>Customer</th>
                                            <th>Total</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($recentOrders as $order)
                                            @php
                                                $statusColors = [
                                                    'pending'     => 'bg-warning text-dark',
                                                    'processing'  => 'bg-info text-white',
                                                    'shipped'     => 'bg-primary text-white',
                                                    'delivered'   => 'bg-success text-white',
                                                    'cancelled'   => 'bg-danger text-white',
                                                ];
                                            @endphp
                                            <tr>
                                                <td>
                                                    <a href="{{ route('admin.orders.index') }}" class="fw-semibold text-primary">#{{ $order->id }}</a>
                                                    <div class="text-gray fs-13">{{ $order->created_at?->format('d M Y') }}</div>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center gap-2">
                                                        <span class="rounded-circle text-white d-flex align-items-center justify-content-center fw-bold"
                                                              style="width:32px;height:32px;background:#6f42c1;font-size:13px;">
                                                            {{ strtoupper(substr($order->name ?? 'U', 0, 1)) }}
                                                        </span>
                                                        <div>
                                                            <p class="mb-0 fw-semibold fs-14">{{ $order->name }}</p>
                                                            <span class="text-gray fs-13">{{ $order->email }}</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="fw-semibold">Rs. {{ number_format($order->total_amount, 0) }}</td>
                                                <td>
                                                    <span class="badge {{ $statusColors[$order->order_status] ?? 'bg-secondary' }}">
                                                        {{ ucfirst($order->order_status) }}
                                                    </span>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center text-gray py-4">No orders yet.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Order Status Breakdown -->
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-transparent border-0 p-5 pb-0">
                            <h4 class="mb-1">Order Status</h4>
                            <p class="text-gray mb-0">Distribution overview</p>
                        </div>
                        <div class="card-body">
                            <div id="orderStatusChart" class="d-flex justify-content-center mb-4"></div>

                            @php
                                $statusMeta = [
                                    'pending'     => ['label' => 'Pending',     'color' => '#fd7e14'],
                                    'processing'  => ['label' => 'Processing',  'color' => '#0dcaf0'],
                                    'shipped'     => ['label' => 'Shipped',     'color' => '#6f42c1'],
                                    'delivered'   => ['label' => 'Delivered',   'color' => '#198754'],
                                    'cancelled'   => ['label' => 'Cancelled',   'color' => '#dc3545'],
                                ];
                                $maxCount = max(array_merge(array_values($statusCounts), [1]));
                            @endphp

                            @foreach($statusMeta as $key => $meta)
                                <div class="mb-3">
                                    <div class="d-flex align-items-center justify-content-between mb-1">
                                        <span class="fs-14">
                                            <span style="display:inline-block;width:8px;height:8px;border-radius:50%;background:{{ $meta['color'] }};margin-right:6px;"></span>
                                            {{ $meta['label'] }}
                                        </span>
                                        <span class="fw-semibold fs-14">{{ $statusCounts[$key] ?? 0 }}</span>
                                    </div>
                                    <div class="progress" style="height:6px;">
                                        <div class="progress-bar"
                                             style="width: {{ (($statusCounts[$key] ?? 0) / $maxCount) * 100 }}%; background-color: {{ $meta['color'] }};">
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            <a href="{{ route('admin.orders.index') }}" class="btn btn-primary w-100 mt-3">
                                <i class="bi bi-arrow-right-circle me-1"></i> Manage All Orders
                            </a>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</main>

<script>
document.addEventListener('DOMContentLoaded', function () {

    // Revenue & Orders Chart
    const revenueOrdersOptions = {
        series: [
            { name: 'Revenue (Rs.)', type: 'column', data: @json($revenueData) },
            { name: 'Orders', type: 'line', data: @json($ordersData) }
        ],
        chart: { height: 340, type: 'line', toolbar: { show: false } },
        stroke: { width: [0, 3] },
        colors: ['#6f42c1', '#0dcaf0'],
        plotOptions: { bar: { borderRadius: 6, columnWidth: '40%' } },
        labels: @json($chartLabels),
        xaxis: { categories: @json($chartLabels) },
        yaxis: [
            { title: { text: 'Revenue (Rs.)' } },
            { opposite: true, title: { text: 'Orders' } }
        ],
        legend: { show: false }
    };
    new ApexCharts(document.querySelector("#revenueOrdersChart"), revenueOrdersOptions).render();

    // Order Status Donut
    const statusCounts = @json($statusCounts);
    const orderStatusOptions = {
        series: Object.values(statusCounts),
        chart: { type: 'donut', height: 260 },
        labels: ['Pending', 'Processing', 'Shipped', 'Delivered', 'Cancelled'],
        colors: ['#fd7e14', '#0dcaf0', '#6f42c1', '#198754', '#dc3545'],
        legend: { show: false },
        plotOptions: {
            pie: {
                donut: {
                    labels: {
                        show: true,
                        total: {
                            show: true,
                            label: 'Total',
                            formatter: function (w) {
                                return w.globals.seriesTotals.reduce((a, b) => a + b, 0);
                            }
                        }
                    }
                }
            }
        }
    };
    new ApexCharts(document.querySelector("#orderStatusChart"), orderStatusOptions).render();
});
</script>
@endsection
