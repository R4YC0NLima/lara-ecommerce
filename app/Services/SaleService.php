<?php

namespace App\Services;

use App\Models\{User, Order, OrderedItem};
use DateTime;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SaleService 
{
    public function saleFinish($products = [], User $user)
    {

        try {
            DB::beginTransaction();

            $dateDay            = new DateTime();
            $order              = new Order();
            $order->order_date  = $dateDay->format('Y-m-d H:i:s');
            $order->status      = "PENDING";
            $order->id_user     = $user->id;
            $order->save();

            $this->productItems($products, $dateDay, $order);
            
            DB::commit();
        } catch(Exception $e)
        {
            Log::error("Erro:Venda Service", ['message' => $e->getMessage()]);
        }
    }

    private function productItems($products, $dateDay, $order)
    {
        foreach($products as $product)
        {
            $items              = new OrderedItem();
            $items->amount      = $product->amount++;
            $items->price       = $product->price;
            $items->dt_item     = $dateDay->format('Y-m-d H:i:s');
            $items->product_id  = $product->id;
            $items->id_order    = $order->idate;
            $items->save();
        }

        return $items;
    }
}