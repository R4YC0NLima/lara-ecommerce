<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\{Product, Category};
use App\Services\SaleService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Inertia\Inertia;

class ProductController extends Controller
{
    public $products;
    public $categories;

    public function __construct(Product $products, Category $categories)
    {
        $this->products     = $products;
        $this->categories   = $categories;
    }
    public function index()
    {
        $cart = session('cart', []);
        $data = ['cart' => $cart];

        return Inertia::render('Client/Products/Index', [
            'products'      => $this->products->with('category')->get(),
            'categories'    => $this->categories->get(),
            'cart'          => $data  
        ]);
    }

    public function category($idCategory = 0, Request $request)
    {
        $data           = [];
        $listCategories = $this->categories->all();
        $queryProduct   = $this->products->limit(4);

        

        if($idCategory != 0)
        {
            $queryProduct->where('category_id', $idCategory);
        }

        $listProducts           = $queryProduct->get();
        $data['list']           = $listProducts;
        $data['listCategories'] = $listCategories;

        return Inertia::render('Client/Categories/Index', ['data' => $data]);
    }

    public function addCart($idProduct = 0, Request $request)
    {
        $product = $this->products->with('category')->find($idProduct);
        $cart = session('cart', []);
        
        if($product && $request->session()->exists('cart')) {
            $product->amount = $product->amount++;
            $product->save();
            $request->session()->put($cart, $product);
            // array_push($cart, $product);
            session(['cart' => $cart]);
        } 

        return redirect()->route('products.index')->with(['message' => 'Produto adicionado com sucesso!']);
    }

    

    public function showCart()
    {
        $cart = session('cart', []);
        
        $data = ['cart' => $cart];

        return Inertia::render('Client/Cart/Cart', ['data' => $data]);
    }
    
    public function cartDestroy(int $index, Request $request)
    {
        $cart = session('cart', []);

        foreach ($cart as $product) {
            if ($product['id'] == $index) {
                unset($cart[$index]);
            }
        }

        session('cart', $cart);
        return redirect()->route('products.index');
    }

    public function finish(Request $request)
    {
        $prods          = session('cart', []);
        $saleService    = new SaleService();
        // $result         = $saleService->saleFinish($prods, auth()->user());
        

        // if($result["status"] == "ok")
        // {
            $request->session()->forget('cart');
        // }

        // $request->session()->flash($result["status"], $result["message"]);

        return redirect()->route('products.index')->with(['message' => 'teste']);
    }
}

