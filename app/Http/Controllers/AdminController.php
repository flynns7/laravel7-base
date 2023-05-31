<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Exception;

abstract class AdminController extends Controller
{

    protected $content = [
        "title" => ""
    ];

    public function __construct()
    {
    }
    protected function setTitle(String $title){
        $this->content["title"] = $title;
    }


}
