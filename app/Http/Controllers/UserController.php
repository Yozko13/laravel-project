<?php

namespace App\Http\Controllers;

use App\Http\Requests\CmsLoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * @return View
     */
    public function cmsLogin()
    {
        return view('admin.login');
    }

    /**
     * @param CmsLoginRequest $request
     * @return void
     */
    function cmsLoginForm(CmsLoginRequest $request)
    {
        if (Auth::attempt(
            ['email' => $request->email, 'password' => $request->password],
            request('remember_me') ? true : false
        )) {
            $request->session()->regenerate();

            return to_route('cms.dashboard');
        }

        return back()->withErrors([
            'email' => __('Incorrect login details'),
        ])->onlyInput('email');
    }
}
