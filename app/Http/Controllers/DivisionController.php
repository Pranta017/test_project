<?php

namespace App\Http\Controllers\Admin\MasterData;

use App\Http\Controllers\Controller;

class DivisionController extends Controller
{
    public function list()
    {
        return view('admin.master_data.division.list');
    }
}

