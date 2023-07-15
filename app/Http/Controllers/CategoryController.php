<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::all();
        return view('admin.category.index', compact('categories'));
    }


    public function create(){
        return view('admin.category.create');
    }

    public function store(CategoryRequest $request)
    {
        $data = $request->validated();

        $category = new Category;
        $data['created_by'] = Auth::user()->id;
        $category->create($data);

        return redirect('admin/categories')->with('message', "Category created successfully");
    }

    public function edit($id){
        $category = Category::findOrFail($id);
        return view('admin.category.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();

        $category = Category::findOrFail($id);
        $category->update($data);

        return redirect('admin/categories')->with('message', "Category updated successfully");
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect('admin/categories')->with('message', "Category deleted successfully");
    }
}
