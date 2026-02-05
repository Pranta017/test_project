<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BeneficiaryController extends Controller
{
    public function index()
    {
        // data fetch korte paren, ekhane for example blank page
        return view('beneficiaries.index');
    }
}
