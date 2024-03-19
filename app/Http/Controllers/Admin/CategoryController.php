<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    protected $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }
    public function index()
    {
        $categories = $this->category::orderByDesc('id')->paginate(10);
        return view('admin.categories.index', compact('categories'));
    }


    public function create()
    {
        $parentCategories = $this->category::whereNull('parent_id')->with('childrens')->get();
        return view('admin.categories.create', compact('parentCategories'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:36|unique:categories,name'
        ]);
        $dataCreate = $request->all();
        $category = $this->category::create($dataCreate);
        return redirect()->route('category.index')->with(['success' => 'Create category : ' . $category->name . ' success !']);
    }

    public function show(string $id)
    {

    }


    public function edit(string $id)
    {
        $category = $this->category->findOrFail($id);
        $parentCategories = $this->category::whereNull('parent_id')->with('childrens')->get();
        return view('admin.categories.edit', compact(['category','parentCategories']));
    }


    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|max:32|unique:categories,name,'.$id,
        ]);
        $dateUpdate = $request->all();
        $this->category::update($dateUpdate);
        return redirect()->route('category.index')->with(['success'=>'Update success !']);
    }



    public function destroy(string $id)
    {
        $category = $this->category->findOrFail($id);
        $category->delete();
        return redirect()->route('category.index')->with(['success'=>'Delete success !']);
    }
}
