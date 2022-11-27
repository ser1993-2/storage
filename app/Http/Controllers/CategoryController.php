<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return Category::get();
    }

    public function store(CategoryRequest $request)
    {
        return Category::create($request->only('name','parent_id'));
    }

    public function update(Request $request, $id)
    {
        return Category::where('id', $id)
            ->update($request->only('name','parent_id'));
    }

    public function destroy($id)
    {
        return Category::findOrFail($id)->delete();
    }

    public function getCategoriesWithProducts()
    {
        return Category::with('products')->get();
    }

    public function getCategoriesWithProductsById($id)
    {
        return Category::with('products')->where('id', $id)->first();
    }

}
