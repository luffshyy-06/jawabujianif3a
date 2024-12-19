<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Perpustakaan</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container">
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" href="#" onclick="loadContent('{{ route('anggota.index') }}')">Anggota</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" onclick="loadContent('{{ route('buku.index') }}')">Buku</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" onclick="loadContent('{{ route('detailpinjam.index') }}')">Peminjaman</a>
                </li>
            </ul>
        </div>
        <a href="/" class="brand-title">PERPUSTAKAAN FATIMAH</a>
    </div>
</nav>

<div class="sidebar">
    <img src="{{ asset('image/perpustakaan.jpg') }}" alt="Sidebar Image">
</div>

<div class="content">
    <div id="contentArea">
        <h1>Welcome to Perpustakaan Fatimah</h1>
        <p>Silahkan pilih menu pada navbar untuk melihat data.</p>
    </div>
</div>


<footer>
    <p>Siti Fatimah Az Zahrah - 2327250055</p>
</footer>

<script>
    function loadContent(route) {
        let contentArea = document.getElementById('contentArea');
        contentArea.innerHTML = 'Loading ...';
        fetch(route)
            .then(response => response.text())
            .then(data => {
                contentArea.innerHTML = data;
            })
            .catch(error => {
                contentArea.innerHTML = 'Gagal memuat data.';
            });
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
