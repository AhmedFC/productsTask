<?php
namespace App\Repository;
interface ProductRepositoryInterface
{

    // Get All Products
    public function Get_Products();

    // Get All Categories
    public function All_Categories();

   // Show Product
    public function Show_Product($id);

    //Store_Product
    public function Store_Product($request);

    //Update_Product
    public function Update_Product($request,$id);

    //Delete_Product
    public function Delete_Product($id);

     //Search_Product
     public function Search_Product();

}
