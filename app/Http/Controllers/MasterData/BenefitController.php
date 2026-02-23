<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\Controller;
use App\Models\Benefit;
use Illuminate\Http\Request;


class BenefitController extends Controller
{
    public function list()
    {
        $benefits = Benefit::all();
        return view('admin.master_data.benefit.list', compact('benefits'));
    }

    // create option benefit

    public function create()
    {
        return view('admin.master_data.benefit.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'bn_name' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:255',
            'status' => 'required|in:active,inactive',

        ]);

        Benefit::create($request->all());

        return redirect()->back()->with('success', 'Benefit added successfully!');
    }


    // Edit and update benefit

    public function edit($id)
    {
        $benefit = Benefit::findOrFail($id);

        return view('admin.master_data.benefit.edit', compact('benefit'));
    }

    public function update(Request $request, $id)
    {
        $benefit = Benefit::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'bn_name' => 'nullable',
            'description' => 'nullable',
            'status' => 'required',
        ]);

        $benefit->update($request->all());

        return redirect()->route('benefits.list')->with('success', 'Benefit updated successfully!');
    }


    // Delete benefit

    public function destroy($id)
    {
        Benefit::findOrFail($id)->delete();

        return redirect()->route('benefits.list')->with('success', 'Benefit Deleted Successfully');
    }
}
