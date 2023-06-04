<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Category;
use App\Models\Warehouseproduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        $validator = Validator::make($request->all(), [
            'name'          => 'required',
            'price_buy'     => 'required',
            'price_sold'    => 'required',
            'category_id'   => 'required',
            'status'        => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }


        $product = Product::find($id);
        $product->update($request->all());
        return response()->json(['data'=>$product],200);

    }

    public function destroy($id)
    {
        return Product::destroy($id);
    }
    public function tree(){
        $products=Product::all();
        $tree = [];
        foreach ($products as $data) {
            $tree[] = array(
                'key' => $data->id,
//                'value' => $data->id,
                'title' => $data->name,
            );
        }

        return response()->json($tree);
    }
}

