<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\WebController;
use App\Models\Color;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends WebController
{
    /**
     * @return View
     */
    public function index()
    {
        $query_symbol  = empty(count(request()->query())) ? '?' : '&';
        $category_list = $this->getCategoryList();
        $colors        = Color::whereActive(true)->get();
        $products      = Product::whereActive(true)
            ->when(request('categories'), function ($q) {
                $q->whereIn('category_id', request('categories'));
            })
            ->when(request('colors'), function ($q) {
                $q->whereHas('colors', function ($q) {
                    $q->whereIn('colors.id', request('colors'));
                });
            })
            ->when(request('price_from'), function ($q) {
                $q->where('price', '>=', request('price_from'));
            })
            ->when(request('price_to'), function ($q) {
                $q->where('price', '<=', request('price_to'));
            })
            ->when(request('order_price'), function ($q) {
                $q->orderBy('price', request('order_price'));
            })
            ->with('images')
            ->paginate(request('paginate_count') ?? 12)
        ;

        return $this->view('web.shop-around', compact('query_symbol', 'category_list', 'colors', 'products'));
    }
}
