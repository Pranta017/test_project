<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MasterDataController extends Controller
{
    public function page1() {
        return view('admin.master.division.list');
    }
    public function page2() {
        return view('admin.master.district');
    }
    public function page3() {
        return view('admin.master.upazila');
    }
}

