<?php

namespace App\Repositories;
use Illuminate\Support\Facades\DB;

class MenuRepository
{
    public function getParentMenu(){
        return DB::table("vw_parent_menu")
                  ->select("*")
                  ->get();
    }
}