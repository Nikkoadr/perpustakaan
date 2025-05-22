<?php

namespace App\Http\Controllers;

use App\Models\Example;
use Illuminate\Http\Request;

class ExampleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Example::all();
        return view('example.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('example.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'data_string' => 'required|string|max:255',
            'data_int' => 'required|integer',
            'data_text' => 'nullable|string',
            'date' => 'nullable|date',
        ]);

        Example::create($request->all());

        return redirect()->route('example.index')->with('success', 'Example created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Example $example)
    {
        return view('example.show', compact('example'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Example $example)
    {
        return view('example.edit', compact('example'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Example $example)
    {
        $request->validate([
            'data_string' => 'required|string|max:255',
            'data_int' => 'required|integer',
            'data_text' => 'nullable|string',
            'date' => 'nullable|date',
        ]);

        $example->update($request->all());

        return redirect()->route('example.index')->with('success', 'Example updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Example $example)
    {
        $example->delete();

        return redirect()->route('example.index')->with('success', 'Example deleted successfully.');
    }
}
