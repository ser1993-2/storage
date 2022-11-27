<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index()
    {
        return Product::get();
    }

    public function store(ProductRequest $request)
    {
        return Product::create($request->only('name', 'price','category_id'));
    }

    public function update(Request $request, $id)
    {
        return Product::where('id', $id)->update($request->only('name','price','category_id'));
    }

    public function destroy($id)
    {
        return Product::findOrFail($id)->delete();
    }

    public function getProductsByCategoryId($id)
    {
        return Product::where('category_id', $id)->get();
    }

    public function getAllProductsByCategoryId($id)
    {
        $category = Category::with('children','products')->where('id',$id)->first();
        $products = null;

        if ($category) {
            $products = $category->products;

            foreach ($category->children as $child) {
                $child->products->map(function ($product) use ($products) {
                    $products->push($product);
                });
            }
        }

        return $products;
    }
}
