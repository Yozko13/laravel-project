<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Http\Requests\StoreCategoriesRequest;
use App\Http\Requests\UpdateCategoriesRequest;
use Exception;
use Illuminate\Support\Facades\Storage;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Categories::orderBy('name', 'DESC')->paginate(20);

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
     * @param  \App\Http\Requests\StoreCategoriesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoriesRequest $request)
    {
        $data = $request->except('_token', 'image');

        try {
            $category = Categories::create($data);

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
     * @param  \App\Models\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function show(Categories $categories)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Categories  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Categories $category)
    {
        return view('admin.nomenclatures.categories.create-edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCategoriesRequest  $request
     * @param  \App\Models\Categories  $category
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoriesRequest $request, Categories $category)
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
     * @param  \App\Models\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function destroy(Categories $categories)
    {
        //
    }
}
