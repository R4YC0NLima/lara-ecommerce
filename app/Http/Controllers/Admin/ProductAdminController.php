<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Product, Category};
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductAdminController extends Controller
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
        $products = $this->products->when($request->search, function($query, $search) {
            $query->where('name', 'LIKE', '%'.$search.'%');
        })->with('category')->paginate(15);
        
        return Inertia::render('Admin/Products/Index', [
            'products' => $products,
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Products/Create', [
            'categories' => $this->categories->all()
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $this->products->create($data);

        return redirect()->route('admin.products.index')->with(['message' => 'Produto salvo com sucesso!']);
    }

    public function edit(Request $request)
    {
        $product    = $this->products->where('id', $request->route('productAdmin'))->firstOrFail();
        
        return Inertia::render('Admin/Products/Edit', ['product' => $product]);
    }

    public function update(Request $request)
    {
        $product    = $this->products->where('id', $request->route('productAdmin'))->firstOrFail();
        
        $product->update($request->all());
        return redirect()->route('admin.products.index')->with(['message' => 'Produto atualizado com sucesso!']);
    }

    public function destroy(Request $request)
    {
        $product    = $this->products->where('id', $request->route('productAdmin'))->firstOrFail();
        $product->delete();
        return redirect()->route('admin.products.index')->with(['message' => 'Produto removido com sucesso!']);
    }
}
