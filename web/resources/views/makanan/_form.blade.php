<div class="mb-3">
    <label for="nama_makanan" class="form-label">Nama Makanan</label>
    <input type="text" name="nama_makanan" id="nama_makanan" class="form-control @error('nama_makanan') is-invalid @enderror"
        value="{{ old('nama_makanan', $makanan->nama_makanan ?? '') }}" required placeholder="Contoh: Nasi Goreng Spesial">
    @error('nama_makanan')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="deskripsi" class="form-label">Deskripsi / Keterangan</label>
    <textarea name="deskripsi" id="deskripsi" rows="3" class="form-control @error('deskripsi') is-invalid @enderror"
        placeholder="Contoh: Nasi goreng lezat dengan telur dan ayam suwir">{{ old('deskripsi', $makanan->deskripsi ?? '') }}</textarea>
    @error('deskripsi')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
