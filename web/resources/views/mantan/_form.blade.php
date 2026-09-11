<div class="mb-3">
    <label for="nama" class="form-label">Nama</label>
    <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror"
        value="{{ old('nama', $mantan->nama ?? '') }}" required>
    @error('nama')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="no_hp" class="form-label">No. HP</label>
    <input type="text" name="no_hp" id="no_hp" class="form-control @error('no_hp') is-invalid @enderror"
        value="{{ old('no_hp', $mantan->no_hp ?? '') }}" required>
    @error('no_hp')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="alamat" class="form-label">Alamat</label>
    <textarea name="alamat" id="alamat" rows="3" class="form-control @error('alamat') is-invalid @enderror">{{ old('alamat', $mantan->alamat ?? '') }}</textarea>
    @error('alamat')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="makanan_favorit" class="form-label">Makanan Favorit</label>
    @php
        $currentMakanan = old('makanan_favorit', $mantan->makanan_favorit ?? '');
        $foundInList = false;
    @endphp
    <select name="makanan_favorit" id="makanan_favorit" class="form-select @error('makanan_favorit') is-invalid @enderror">
        <option value="">-- Pilih Makanan Favorit --</option>
        @if(isset($makananFavorits) && count($makananFavorits) > 0)
            @foreach($makananFavorits as $item)
                @php
                    $selected = ($currentMakanan === $item->nama_makanan);
                    if ($selected) $foundInList = true;
                @endphp
                <option value="{{ $item->nama_makanan }}" {{ $selected ? 'selected' : '' }}>
                    {{ $item->nama_makanan }}
                </option>
            @endforeach
        @else
            @php
                $defaults = ['Nasi Goreng Spesial', 'Mie Ayam Bakso', 'Sate Ayam Madura'];
            @endphp
            @foreach($defaults as $def)
                @php
                    $selected = ($currentMakanan === $def);
                    if ($selected) $foundInList = true;
                @endphp
                <option value="{{ $def }}" {{ $selected ? 'selected' : '' }}>{{ $def }}</option>
            @endforeach
        @endif
        @if(!empty($currentMakanan) && !$foundInList)
            <option value="{{ $currentMakanan }}" selected>{{ $currentMakanan }} (Tersimpan)</option>
        @endif
    </select>
    @error('makanan_favorit')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

