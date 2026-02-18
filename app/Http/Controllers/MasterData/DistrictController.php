<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Division;
use Illuminate\Http\Request;



class DistrictController extends Controller
{
    // Front page / list
    public function list()
    {
        $districts = District::with('division')->get();
        return view('admin.master_data.district.list', compact('districts'));
    }

    // Show create form
    public function create()
    {
        $divisions = Division::where('status', 'active')->get();
        return view('admin.master_data.district.create', compact('divisions'));
    }

    // Store new district
    public function store(Request $request)
    {


        $request->validate([
            'division_id' => 'required|exists:divisions,id',
            'name' => 'required|string|max:255',
            'bn_name' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:active,inactive',
            'url' => 'nullable|string|max:255' // <-- change from url to string
        ]);

        District::create($request->all());

        return redirect()->route('district.list')->with('success', 'District added successfully.');
    }


    // Show edit form
    public function edit(District $district)
    {
        $divisions = Division::all();
        return view('admin.master_data.district.edit', compact('district', 'divisions'));
    }

    // Update district
    public function update(Request $request, District $district)
    {
        $request->validate([
            'division_id' => 'required|exists:divisions,id',
            'name' => 'required|string|max:255',
            'bn_name' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:active,inactive',
            'url' => 'nullable|string|max:255'
        ]);

        $district->update($request->all());
        return redirect()->route('district.list')->with('success', 'District updated successfully.');
    }

    // Delete district
    public function destroy(District $district)
    {
        $district->delete();
        return redirect()->route('district.list')->with('success', 'District deleted successfully.');
    }

    // for Saving diviosion id in district table



     // Search filter

public function filter(Request $request)
{
    $query = District::with('division');


    if ($request->filled('search')) {

        $search = $request->search;

        $query->where(function($q) use ($search){

            $q->where('name','like',"%{$search}%")
              ->orWhere('bn_name','like',"%{$search}%")
              ->orWhere('description','like',"%{$search}%")
              ->orWhere('url','like',"%{$search}%")

              ->orWhereHas('division', function($q2) use ($search){
                    $q2->where('name','like',"%{$search}%");
              });

        });

    }


    // Status filter
    if ($request->filled('status')) {

        $query->where('status', $request->status);

    }


    $districts = $query->paginate(10)->withQueryString();


    return view('admin.master_data.district.list', compact('districts'));
}








}
