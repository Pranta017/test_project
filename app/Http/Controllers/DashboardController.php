<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Beneficiary;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $totalBeneficiaries = Beneficiary::count();

        $last7Days = now()->subDays(7);
        $newRegistrations = User::where('created_at', '>=', $last7Days)->count();

        $pendingRequests = 0;

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalBeneficiaries',
            'newRegistrations',
            'pendingRequests'
        ));
    }
}
