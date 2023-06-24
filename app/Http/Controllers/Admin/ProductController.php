<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Color;
use App\Models\ProductImage;
use Exception;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderBy('name', 'DESC')->paginate(20);

        return view('admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::whereActive(true)->orderBy('name')->get();
        $colors     = Color::whereActive(true)->orderBy('name')->get();

        return view('admin.product.create-edit', compact('categories', 'colors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        $data = $request->except('_token', 'images', 'old_images', 'colors');

        DB::beginTransaction();

        try {
            $product = Product::create($data);

            if (!isset($product)) {
                throw new Exception("Is not create product", 1);
            }

            foreach ($request->images as $key => $image) {
                $file = $image;
                $filename = uniqid() . '.' . $file->getClientOriginalExtension();
                $file->storeAs('public/uploads/product-images', $filename);

                ProductImage::create([
                    'product_id' => $product->id,
                    'image'      => $filename,
                    'is_main'    => $key == 0,
                ]);
            }

            $product->colors()->sync($request->colors);

            DB::commit();

            return to_route('cms.products.index')->with(
                'success_message',
                __('Successfully added :name :title', ['name' => __('Product'), 'title' => $product->name])
            );
        } catch (\Throwable $th) {
            report($th);

            DB::rollBack();

            return back()->withErrors(['system_error' => __('System error')]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, Product $product)
    {

        // if ($request->has('old_images')) {
        //     foreach ($request->old_images as $old_image_id) {
        //         # code...
        //     }
        //     $file = $request->file('image');
        //     $filename = uniqid() . '.' . $file->getClientOriginalExtension();
        //     $file->storeAs('public/uploads/categories', $filename);

        //     $product->image = $filename;
        //     $product->save();
        // }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
