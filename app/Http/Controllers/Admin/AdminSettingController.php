<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;


class AdminSettingController extends Controller
{
public function index()
    {

        return view('admin.company.settings');
    }
}
