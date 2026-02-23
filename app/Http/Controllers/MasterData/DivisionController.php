<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\Controller;
use App\Models\Division;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DivisionController extends Controller
{
    public function list()
    {
        $divisions = Division::all();
        // fetch all divisions
        Log::info("sdcvsjh");
        Log::info($divisions);
        return view('admin.master_data.division.list', compact('divisions'));
    }

    public function create()
    {
        return view('admin.master_data.division.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'bn_name' => 'nullable|string|max:255',
            'status' => 'required|in:active,inactive',
            'description' => 'nullable|string|max:255',
            'url' => 'nullable|string|max:255',
        ]);

        Division::create($request->all());

        return redirect()->back()->with('success', 'Division added successfully!');
    }

    public function edit($id)
    {
        $division = Division::findOrFail($id);

        return view('admin.master_data.division.edit', compact('division'));
    }

    public function update(Request $request, $id)
    {
        $division = Division::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'bn_name' => 'nullable',
            'status' => 'required',
            'url' => 'nullable',
        ]);

        $division->update($request->all());

        return redirect()->route('division.list')
            ->with('success', 'Division updated successfully');
    }

    public function destroy($id)
    {
        Division::findOrFail($id)->delete();

        return redirect()->route('division.list')
            ->with('success', 'Division Deleted Successfully');
    }



     // Search filter
    public function filter(Request $request)
{
    $query = Division::query();

    if ($request->filled('search')) {

        $search = $request->search;

        $query->where(function($q) use ($search){

            $q->where('name','like',"%{$search}%")
              ->orWhere('bn_name','like',"%{$search}%")
              ->orWhere('description','like',"%{$search}%")
              ->orWhere('url','like',"%{$search}%");

        });

    }

    // Status filter
    if ($request->filled('status')) {

        $query->where('status', $request->status);

    }


    $divisions = $query->paginate(10)->withQueryString();


    return view('admin.master_data.division.list', compact('divisions'));
}



}
