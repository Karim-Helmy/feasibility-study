<?php

namespace App\Http\Controllers\Super;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Subscriber;
use App\Project;

class HomeController extends Controller
{

    /**
     * [Trainer Home]
     * @return [type] [description]
     */
    public function index()
    {
        return view('super.index', [
            'title' => trans('admin.add new project'),
        ]);
    }




}
