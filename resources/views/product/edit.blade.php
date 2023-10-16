@extends('tamplate')
@section('content')
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Edit Product</h4>
            <p class="card-description">
                Basic form layout
            </p>
            <form action="{{ route('product.update', $listProduct->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="form-group">
                    <b>Nama Product</b>
                    <input name="nama_product" class="form-control" value="{{ $listProduct->nama_product }}">
                </div>
                <div class="form-group">
                    <b>Harga Product</b>
                    <input name="harga_product" class="form-control" value="{{ $listProduct->harga_product }}">
                </div>
                <div class="form-group">
                    <b>Category Product</b>
                    <input name="category_product" class="form-control" value="{{ $listProduct->category_product }}">
                </div>
                <div class="form-group">
                    <b>Foto Product</b><br>
                    <img src="{{ url($listProduct->foto_product) }}" style="height:200px;">
                    <input type="file" name="foto_product" class="form-control file-upload-info">
                </div>
                <div class="form-group">
                    <b>Deskripsi Product</b>
                    <input name="deskripsi_product" class="form-control" value="{{ $listProduct->deskripsi_product }}">
                </div>
                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                <button class="btn btn-light">Cancel</button>
            </form>
        </div>
    </div>
@endsection
