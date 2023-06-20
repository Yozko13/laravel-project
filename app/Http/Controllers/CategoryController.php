<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Exception;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderBy('name', 'DESC')->paginate(20);

        return view('admin.nomenclatures.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.nomenclatures.categories.create-edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $request)
    {
        $data = $request->except('_token', 'image');

        try {
            $category = Category::create($data);

            if (!isset($category)) {
                throw new Exception("Is not create category", 1);
            }

            if (isset($category) && $request->hasFile('image')) {
                $file = $request->file('image');
                $filename = uniqid() . '.' . $file->getClientOriginalExtension();
                $file->storeAs('public/uploads/categories', $filename);

                $category->image = $filename;
                $category->save();
            }

            return to_route('cms.categories.index')->with(
                'success_message',
                __('Successfully added :name :title', ['name' => __('Category'), 'title' => $category->name])
            );
        } catch (\Throwable $th) {
            report($th);

            return back()->withErrors(['system_error' => __('System error')]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('admin.nomenclatures.categories.create-edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCategoryRequest  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $data = $request->except('_token', 'image');

        try {
            $category->fill($data);

            if ($request->hasFile('image')) {

                if (Storage::exists('public/uploads/categories/' . $category->image)) {
                    Storage::delete('public/uploads/categories/' . $category->image);
                }

                $file = $request->file('image');
                $filename = uniqid() . '.' . $file->getClientOriginalExtension();
                $file->storeAs('public/uploads/categories', $filename);

                $category->image = $filename;
            }

            $category->save();

            return to_route('cms.categories.index')->with(
                'success_message',
                __('Successfully saved :name :title', ['name' => __('Category'), 'title' => $category->name])
            );
        } catch (\Throwable $th) {
            report($th);

            return back()->withErrors(['system_error' => __('System error')]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
    }
}
