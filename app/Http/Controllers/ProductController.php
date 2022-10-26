<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Category;
use App\Models\Warehouseproduct;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function store(Request $request)
    {

        $request->validate([
        'name'          => 'required',
        'price_buy'     => 'required',
        'price_sold'    => 'required',
        'category_id'   => 'required', 
        'status'        => 'required'
        ]);

        $product = Product::create($request->all());
        return $product;

    }

    public function show( $id)
    {
        return Product::find($id);
    }

    public function index(Request $request)
    {
        return Product::with('category')->get();
     
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'          => 'required',
            'price_buy'     => 'required',
            'price_sold'    => 'required',
            'category_id'   => 'required', 
            'status'        => 'required'
            ]);

        $product = Product::find($id);
        $product->update($request->all());
        return $product;

    }

    public function destroy($id)
    {
        return Product::destroy($id);
    }
}

