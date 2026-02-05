<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Beneficiary;
use PhpOffice\PhpSpreadsheet\IOFactory;

class BeneficiaryController extends Controller
{
    public function index()
    {
        $beneficiaries = Beneficiary::latest()->get();
        return view('beneficiaries.index', compact('beneficiaries'));
    }

    public function importExcel(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls'
        ]);

        $file = $request->file('file');
        $spreadsheet = IOFactory::load($file->getPathName());
        $sheet = $spreadsheet->getActiveSheet();
        $rows = $sheet->toArray();

        $header = array_shift($rows);

        foreach ($rows as $row) {
            Beneficiary::create([
                'name' => $row[0] ?? null,
                'nid' => $row[1] ?? null,
                'address' => $row[2] ?? null,
                'division' => $row[3] ?? null,
                'district' => $row[4] ?? null,
                'upazila' => $row[5] ?? null,
                'union' => $row[6] ?? null,
                'phone' => $row[7] ?? null,
                'gender' => $row[8] ?? null,
                'father' => $row[9] ?? null,
                'mother' => $row[10] ?? null,
            ]);
        }

        return redirect()->back()->with('success', 'Excel imported successfully!');
    }
}
