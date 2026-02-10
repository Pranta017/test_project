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
        return view('admin.beneficiaries.beneficiary', compact('beneficiaries'));
    }

    public function importExcel(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);

        $spreadsheet = IOFactory::load($request->file('file')->getPathName());
        $rows = $spreadsheet->getActiveSheet()->toArray();

        array_shift($rows); // remove header

        foreach ($rows as $row) {
            if (count($row) < 11) continue;

            Beneficiary::updateOrCreate(
                ['nid' => $row[1]],
                [
                    'name' => $row[0],
                    'address' => $row[2],
                    'division' => $row[3],
                    'district' => $row[4],
                    'upazila' => $row[5],
                    'union' => $row[6],
                    'phone' => $row[7],
                    'gender' => $row[8],
                    'father' => $row[9],
                    'mother' => $row[10],
                ]
            );
        }

        return back()->with('success', 'Excel imported successfully!');
    }

    public function create()
    {
        return view('admin.beneficiaries.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nid'  => 'required|string|max:50',
        ]);

        Beneficiary::create($request->only([
            'name','nid','address','division','district',
            'upazila','union','phone','gender','father','mother'
        ]));

        return redirect()->route('beneficiaries.index')
            ->with('success', 'Beneficiary added successfully!');
    }

    public function edit($id)
    {
        $beneficiary = Beneficiary::findOrFail($id);
        return view('admin.beneficiaries.edit', compact('beneficiary'));
    }

    public function update(Request $request, $id)
    {
        $beneficiary = Beneficiary::findOrFail($id);

        $beneficiary->update($request->only([
            'name','nid','address','division','district',
            'upazila','union','phone','gender','father','mother'
        ]));

        return redirect()->route('beneficiaries.index')
            ->with('success', 'Beneficiary updated successfully!');
    }

    public function destroy($id)
    {
        Beneficiary::findOrFail($id)->delete();

        return redirect()->route('beneficiaries.index')
            ->with('success', 'Beneficiary deleted successfully!');
    }
}
