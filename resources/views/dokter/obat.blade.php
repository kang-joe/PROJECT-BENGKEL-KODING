@extends('layout')

@section('title', 'Obat Dokter')

@section('content')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Dokter</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Obat</a></li>
          <li class="breadcrumb-item active">Dashboard v1</li>
        </ol>
      </div>
    </div>
  </div>
</section>

<section class="content">
  <div class="container-fluid">

    <!-- Display success or error message -->
    @if(session('success'))
      <div class="alert alert-success">
        {{ session('success') }}
      </div>
    @elseif(session('error'))
      <div class="alert alert-danger">
        {{ session('error') }}
      </div>
    @endif

    <!-- Form untuk Menambah atau Edit Obat -->
    <div class="card">
      <div class="card-header bg-primary">
        <h3 class="card-title">{{ isset($obat) ? 'Edit Obat' : 'Tambah Obat' }}</h3>
      </div>
      <form action="{{ isset($obat) ? route('dokter.obatUpdate', $obat->id) : route('dokter.obatStore') }}" method="POST">
        @csrf
        @if(isset($obat))
          @method('PUT') <!-- Menggunakan method PUT untuk update -->
        @endif
        <div class="card-body">
          <div class="form-group">
            <label for="nama_obat">Nama Obat</label>
            <input type="text" name="nama_obat" id="nama_obat" class="form-control @error('nama_obat') is-invalid @enderror" placeholder="Nama Obat" value="{{ old('nama_obat', $obat->nama_obat ?? '') }}" required>
            @error('nama_obat')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="form-group">
            <label for="kemasan">Kemasan</label>
            <input type="text" name="kemasan" id="kemasan" class="form-control @error('kemasan') is-invalid @enderror" placeholder="Kemasan" value="{{ old('kemasan', $obat->kemasan ?? '') }}" required>
            @error('kemasan')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="form-group">
            <label for="harga">Harga</label>
            <input type="number" name="harga" id="harga" class="form-control @error('harga') is-invalid @enderror" placeholder="Harga" value="{{ old('harga', $obat->harga ?? '') }}" required>
            @error('harga')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
        </div>
        <div class="card-footer">
          <button type="submit" class="btn btn-primary">{{ isset($obat) ? 'Update Obat' : 'Tambah Obat' }}</button>
        </div>
      </form>
    </div>

    <!-- Tabel Daftar Obat -->
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Daftar Obat</h3>
      </div>
      <div class="card-body table-responsive p-0">
        <table class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>No</th>
              <th>ID Obat</th>
              <th>Nama Obat</th>
              <th>Kemasan</th>
              <th>Harga</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach($obats as $item)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $item->id }}</td>
              <td>{{ $item->nama_obat }}</td>
              <td>{{ $item->kemasan }}</td>
              <td>{{ number_format($item->harga, 0, ',', '.') }}</td>
              <td>
                <!-- Tombol Edit -->
                <a href="{{ route('dokter.obatEdit', $item->id) }}" class="btn btn-info btn-sm">Edit</a>

                <!-- Form Hapus -->
                <form action="{{ route('dokter.obatDelete', $item->id) }}" method="POST" style="display:inline;">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                </form>
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
