<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Warehouseproduct;
use App\Models\Warehouse;
use App\Models\Product;
use App\Models\Category;
use DB;

class WarehouseProductController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'sender_warehouse_id'          => 'required',
            'receiver_warehouse_id'        => 'required',
            'product_id'                   => 'required',
            'quantity'                     => 'required'
            ]);

            $status = DB::table('warehouses')->where('id', $request->sender_warehouse_id)->get();
            

            $receiver_product = DB::table('warehouseproducts')->where('receiver_warehouse_id', $request->sender_warehouse_id)->where('product_id', $request->product_id)->get()->sum('quantity');
            $sender_product   = DB::table('warehouseproducts')->where('sender_warehouse_id',   $request->sender_warehouse_id)->where('product_id', $request->product_id)->get()->sum('quantity');
            $total=$receiver_product-$sender_product;

            
            if($total >= $request->quantity & $request->sender_warehouse_id != $request->receiver_warehouse_id )
                {
                    $Warehousproduct = Warehouseproduct::create($request->all());
                    return $Warehousproduct;
                }

            else
                {
                    return response()->json(['message'=>'you dont have enough product']);      
                }
            
    }
    public function index(Request $request)
    {
        
        $receiver_product = DB::table('warehouseproducts')
        ->where('receiver_warehouse_id', $request->warehouse)
        ->where('product_id', $request->product)
        ->get()
        ->sum('quantity');

        $sender_product = DB::table('warehouseproducts')
        ->where('sender_warehouse_id', $request->warehouse)
        ->where('product_id', $request->product)
        ->get()
        ->sum('quantity');

        $total=$receiver_product-$sender_product;
      
        if($total <= 0)
        {
           return response()
           ->json(['message' => "You don't have any product", "Received $receiver_product products", "Sended $sender_product products"]);
        }
        else
        {
            return response()
            ->json(['message' => "You have $total products" , "Received $receiver_product products", "Sended $sender_product products"]);   
            
        }    

    
    }           
}
