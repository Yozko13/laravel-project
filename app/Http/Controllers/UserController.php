<?php

namespace App\Http\Controllers;

use App\Http\Requests\CmsLoginRequest;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * @return View
     */
    public function cmsLogin()
    {
        return view('admin.login');
    }

    function cmsLoginForm(CmsLoginRequest $request)
    {
        dd($request->all());
    }
}
