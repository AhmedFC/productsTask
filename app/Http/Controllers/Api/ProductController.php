<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\addProduct;
use Intervention\Image\Facades\Image;
use App\Repository\ProductRepositoryInterface;
use DB;

class ProductController extends Controller
{
    protected $Product;
    function __construct(ProductRepositoryInterface $Product)
    {
        $this->Product = $Product;
    }
    public function index()
    {
        return $this->Product->Get_Products();
    }
    public function allCategories()
    {
        return $this->Product->All_Categories();
    }


    public function create()
    {
        //
    }


    public function store(addProduct $request)
    {
        return $this->Product->Store_Product($request);
    }


    public function show($id)
    {
        return $this->Product->Show_Product($id);
    }

    public function edit(Product $product)
    {
        //
    }

    public function update(addProduct $request, $id)
    {

        return $this->Product->Update_Product($request, $id);
    }

    public function destroy($id)
    {
        return $this->Product->Delete_Product($id);
    }


    public function search()
    {
        return $this->Product->Search_Product();
    }
}
