<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * @return View
     */
    public function index()
    {
        $categories = Category::whereActive(true)->get();

        $category_list = [];
        foreach ($categories as $category) {
            $product = $category->products->first();
            if (isset($product)) {
                $category_list[$category->id]['name']  = $category->name;
                $category_list[$category->id]['image'] = $category->getImageUrl();
                $category_list[$category->id]['price'] = $product->price;
            }
        }

        return view('web.index', compact('category_list'));
    }
}
