<?php

namespace App\Http\Controllers;

use App\Models\ProductModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $listProduct = ProductModel::all();

        $data = [
            'listProduct' => $listProduct
        ];
        return view('product.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama_product' => 'required',
            'harga_product' => 'required',
            'foto_product' => 'required|file|image|mimes:jpeg,png,jpg|max:5048',
            'category_product' => 'required',
            'deskripsi_product' => 'required',
        ]);

        $file = $request->file('foto_product');

        $namaFile = "Product-" . time() . "-" . $file->getClientOriginalName();

        $tujuanUpload = 'img/Product';
        $path = $file->move($tujuanUpload, $namaFile);

        ProductModel::create([
            'foto_product' => $path,
            'nama_product' => $request->nama_product,
            'category_product' => $request->category_product,
            'harga_product' => $request->harga_product,
            'deskripsi_product' => $request->deskripsi_product,
        ]);

        return redirect('product')->with('success', 'Product successfully created');
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductModel $productModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $listProduct = ProductModel::where('id', $id)->first();

        $data = [
            'listProduct' => $listProduct
        ];

        return view('product.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama_product' => 'required',
            'harga_product' => 'required',
            'category_product' => 'required',
            'deskripsi_product' => 'required',
        ]);

        $check = ProductModel::where('id', $id)->first();

        if ($request->foto_product) {
            File::delete($check->foto_product);

            $file = $request->file('foto_product');
            $namaFile = "Product-" . time() . "-" . $file->getClientOriginalName();
            $tujuanUpload = 'img/Product';
            $path = $file->move($tujuanUpload, $namaFile);

            $check->update([
                'foto_product' => $path,
                'nama_product' => $request->nama_product,
                'category_product' => $request->category_product,
                'harga_product' => $request->harga_product,
                'deskripsi_product' => $request->deskripsi_product,
            ]);

            return redirect('product')->with('success', 'Berhasil Di update');
        } else {
            $check->update([
                'nama_product' => $request->nama_product,
                'category_product' => $request->category_product,
                'harga_product' => $request->harga_product,
                'deskripsi_product' => $request->deskripsi_product,
            ]);

            return redirect('product')->with('success', 'Berhasil Di update');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $deleteProduct = ProductModel::where('id', $id)->first();
        File::delete($deleteProduct->foto_product);
        $deleteProduct->delete();

        return redirect('product')->with('success', 'Berhasil Di Hapus');
    }
}
