<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

class WebController extends Controller
{
    /**
     * @param string $route
     * @param array $params
     * @return View
     */
    public function view(string $route, array $params = [])
    {
        $route_mame    = Route::currentRouteName();
        $current_cart  = Cart::where('session_id', Session::getId())->whereOrdered(false)->orderBy('id', 'DESC')->first();
        $title_counter = 0;

        return view($route, array_merge(compact('route_mame', 'current_cart', 'title_counter'), $params));
    }

    /**
     * @return array
     */
    public function getCategoryList(): array
    {
        $categories = Category::whereActive(true)->get();

        $list = [];
        foreach ($categories as $category) {
            $product = $category->products->first();
            if (isset($product)) {
                $list[$category->id]['name']  = $category->name;
                $list[$category->id]['image'] = $category->getImageUrl();
                $list[$category->id]['price'] = $product->price;
            }
        }

        return $list;
    }
}
