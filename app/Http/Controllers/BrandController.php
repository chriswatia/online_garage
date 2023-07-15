<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Requests\BrandRequest;
use Illuminate\Support\Facades\Auth;

class BrandController extends Controller
{
    public function index(){
        $brands = Brand::all();
        return view('admin.brand.index', compact('brands'));
    }

    public function create(){
        return view('admin.brand.create');
    }

    public function store(BrandRequest $request)
    {
        $data = $request->validated();

        $brand = new Brand;
        $data['created_by'] = Auth::user()->id;
        $brand->create($data);

        return redirect('admin/brands')->with('message', "Brand created successfully");
    }

    public function edit($id){
        $brand = Brand::findOrFail($id);
        return view('admin.brand.edit', compact('brand'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();

        $brand = Brand::findOrFail($id);
        $brand->update($data);

        return redirect('admin/brands')->with('message', "Brand updated successfully");
    }

    public function destroy($id)
    {
        $brand = Brand::findOrFail($id);
        $brand->delete();

        return redirect('admin/brands')->with('message', "Brand deleted successfully");
    }
}
