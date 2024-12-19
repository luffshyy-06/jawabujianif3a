<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Peminjaman</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<style>
    .table-container {
        max-height: 180px; 
        overflow-y: auto;
    }
</style>

<body>

    <div class="container mt-2">
        <div class="d-flex justify-content-between align-items-center mb-2">
            <h2>Daftar Detail Peminjaman</h2>
            <div>
                <form action="{{ route('detailpinjam.index') }}" method="GET" class="d-flex mb-2">
                    <input type="text" name="search" class="form-control" placeholder="Cari Nomor Peminjaman" value="{{ request('search') }}" aria-label="Cari No Pinjam">
                    <button type="submit" class="btn ms-2" style="background-color: purple; color: white;">Cari</button>
                </form>
                <a href="{{ route('detailpinjam.create') }}" class="btn btn-primary mb-2">Tambah Detail Peminjaman</a>
                <a href="/" class="btn btn-secondary mb-2">Dashboard</a>
            </div>
        </div>
        
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
    
        <div class="alert alert-info mt-2">
            <strong>NOTE:</strong>
            <ul>
                <li>Batas peminjaman maksimal <strong>3 hari</strong>.</li>
                <li>
                    Perhitungan Denda :
                    <ul>
                        <li>Terlambat 3 hari pertama = <strong>Rp. 10.000</strong></li>
                        <li>Setiap keterlambatan 3 hari berikutnya = <strong>Rp. 5.000</strong></li>
                    </ul>
                </li>
            </ul>
        </div>

    <div class="table-container">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Nomor Peminjaman</th>
                    <th>ID Anggota</th>
                    <th>ID Buku</th>
                    <th>Tanggal Pinjam</th>
                    <th>Tanggal Kembali</th>
                    <th>Denda</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($detailPinjam as $detail)
                    <tr>
                        <td>{{ $detail->No_Pinjam }}</td>
                        <td>{{ $detail->anggota->ID_Anggota }}</td>
                        <td>{{ $detail->buku->ID_Buku }}</td>
                        <td>{{ $detail->Tgl_Pinjam }}</td>
                        <td>{{ $detail->Tgl_Kembali ?? 'Belum Kembali' }}</td>
                        <td>Rp. {{ number_format($detail->Denda, 0, ',', '.') }}</td>
                        <td>
                            <a href="{{ route('detailpinjam.edit', $detail->No_Pinjam) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('detailpinjam.destroy', $detail->No_Pinjam) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah yakin ingin menghapus data ini?')">Hapus</button>
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
