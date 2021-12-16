<?php

namespace App\Repository;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;



class ProductRepository implements ProductRepositoryInterface
{

    public function Get_Products()
    {
        $products = Product::with(['category'])->latest()->paginate(6);
        return response()->json($products);
    }

    public function All_Categories()
    {

        $categories = Category::all();
        return response()->json($categories);
    }

    public function Show_Product($id)
    {

        $product = Product::find($id);
        return response()->json($product);
    }



    public function Store_Product($request)
    {
        try {

            $validated = $request->validated();
            $product = Product::create($request->all());
            return response()->json(['success' => 'Add Product']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Something Is invalid Try Again Later...' . $e->getMessage()], 412);
        }
    }
    public function Update_Product($request, $id)
    {
        try {

            $validated = $request->validated();
            $product  = Product::findOrFail($id);
            $input = $request->all();
            $product->fill($input)->save();
            return response()->json(['success' => 'Edit Product']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Something Is invalid Try Again Later...' . $e->getMessage()], 412);
        }
    }

    public function Delete_Product($id)
    {
        Product::find($id)->delete();
    }

    public function Search_Product()
    {
        if ($search = \Request::get('q')) {

            $products = Product::with(['category'])->latest()->where(function ($query) use ($search) {
                $query->where('title', 'LIKE', "%$search%");
            })->paginate(6);
        } else {
            $products = Product::with(['category'])->latest()->paginate(6);
        }
        //dd($categories);
        return $products;
    }
}
