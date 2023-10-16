@extends('tamplate')
@section('content')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="card card-body">
                <div class="d-flex justify-content-between">
                    <p class="card-title">Product</p>
                    <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#tambahDokument">Tambah
                            Product</button>
                    </div>
                </div>
                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">x</button>
                        <strong>{{ $message }}</strong>
                    </div>
                @endif
                @if ($message = Session::get('error'))
                    <div class="alert alert-danger alert-block">
                        <button type="button" class="close" data-dismiss="alert">x</button>
                        <strong>{{ $message }}</strong>
                    </div>
                @endif
                <div class="card-body">
                    <div id="example_wrapper" class="dataTables_wrapper">
                        <table id="example" class="display dataTables" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Product</th>
                                    <th>Harga Product</th>
                                    <th>Kategory</th>
                                    <th>Foto Product</th>
                                    <th>Deskripsi Product</th>
                                    <th style="width: 150px;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($listProduct as $data)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $data->nama_product }}</td>
                                        <td>{{ $data->harga_product }}</td>
                                        <td>{{ $data->category_product }}</td>
                                        <td>{{ $data->foto_product }}</td>
                                        <td>{{ $data->deskripsi_product }}</td>
                                        <td>
                                            <a class="btn btn-sm btn-warning" href="{{ route('product.edit/'.$data->id) }}"> Edit </a>
                                            <form action="{{ route('category.destroy', $category->id) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-sm btn-danger btn-block">
                                                    Hapus
                                                </button>
                                            </form>
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

    <div id="tambahDokument" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- konten modal-->
            <div class="modal-content">
                <!-- heading modal -->
                <div class="modal-header">
                    Import Peserta
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- body modal -->
                <form action="{{ url('import-education') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <b>Document</b>
                            <input type="file" name="foto_product" class="form-control file-upload-info">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" value="Simpan" class="btn btn-primary">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script type="text/javascript" language="javascript"
        src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <script>
        $('#example').DataTable({
            responsive: true,
            scrollX: true
        });
    </script>
@endsection
