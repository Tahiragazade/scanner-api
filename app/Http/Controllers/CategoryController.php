<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function store(Request $request)
    {

        $request->validate([
        'name'          => 'required',
        'status'        => 'required',
        'parent_category'  => 'required'
        ]);

        $category = Category::create($request->all());
        return $category;
    }

    public function show( $id)
    {
        return Category::find($id);
    }

    public function index(Request $request)
    {
        return Category::with('products')->get();
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'name'          => 'required',
            'status'        => 'required',
            'parent_category'  => 'required'
            ]);

        $category = Category::find($id);
        $category->update($request->all());
        return $category;

    }

    public function destroy($id)
    {
        return Category::destroy($id);
    }
}