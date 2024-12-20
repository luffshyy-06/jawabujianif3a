<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .table-container {
            max-height: 220px; 
            overflow-y: auto;
        }
        .bg-danger {
            background-color: pink !important;
        }
    </style>
</head>
<body>

<div class="container mt-2">
    <div class="d-flex justify-content-between align-items-center mb-2">
        <h2>Daftar Buku</h2>
        <div>
            <form action="{{ route('buku.index') }}" method="GET" class="d-flex mb-2">
                <input type="text" name="search" class="form-control" placeholder="Cari Nama Buku" value="{{ request('search') }}" aria-label="Cari Buku">
                <button type="submit" class="btn ms-2" style="background-color: purple; color: white;">Cari</button>
            </form>
            <a href="{{ route('buku.create') }}" class="btn btn-primary mb-2">Tambah Buku</a>
            <a href="/" class="btn btn-secondary mb-2">Dashboard</a>
        </div>
    </div>
        
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    
    <div class="alert alert-info mt-2">
        <strong>NOTE</strong>
        <ul>
            <li>Jika tabel data <strong> berwarna</strong>, Anggota belum mengembalikan buku.</li>
            <li>
                Sehingga untuk melihat total jumlah buku masing-masing, <strong>harus dengan seksama!!!</strong>
            </li>
        </ul>
    </div>

    <div class="table-container">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID Buku</th>
                    <th>Nama Buku</th>
                    <th>Penerbit</th>
                    <th>Pengarang</th>
                    <th>Jumlah</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($buku as $b)
                    <tr class="{{ $b->is_returned ? 'bg-danger' : '' }}"> <!-- Row is colored based on condition -->
                        <td>{{ $b->ID_Buku }}</td>
                        <td>{{ $b->Nama_Buku }}</td>
                        <td>{{ $b->Penerbit }}</td>
                        <td>{{ $b->Pengarang }}</td>
                        <td>{{ $b->Jumlah }}</td>
                        <td>
                            <a href="{{ route('buku.edit', $b->ID_Buku) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('buku.destroy', $b->ID_Buku) }}" method="POST" style="display:inline;">
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
