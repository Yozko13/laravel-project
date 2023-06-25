<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\WebController;
use App\Models\Product;

class ProductController extends WebController
{
    /**
     * Display the specified resource.
     *
     * @param  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $product = Product::where('slug', $slug)->with('images')->first();

        if (!isset($product)) {
            return to_route('home');
        }

        return $this->view('web.product', compact('product'));
    }
}
