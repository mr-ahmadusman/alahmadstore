@extends('admin.layouts.app')
@section('content')
<main class="main-wrapper">
    <div class="container-fluid">
        <div class="inner-contents">

<div class="container-fluid py-3">
    <h3 class="mb-3">Manage Images: {{ $product->name }}</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card mb-4">
        <div class="card-header bg-transparent">Upload New Images</div>
        <div class="card-body">
            <form action="{{ route('admin.product-images.store', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <input type="file" name="images[]" accept="image/*" class="form-control" multiple required>
                    <small class="text-muted">You can select multiple files</small>
                </div>
                <button class="btn btn-primary">Upload</button>
                <a class="btn btn-secondary" href="{{ route('admin.products.index') }}">Back to Products</a>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header bg-transparent">Existing Images</div>
        <div class="card-body">
            <div class="row g-3">
                @forelse($product->images as $img)
                    <div class="col-6 col-sm-4 col-md-3 col-lg-2 text-center">
                        <img src="/{{ $img->image_path }}" alt="" class="img-fluid border rounded mb-2" style="height:120px;object-fit:cover;width:100%">
                        <form action="{{ route('admin.product-images.destroy', [$product->id, $img->id]) }}" method="POST" onsubmit="return confirm('Delete this image?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger w-100">Delete</button>
                        </form>
                    </div>
                @empty
                    <p class="mb-0">No images uploaded yet.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>


        </div>
    </div>
</main>

@endsection
