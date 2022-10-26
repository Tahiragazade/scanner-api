<?php

namespace App\Http\Controllers;
use App\Models\Warehouse;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{


    public function store(Request $request)
    {

        $request->validate([
        'name'      => 'required',
        'address'   => 'required',
        'type'      => 'required',
        'status'    => 'required' 
        ]);

        $warehouse = Warehouse::create($request->all());
        return $warehouse;

    }

    public function show( $id)
    {
        return Warehouse::find($id);
    }

    public function index(Request $request)
    {
        return Warehouse::All();
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'      => 'required',
            'address'   => 'required',
            'type'      => 'required',
            'status'    => 'required' 
            ]);

        $warehouse = Warehouse::find($id);
        $warehouse->update($request->all());
        return $warehouse;

    }

    public function destroy($id)
    {
        return Warehouse::destroy($id);
    }
}
