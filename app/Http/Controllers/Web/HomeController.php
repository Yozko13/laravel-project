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

        return view('web.index', compact('categories'));
    }
}
