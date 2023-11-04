<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->paginate(5);
        return view('products',compact('products'));
    }

    public function addProduct(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|unique:products',
                'price' => 'required',
            ],
            [
                'name.required' => 'Name is required',
                'name.unique' => 'Product already exists',
                'price.required' => 'Price is required',
            ]
        );
        $product            = new Product();
        $product->name      = $request->name;
        $product->price     = $request->price;
        $product->save();
        return response()->json([
            'status' => 'success',
        ]);
    }

    public function updateProduct(Request $request)
    {
        $request->validate(
            [
                'update_name' => 'required|unique:products,name,'.$request->update_id,
                'update_price' => 'required',
            ],
            [
                'update_name.required' => 'Name is required',
                'update_name.unique' => 'Product already exists',
                'update_price.required' => 'Price is required',
            ]
        );

        $product = Product::find($request->update_id);
        $product->name = $request->update_name;
        $product->price = $request->update_price;
        $product->update();
        return response()->json([
            'status' => 'success',
        ]);
    }

    public function deleteProduct(Request $request)
    {
        $product = Product::find($request->product_id);
        $product->delete();
        return response()->json([
            'status' => 'success',
        ]);
    }

    public function pagination()
    {
        $products = Product::latest()->paginate(5);
        return view('paginate-products',compact('products'))->render();
    }

    public function searchProduct(Request $request)
    {
        $products = Product::where('name', 'like', '%'.$request->search.'%')
                    ->orWhere('price', 'like', '%'.$request->search.'%')
                    ->orderBy('id','desc')
                    ->paginate(5);

        if($products->count() >= 1){
            return view('paginate-products',compact('products'))->render();
        }else{
            return response()->json([
                'status' => 'nothing_found',
            ]);
        }
    }
}
