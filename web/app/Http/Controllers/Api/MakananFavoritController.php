<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MakananFavorit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MakananFavoritController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = MakananFavorit::orderBy('id', 'asc')->get();

        return response()->json([
            'success' => true,
            'message' => 'Data makanan favorit berhasil diambil',
            'data' => $data,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_makanan' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors(),
            ], 422);
        }

        $makanan = MakananFavorit::create($validator->validated());

        return response()->json([
            'success' => true,
            'message' => 'Data makanan favorit berhasil ditambahkan',
            'data' => $makanan,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $makanan = MakananFavorit::find($id);

        if (! $makanan) {
            return response()->json([
                'success' => false,
                'message' => 'Data makanan favorit tidak ditemukan',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Data makanan favorit berhasil diambil',
            'data' => $makanan,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $makanan = MakananFavorit::find($id);

        if (! $makanan) {
            return response()->json([
                'success' => false,
                'message' => 'Data makanan favorit tidak ditemukan',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'nama_makanan' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors(),
            ], 422);
        }

        $makanan->update($validator->validated());

        return response()->json([
            'success' => true,
            'message' => 'Data makanan favorit berhasil diperbarui',
            'data' => $makanan,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $makanan = MakananFavorit::find($id);

        if (! $makanan) {
            return response()->json([
                'success' => false,
                'message' => 'Data makanan favorit tidak ditemukan',
            ], 404);
        }

        $makanan->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data makanan favorit berhasil dihapus',
        ]);
    }
}
