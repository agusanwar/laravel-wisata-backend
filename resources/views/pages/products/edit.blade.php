@extends('layouts.app')

@section('title', 'Edit Products')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/bootstrap-daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Advanced Forms</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Forms</a></div>
                    <div class="breadcrumb-item">Products</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Products</h2>



                <div class="card">
                    <form action="{{ route('products.update', $product) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-header">
                            <h4>Input Text</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Name Product</label>
                                <input type="text"
                                    class="form-control @error('name')
                                is-invalid
                            @enderror"
                                    name="name" value="{{ $product->name }}">
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Price</label>
                                <input type="number"
                                    class="form-control @error('price')
                                is-invalid
                            @enderror"
                                    name="price" value="{{ $product->price }}">
                                @error('price')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Stock</label>
                                <input type="number"
                                    class="form-control @error('stock')
                                is-invalid
                            @enderror"
                                    name="stock" value="{{ $product->stock }}">
                                @error('stock')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-label">Category</label>
                                <select class="form-control selectric  @error('category_id') is-invalid @enderror" 
                                    name="category_id">
                                    <option value="">Choose Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" 
                                            {{ $category->id == $product->category_id ? 'selected' : '' }} >
                                            {{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="form-label mt-4">Photo Product</label>
                                <div class="col-sm-9">
                                    <input type="file" class="form-control" name="image" id="image"
                                        @error('image') is-invalid @enderror>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label>Description</label>
                                <input type="text"
                                    class="form-control @error('desc')
                                is-invalid
                            @enderror"
                                    name="desc" value="{{ $product->desc }}">
                                @error('desc')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>


                            <div class="form-group">
                                <label class="form-label">Status</label>
                                <div class="selectgroup selectgroup-pills">
                                    <label class="selectgroup-item">
                                       <input type="radio" name="status" value="published" class="selectgroup-input"
                                            {{ $product->status == 'published' ? 'checked' : '' }}>
                                        <span class="selectgroup-button">Published</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="status" value="archived" class="selectgroup-input"
                                            {{ $product->status == 'archived' ? 'checked' : '' }}>
                                         <span class="selectgroup-button">Archived</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="status" value="draft" class="selectgroup-input"
                                            {{ $product->status == 'draft' ? 'checked' : '' }}>
                                        <span class="selectgroup-button">Draft</span>
                                    </label>
                                </div>
                            </div>

                            <div class="form-group mb-0">
                                <label class="form-label w-100">Criteria</label>
                                <div class="selectgroup selectgroup-pills">
                                    <label class="selectgroup-item">
                                        <input type="radio" name="criteria" value="perorangan" class="selectgroup-input"
                                            {{ $product->criteria == 'perorangan' ? 'checked' : '' }}>
                                        <span class="selectgroup-button">Perorangan</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="criteria" value="rombongan" class="selectgroup-input"
                                            {{ $product->criteria == 'rombongan' ? 'checked' : '' }}>
                                        <span class="selectgroup-button">Rombongan</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="criteria" value="terusan" class="selectgroup-input"
                                            {{ $product->criteria == 'terusan' ? 'checked' : '' }}>
                                        <span class="selectgroup-button">Terusan</span>
                                    </label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label ">Is Favorite</label>
                                <div class="selectgroup selectgroup-pills">
                                    <label class="selectgroup-item">
                                        <input type="radio" name="is_favorite" value="1" class="selectgroup-input"
                                           {{ $product->is_favorite == 1 ? 'checked' : ''}}>
                                        <span class="selectgroup-button">Yes</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="is_favorite" value="0" class="selectgroup-input"
                                        {{ $product->is_favorite == 0 ? 'checked' : ''}}>
                                        <span class="selectgroup-button">No</span>
                                    </label>
                                </div>
                            </div>

                        </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-primary">Update Data</button>
                        </div>
                    </form>
                </div>

            </div>
        </section>
    </div>
@endsection

@push('scripts')
@endpush