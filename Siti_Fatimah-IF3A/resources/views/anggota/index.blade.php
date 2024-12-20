<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Anggota</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<style>
    .table-container {
        max-height: 365px; 
        overflow-y: auto;
    }
</style>

<body>

    <div class="container mt-2">
        <div class="d-flex justify-content-between align-items-center mb-2">
            <h2>Daftar Buku</h2>
            <div>
                <form action="{{ route('anggota.index') }}" method="GET" class="d-flex mb-2">
                    <input type="text" name="search" class="form-control" placeholder="Cari Nama Anggota" value="{{ request('search') }}" aria-label="Cari Anggota">
                    <button type="submit" class="btn ms-2" style="background-color: purple; color: white;">Cari</button>
                </form>
                <a href="{{ route('anggota.create') }}" class="btn btn-primary mb-2">Tambah Buku</a>
                <a href="/" class="btn btn-secondary mb-2">Dashboard</a>
            </div>
        </div>
            
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

    <div class="table-container">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID Anggota</th>
                    <th>Nama Anggota</th>
                    <th>Alamat</th>
                    <th>Jurusan</th>
                    <th>Tanggal Daftar</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($anggota as $ang)
                    <tr>
                        <td>{{ $ang->ID_Anggota }}</td>
                        <td>{{ $ang->Nama_Anggota }}</td>
                        <td>{{ $ang->Alamat }}</td>
                        <td>{{ $ang->Jurusan }}</td>
                        <td>{{ $ang->Tgl_Daftar }}</td>
                        <td>
                            <a href="{{ route('anggota.edit', $ang->ID_Anggota) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('anggota.destroy', $ang->ID_Anggota) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
