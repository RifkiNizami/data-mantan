<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\MakananFavorit;
use App\Models\MantanTerindah;
use Illuminate\Http\Request;

class MantanTerindahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->query('q');

        $mantans = MantanTerindah::when($search, function ($query, $search) {
            $query->where('nama', 'like', "%{$search}%")
                ->orWhere('no_hp', 'like', "%{$search}%")
                ->orWhere('alamat', 'like', "%{$search}%")
                ->orWhere('makanan_favorit', 'like', "%{$search}%");
        })
            ->orderBy('id', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('mantan.index', compact('mantans', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $makananFavorits = MakananFavorit::orderBy('nama_makanan', 'asc')->get();

        return view('mantan.create', compact('makananFavorits'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
            'alamat' => 'nullable|string',
            'makanan_favorit' => 'nullable|string|max:255',
        ]);

        MantanTerindah::create($validated);

        return redirect()
            ->route('mantan.index')
            ->with('success', 'Data mantan berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $mantan = MantanTerindah::findOrFail($id);

        return view('mantan.show', compact('mantan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $mantan = MantanTerindah::findOrFail($id);
        $makananFavorits = MakananFavorit::orderBy('nama_makanan', 'asc')->get();

        return view('mantan.edit', compact('mantan', 'makananFavorits'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $mantan = MantanTerindah::findOrFail($id);

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
            'alamat' => 'nullable|string',
            'makanan_favorit' => 'nullable|string|max:255',
        ]);

        $mantan->update($validated);

        return redirect()
            ->route('mantan.index')
            ->with('success', 'Data mantan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $mantan = MantanTerindah::findOrFail($id);
        $mantan->delete();

        return redirect()
            ->route('mantan.index')
            ->with('success', 'Data mantan berhasil dihapus.');
    }
}
