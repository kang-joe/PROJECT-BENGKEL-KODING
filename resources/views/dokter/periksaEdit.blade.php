@extends('layout')

@section('title', 'Edit Obat Pasien')

@section('content')
<div class="container mt-4">
    <h2>Edit Obat untuk Periksa #{{ $periksa->id }}</h2>

    {{-- Obat yang Sudah Dipilih --}}
    <div class="mb-4">
        <h5>Obat Saat Ini:</h5>
        @if($periksa->detailPeriksa->isEmpty())
            <p class="text-muted">Belum ada obat yang ditambahkan.</p>
        @else
            <ul class="list-group">
                @foreach($periksa->detailPeriksa as $detail)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ $detail->obat->nama_obat }} - Rp{{ number_format($detail->obat->harga, 0, ',', '.') }}
                        <form action="{{ route('dokter.periksa.obat.hapus', $detail->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Hapus obat ini?')">Hapus</button>
                        </form>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>

    {{-- Form Menambahkan Obat Baru --}}
    <form action="{{ route('dokter.periksa.update', $periksa->id) }}" method="POST">
        @csrf
        @method('PUT') <!-- Spoofing PUT request for update -->
        
        <div class="form-group">
            <label for="id_obat">Tambah Obat Baru:</label>
            <select name="id_obat[]" class="form-control" multiple>
                @foreach($obats as $obat)
                    @if(!in_array($obat->id, $selectedObatIds))
                        <option value="{{ $obat->id }}">
                            {{ $obat->nama_obat }} - Rp{{ number_format($obat->harga, 0, ',', '.') }}
                        </option>
                    @endif
                @endforeach
            </select>
            <small class="form-text text-muted">Tekan CTRL (atau CMD) untuk memilih lebih dari satu obat.</small>
        </div>

        @if(count($obats->whereNotIn('id', $selectedObatIds)) === 0)
            <p class="text-muted mt-2">Semua obat sudah ditambahkan.</p>
        @else
            <button type="submit" class="btn btn-success mt-2">Tambah Obat</button>
        @endif
    </form>
</div>
@endsection
