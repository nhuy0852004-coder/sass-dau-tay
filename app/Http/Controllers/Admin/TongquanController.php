<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class TongquanController extends Controller
{
    public function index()
    {
        return view('admin.tongquan.index');
    }
}
