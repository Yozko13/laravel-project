<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\WebController;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends WebController
{
    /**
     * @return View
     */
    public function index()
    {
        $category_list = $this->getCategoryList();

        return $this->view('web.home', compact('category_list'));
    }
}
