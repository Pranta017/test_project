<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\Controller;

class UpazilaController extends Controller
{
    public function list()
    {
        return view('admin.master_data.upazila.list');
    }
}

