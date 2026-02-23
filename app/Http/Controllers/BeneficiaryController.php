<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Beneficiary;
use App\Models\Division;
use Illuminate\Support\Facades\Log;
use PhpOffice\PhpSpreadsheet\IOFactory;

class BeneficiaryController extends Controller
{
    // public function index(Request $request)
    // {
    //     $query = Beneficiary::with(['division', 'district', 'upazila']);

    //     if ($request->filled('search')) {

    //         $search = $request->search;
    //         Log::info("Search term: {$search}"); // Debug log for search term

    //         $query->where(function ($q) use ($search) {

    //             $q->where('name', 'like', "%{$search}%")
    //                 ->orWhereHas('division', function ($q2) use ($search) {
    //                     $q2->where('name', 'like', "%{$search}%");
    //                 })

    //                 ->orWhereHas('district', function ($q3) use ($search) {
    //                     $q3->where('name', 'like', "%{$search}%");
    //                 });
    //         });
    //     }

    //     $beneficiaries = $query->paginate(10)->withQueryString();
    //     // $beneficiaries = Beneficiary::with('division', 'district', 'upazila')->latest()->get();

    //     return view('admin.beneficiaries.beneficiary', compact('beneficiaries'));
    // }

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
        $divisions = Division::where('status', 'active')->get();
        return view('admin.beneficiaries.create', compact('divisions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nid'  => 'required|string|max:50',
        ]);

        Beneficiary::create($request->all());

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
            'name',
            'nid',
            'address',
            'division',
            'district',
            'upazila',
            'union',
            'phone',
            'gender',
            'father',
            'mother'
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



    // Filter options

    public function index(Request $request)
    {

        $query = Beneficiary::query();

        // Search filter
        if ($request->search) {

            $query->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('phone', 'like', '%' . $request->search . '%')
                ->orWhere('nid', 'like', '%' . $request->search . '%')
                ->orWhereHas('division', function ($q) use ($request) {
                    $q->where('name', 'like', '%' . $request->search . '%');
                })
                ->orWhereHas('district', function ($q) use ($request) {
                    $q->where('name', 'like', '%' . $request->search . '%');
                })
                ->orWhereHas('upazila', function ($q) use ($request) {
                    $q->where('name', 'like', '%' . $request->search . '%');
                });
        }

        $beneficiaries = $query->get();
        return view(
            'admin.beneficiaries.beneficiary',
            compact('beneficiaries')
        );
    }


    // show details option

    public function show($id)
    {
        $beneficiary = Beneficiary::findOrFail($id);

        return view('admin.beneficiaries.show', compact('beneficiary'));
    }


    
}
