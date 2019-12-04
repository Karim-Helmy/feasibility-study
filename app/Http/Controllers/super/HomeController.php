<?php

namespace App\Http\Controllers\Super;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class HomeController extends Controller
{

    /**
     * [Trainer Home]
     * @return [type] [description]
     */
    public function index()
    {
        return view('super.index', [
            'title' => trans('admin.dashboard'),
        ]);
    }

    public function homepage()
    {

        return view('super.home', [
            'title' => trans('admin.homepage'),

        ]);
    }


}
