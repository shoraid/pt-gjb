<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('cms.dashboard.index');
    }
}
