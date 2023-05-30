<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

class DashboardController extends AdminController
{
    public function index()
    {
        return view(
            'dashboard.index',
            $this->content
        );
    }
}
