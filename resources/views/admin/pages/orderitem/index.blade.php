@extends('admin.layouts.app')
@section('content')
<!-- Main Wrapper-->
<main class="main-wrapper">
    <div class="container-fluid">
        <div class="inner-contents">
             <!-- Order Items Table -->
             <div class="card border-0 p-5">
                <div class="card-header pb-3 bg-transparent border-0 d-flex align-items-center justify-content-between gap-3">
                    <h4 class="mb-0">Order Items</h4>
                    <form class="d-flex gap-2" method="GET" action="{{ route('admin.orderitems.index') }}">
                        <input type="text" class="form-control" name="order_id" placeholder="Order ID" value="{{ request('order_id') }}" style="max-width:120px">
                        <input type="text" class="form-control" name="q" placeholder="Search product" value="{{ request('q') }}">
                        <button class="btn btn-primary" type="submit">Filter</button>
                        <a class="btn btn-outline-secondary" href="{{ route('admin.orderitems.index') }}">Reset</a>
                    </form>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table text-center align-middle">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Order</th>
                                    <th>Product</th>
                                    <th>Qty</th>
                                    <th>Price</th>
                                    <th>Subtotal</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($items as $it)
                                    <tr>
                                        <td>#{{ $it->id }}</td>
                                        <td>
                                            <a href="{{ route('admin.orderitems.index', ['order_id' => $it->order_id]) }}">Order #{{ $it->order_id }}</a>
                                        </td>
                                        <td>{{ $it->product_name }}</td>
                                        <td>{{ $it->qty }}</td>
                                        <td>{{ number_format($it->price, 2) }}</td>
                                        <td>{{ number_format($it->subtotal, 2) }}</td>
                                        <td>{{ optional($it->created_at)->format('Y-m-d H:i') }}</td>
                                    </tr>
                                @empty
                                    <tr><td colspan="7">No items found.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    @if(method_exists($items, 'links'))
                        <div class="mt-3">{{ $items->links() }}</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</main>

@endsection
