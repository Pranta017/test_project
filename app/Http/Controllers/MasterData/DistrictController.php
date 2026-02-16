<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\Controller;

class DistrictController extends Controller
{
    public function list()
    {
        return view('admin.master_data.district.list');
    }
}
