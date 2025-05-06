@extends('layout')

@section('title', 'Periksa')

@section('content')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Pasien</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Periksa</a></li>
          <li class="breadcrumb-item active">Dashboard v1</li>
        </ol>
      </div>
    </div>
  </div>
</section>

<section class="content">
  <div class="container-fluid">
    <div class="card">
      <div class="card-header bg-primary">
        <h3 class="card-title">Formulir Pemeriksaan</h3>
      </div>
      <form action="{{ route('pasien.periksaPost') }}" method="POST">
        @csrf
        <div class="card-body">

          {{-- Dokter --}}
          <div class="form-group">
            <label for="id_dokter">Pilih Dokter</label>
            <select name="id_dokter" id="id_dokter" class="form-control" required>
              <option value="">-- Pilih Dokter --</option>
              @foreach($dokters as $dokter)
                <option value="{{ $dokter->id }}">{{ $dokter->name }}</option>
              @endforeach
            </select>
          </div>

          {{-- Catatan --}}
          <div class="form-group">
            <label for="catatan">Catatan / Keluhan</label>
            <textarea name="catatan" id="catatan" class="form-control" rows="3" placeholder="Tulis keluhan Anda..."></textarea>
          </div>

        </div>
        <div class="card-footer">
          <button type="submit" class="btn btn-primary">Ajukan Pemeriksaan</button>
        </div>
      </form>
    </div>
  </div>
</section>
@endsection
