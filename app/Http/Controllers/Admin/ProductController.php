<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderByDesc('id')->get();
        return view('fpool.products.products')->with('products', $products);
    }

    public function create()
    {
        return view('fpool.products.product');
    }

    public function store(ProductRequest $request)
    {
        $store = [
            'name'                 => $request->get('name'),
            'price'                => $request->get('price'),
            'premium_user_product' => $request->get('premium_user_product') ? true : false,
            'storage_limit'        => mb_to_bytes($request->get('storage_limit')),
        ];
        $product = Product::create($store);

        if ($product) {
            return redirect()->route('admin.product.edit', $product->id)->with('success', 'Product successfully created.');
        } else {
            return back()->with('error', 'Something gone wrong.');
        }

    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('fpool.products.product')->with('product', $product);
    }

    public function update($id, ProductRequest $request)
    {
        $product = Product::findOrFail($id);
        $update = $product->update([
            'name'                 => $request->get('name'),
            'price'                => $request->get('price'),
            'premium_user_product' => $request->get('premium_user_product') ? true : false,
            'storage_limit'        => mb_to_bytes($request->get('storage_limit')),
        ]);

        if ($update) {
            return back()->with('success', 'Product successfully updated.');
        } else {
            return back()->with('error', 'Something gone wrong.');
        }
    }

    public function destroy($id)
    {
        $product = Product::where('id', $id)->first();

        if ($product && $product->delete()) {
            return response()->json(['message' => 'Product successfully deleted.', 'status' => true]);
        }

        return response()->json(['message' => 'Something gone wrong.', 'status' => false], 404);
    }
}
