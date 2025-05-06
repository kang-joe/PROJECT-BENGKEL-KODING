@extends('layout')

@section('title', 'Riwayat Periksa')

@section('content')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Pasien</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Riwayat</a></li>
          <li class="breadcrumb-item active">Dashboard v1</li>
        </ol>
      </div>
    </div>
  </div>
</section>

<section class="content">
  <div class="container-fluid">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Riwayat Periksa</h3>
        <div class="card-tools">
          <div class="input-group input-group-sm" style="width: 200px;">
            <input
              type="text"
              name="table_search"
              class="form-control float-right"
              placeholder="Search"
            >
            <div class="input-group-append">
              <button type="submit" class="btn btn-default">
                <i class="fas fa-search"></i>
              </button>
            </div>
          </div>
        </div>
      </div>

      <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
          <thead>
            <tr>
              <th>No</th>
              <th>ID Periksa</th>
              <th>Dokter</th>
              <th>Tanggal Periksa</th>
              <th>Catatan</th>
              <th>Obat</th>
              <th>Biaya Periksa</th>
            </tr>
          </thead>
          <tbody>
            @foreach($periksas as $index => $periksa)
              <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ 'P' . str_pad($periksa->id, 3, '0', STR_PAD_LEFT) }}</td>
                <td>{{ $periksa->dokter->name ?? '-' }}</td> <!-- Display doctor's name -->
                <td>{{ \Carbon\Carbon::parse($periksa->tgl_periksa)->format('d-m-Y') }}</td>
                <td>{{ $periksa->catatan ?? '-' }}</td>
                <td>
    @foreach($periksa->detailPeriksa as $detail)
        {{ $detail->obat->nama_obat }} - 
        Rp{{ number_format($detail->harga_obat, 0, ',', '.') }}<br>
    @endforeach
</td>

                <td>Rp{{ number_format($periksa->biaya_periksa ?? 0, 0, ',', '.') }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</section>
@endsection
