@extends('layout')

@section('title', 'Riwayat Periksa')

@section('content')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Dokter</h1>
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
      <div class="card-header">
        <h3 class="card-title">Riwayat Periksa</h3>
        <div class="card-tools">
          <div class="input-group input-group-sm" style="width: 200px;">
            <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
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
              <th>Pasien</th>
              <th>Tanggal Periksa</th>
              <th>Catatan</th>
              <th>Obat</th>
              <th>Biaya Periksa</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach($periksas as $index => $periksa)
              <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ 'P' . str_pad($periksa->id, 3, '0', STR_PAD_LEFT) }}</td>
                <td>{{ $periksa->pasien->nama ?? '-' }}</td>
                <td>{{ \Carbon\Carbon::parse($periksa->tgl_periksa)->format('d-m-Y') }}</td>
                <td>{{ $periksa->catatan ?? '-' }}</td>
                <td>
                  @if($periksa->detailPeriksa->isNotEmpty())
                    @foreach($periksa->detailPeriksa as $detail)
                      <p>{{ $detail->obat->nama_obat }}</p>
                    @endforeach
                  @else
                    <p>No medicine prescribed</p>
                  @endif
                </td>
                <td>
                  Rp{{ number_format($periksa->detailPeriksa->isNotEmpty() ? $periksa->biaya_periksa : 0, 0, ',', '.') }}
                </td>
                <td>
                  <a href="{{ route('dokter.periksa.edit', $periksa->id) }}" class="btn btn-sm btn-warning">
                    Edit Obat
                  </a>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</section>
@endsection
