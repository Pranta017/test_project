<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Division;
use App\Models\Upazila;
use Illuminate\Http\Request;


class UpazilaController extends Controller
{
      public function list()
    {
        $upazilas = Upazila::with(['division', 'district'])->get();
        return view('admin.master_data.upazila.list', compact('upazilas'));
    }

    public function create()
    {
        $divisions = Division::all();
        $districts = District::all();
        return view('admin.master_data.upazila.create', compact('divisions', 'districts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'division_id' => 'required|exists:divisions,id',
            'district_id' => 'required|exists:districts,id',
            'status' => 'required|in:active,inactive',
        ]);

        Upazila::create($request->all());

        return redirect()->route('upazila.list')->with('success', 'Upazila created successfully.');
    }

    public function edit($id)
    {
        $upazila = Upazila::findOrFail($id);
        $divisions = Division::all();
        $districts = District::all();
        return view('admin.master_data.upazila.edit', compact('upazila', 'divisions', 'districts'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'division_id' => 'required|exists:divisions,id',
            'district_id' => 'required|exists:districts,id',
            'status' => 'required|in:active,inactive',
        ]);

        $upazila = Upazila::findOrFail($id);
        $upazila->update($request->all());

        return redirect()->route('upazila.list')->with('success', 'Upazila updated successfully.');
    }

    public function destroy($id)
    {
        $upazila = Upazila::findOrFail($id);
        $upazila->delete();

        return redirect()->route('upazila.list')->with('success', 'Upazila deleted successfully.');
    }

     public function getDistricts($division_id)
    {

        $districts = District::where('division_id', $division_id)->get();

        return response()->json($districts);

    }



    public function getUpazilas($district_id)
    {

        $upazilas = Upazila::where('district_id', $district_id)->get();

        return response()->json($upazilas);

    }


         // Search filter
public function index(Request $request)
{
    $query = Upazila::with(['division','district']);

    // Search filter
    if ($request->filled('search')) {

        $search = $request->search;

        $query->where(function($q) use ($search){

            $q->where('name','like',"%{$search}%")
              ->orWhere('description','like',"%{$search}%")
              ->orWhere('url','like',"%{$search}%")

              ->orWhereHas('division', function($q2) use ($search){
                    $q2->where('name','like',"%{$search}%");
              })

              ->orWhereHas('district', function($q3) use ($search){
                    $q3->where('name','like',"%{$search}%");
              });

        });
    }

    // Status filter
    if ($request->filled('status')) {

        $query->where('status', $request->status);

    }

    $upazilas = $query->paginate(10)->withQueryString();

    return view('admin.master_data.upazila.list', compact('upazilas'));
}



}
