<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\MakananFavorit;
use Illuminate\Http\Request;

class MakananFavoritController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->query('q');

        $makanans = MakananFavorit::when($search, function ($query, $search) {
            $query->where('nama_makanan', 'like', "%{$search}%")
                ->orWhere('deskripsi', 'like', "%{$search}%");
        })
            ->orderBy('id', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('makanan.index', compact('makanans', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('makanan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_makanan' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        MakananFavorit::create($validated);

        return redirect()
            ->route('makanan-favorit.index')
            ->with('success', 'Data makanan favorit berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $makanan = MakananFavorit::findOrFail($id);

        return view('makanan.edit', compact('makanan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $makanan = MakananFavorit::findOrFail($id);

        $validated = $request->validate([
            'nama_makanan' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        $makanan->update($validated);

        return redirect()
            ->route('makanan-favorit.index')
            ->with('success', 'Data makanan favorit berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $makanan = MakananFavorit::findOrFail($id);
        $makanan->delete();

        return redirect()
            ->route('makanan-favorit.index')
            ->with('success', 'Data makanan favorit berhasil dihapus.');
    }
}
