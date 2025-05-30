<?php

namespace App\Http\Controllers;

use App\Models\Label;
use Illuminate\Http\Request;

class LabelController extends Controller
{
    public function index()
    {
        $labels = Label::paginate(10);
        return view('labels.index', compact('labels'));
    }

    public function create()
    {
        return view('labels.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Label::create([
            'name' => $request->name,
        ]);

        return redirect()->route('labels.index')->with('success', 'Label berhasil dibuat');
    }

    public function show(Label $label)
    {
        return view('labels.show', compact('label'));
    }

    public function edit(Label $label)
    {
        return view('labels.edit', compact('label'));
    }

    public function update(Request $request, Label $label)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $label->update([
            'name' => $request->name,
        ]);

        return redirect()->route('labels.index')->with('success', 'Label berhasil diupdate');
    }

    public function destroy(Label $label)
    {
        $label->delete();
        return redirect()->route('labels.index')->with('success', 'Label berhasil dihapus');
    }
}
