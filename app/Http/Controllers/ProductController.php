<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    public function index(){
        $products = Product::all();
        return view('admin.product.index', compact('products'));
    }

    public function create(){
        $brands = Brand::all();
        $categories = Category::all();
        return view('admin.product.create', compact('brands', 'categories'));
    }

    public function store(ProductRequest $request)
    {
        $data = $request->validated();
        $Product = new Product;
        $data['created_by'] = Auth::user()->id;

        if($request->hasFile('image')){
            $file = $request->file('image');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('uploads/images'), $filename);
            $data['image'] = $filename;
        }

        $Product->create($data);

        return redirect('admin/products')->with('message', "Product created successfully");
    }

    public function edit($id){
        $product = Product::findOrFail($id);
        $brands = Brand::all();
        $categories = Category::all();
        return view('admin.product.edit', compact('product','brands','categories'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();

        $Product = Product::findOrFail($id);

        if($request->hasFile('image')){
            $destination = 'uploads/images/'.$Product->image;
            if(File::exists($destination)){
                File::delete($destination);
            }

            $file = $request->file('image');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('uploads/images'), $filename);
            $data['image'] = $filename;
        }
        $Product->update($data);

        return redirect('admin/products')->with('message', "Product updated successfully");
    }

    public function destroy($id)
    {
        $Product = Product::findOrFail($id);

        $destination = 'uploads/images/'.$Product->image;
        if(File::exists($destination)){
            File::delete($destination);
        }

        $Product->delete();

        return redirect('admin/products')->with('message', "Product deleted successfully");
    }
}
