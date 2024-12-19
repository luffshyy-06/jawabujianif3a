<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2 class="mb-4">Tambah Buku</h2>

    <form action="{{ route('buku.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="Nama_Buku" class="form-label">Nama Buku</label>
            <input type="text" name="Nama_Buku" id="Nama_Buku" class="form-control @error('Nama_Buku') is-invalid @enderror">
            @error('Nama_Buku')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="Penerbit" class="form-label">Penerbit</label>
            <input type="text" name="Penerbit" id="Penerbit" class="form-control @error('Penerbit') is-invalid @enderror">
            @error('Penerbit')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="Pengarang" class="form-label">Pengarang</label>
            <input type="text" name="Pengarang" id="Pengarang" class="form-control @error('Pengarang') is-invalid @enderror">
            @error('Pengarang')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="Jumlah" class="form-label">Jumlah</label>
            <input type="number" name="Jumlah" id="Jumlah" class="form-control @error('Jumlah') is-invalid @enderror">
            @error('Jumlah')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="/" class="btn btn-secondary">Kembali</a>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
