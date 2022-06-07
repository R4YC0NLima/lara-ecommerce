<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Product, Category};
use Illuminate\Http\Request;
use Inertia\Inertia;

class CategoryAdminController extends Controller
{
    public $products;
    public $categories;

    public function __construct(Product $products, Category $categories)
    {
        $this->products     = $products;
        $this->categories   = $categories;
    }

    public function index(Request $request)
    {
        $categories = $this->categories->when($request->search, function($query, $search) {
            $query->where('name', 'LIKE', '%'.$search.'%');
        })->paginate(15);
        
        return Inertia::render('Admin/Categories/Index', [
            'categories' => $categories,
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Categories/Create');
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $this->categories->create($data);

        return redirect()->route('admin.categories.index')->with(['message' => 'Categoria salvo com sucesso!']);
    }

    public function edit(Request $request)
    {
        $category    = $this->categories->where('id', $request->route('categoryAdmin'))->firstOrFail();
        
        return Inertia::render('Admin/Categories/Edit', ['category' => $category]);
    }

    public function update(Request $request)
    {
        $category    = $this->categories->where('id', $request->route('categoryAdmin'))->firstOrFail();
        
        $category->update($request->all());
        return redirect()->route('admin.categories.index')->with(['message' => 'Categoria atualizado com sucesso!']);
    }

    public function destroy(Request $request)
    {
        $category    = $this->categories->where('id', $request->route('categoryAdmin'))->firstOrFail();
        $category->delete();
        return redirect()->route('admin.categories.index');
    }
}
