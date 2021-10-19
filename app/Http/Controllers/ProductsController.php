<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductsController extends Controller
{
    public function addproduct(Request  $request)
    {
        $product=new Product;
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');

        $file=$request->file('file');
        $featuredNewName=time().$file->getClientOriginalName();
        $file->move(public_path('/uploads'), $featuredNewName);

        $product->file_path='public/uploads/'.$featuredNewName;
        $product->save();
        return $product;
    }

    public function listproducts()
    {
        $products= Product::all();
        return $products;
    }

    public function getProduct($id)
    {
        $products= Product::find($id);
        return $products;
    }
    public function delete($id)
    {
        $product= Product::where('id', $id)->delete();
        if($product){
            return['message'=>'Product deleted Successfully'];
        } else{
            return['message'=>'Failed to delete'];
        }
    }

    public function search($key)
    {
        $product= Product::where('name','like',"%$key%")->get();
        if($product){
            return $product;
        } else{
            return['message'=>'Failed not found'];
        }
        return $key;
    }

    public function update(Request $request, $id)
    {
        $product=Product::find($id);
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $file=$request->file('file');
        if($file){
            $featuredNewName=time().$file->getClientOriginalName();
            $file->move(public_path('/uploads'), $featuredNewName);
            $product->file_path='public/uploads/'.$featuredNewName;
        }
        $product->save();
        return $product;
    }
}
