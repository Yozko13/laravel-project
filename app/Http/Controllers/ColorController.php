<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Http\Requests\StoreColorRequest;
use App\Http\Requests\UpdateColorRequest;
use Exception;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $colors = Color::orderBy('name', 'DESC')->paginate(20);

        return view('admin.nomenclatures.colors.index', compact('colors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.nomenclatures.colors.create-edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreColorRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreColorRequest $request)
    {
        $data = $request->except('_token');

        try {
            $color = Color::create($data);

            if (!isset($color)) {
                throw new Exception("Is not create color", 1);
            }

            return to_route('cms.colors.index')->with(
                'success_message',
                __('Successfully added :name :title', ['name' => __('color'), 'title' => $color->name])
            );
        } catch (\Throwable $th) {
            report($th);

            return back()->withErrors(['system_error' => __('System error')]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Color  $color
     * @return \Illuminate\Http\Response
     */
    public function show(Color $color)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Color  $color
     * @return \Illuminate\Http\Response
     */
    public function edit(Color $color)
    {
        return view('admin.nomenclatures.colors.create-edit', compact('color'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateColorRequest  $request
     * @param  \App\Models\Color  $color
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateColorRequest $request, Color $color)
    {
        $data = $request->except('_token');

        try {
            $color->fill($data);
            $color->save();

            return to_route('cms.colors.index')->with(
                'success_message',
                __('Successfully saved :name :title', ['name' => __('Color'), 'title' => $color->name])
            );
        } catch (\Throwable $th) {
            report($th);

            return back()->withErrors(['system_error' => __('System error')]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Color  $color
     * @return \Illuminate\Http\Response
     */
    public function destroy(Color $color)
    {
        //
    }
}
