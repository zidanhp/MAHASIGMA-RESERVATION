<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="icon" href="./image/favico.ico" type="image/x-icon">
    <title>Dashboard</title>
    <style>
        .navbar-brand {
            margin-left: 20px;
        }

        .navbar {
            background: linear-gradient(to right, #007aff, #105f2d);
        }

        .icon i {
            font-size: 20px;
            margin-right: 20px;
        }

        .col-md-2 {
            background: linear-gradient(to top, #007bff, #424a45);
            min-height: 100vh;
        }

        .nav {
            position: fixed;
        }

        .bg-info {
            position: fixed;
        }

        .nav-link {
            margin: 10px;
        }

        .nav-link:hover {
            background-color: #16A34A;
            color: white !important;
            border-radius: 10px;
            transition: background-color 0.5s ease, color 0.3s ease;
        }

        .content {
            padding: 20px;
            margin-top: 40px;
            margin-left: 17%;
            width: 50%;
        }

        .card {
            background-color: #ecf0f1;
            padding: 20px;
            text-align: center;
            margin: 10px;
            border-radius: 5px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }

        .card h5 {
            font-size: 1.2em;
            margin: 10px 0;
        }

        .card img {
            border-radius: 5px;
            height: 30vh;
        }

        .table-container {
            background-color: #bdc3c7;
            padding: 20px;
            border-radius: 5px;
        }

        .table th,
        .table td {
            vertical-align: middle;
        }

        .card-footer button {
            margin-top: 10px;
        }
        .btn-edit {
            background-color: #ffc107;
            border: none;
            color: white;
            padding: 8px 12px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .btn-edit:hover {
            background-color: #e0a800;
        }

        .btn-danger {
            padding: 8px 12px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .btn-danger:hover {
            background-color: #dc3545;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-info fixed-top">
        <div class="container-fluid">
            <img alt="logo" class="navbar-brand text-white-fa-2x" height="60"
                src="./image/mahasigma-reservation-high-resolution-logo.png">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <div class="ms-auto d-flex align-items-center">
                    <div class="icon">
                        <a href="logout.php" class="fas fa-sign-out-alt fa-1x me-4 text-black"></a>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <div class="row g-0 mt-5">
        <!-- Sidebar -->
        <div class="col-md-2 bg-info mt-2 pt-5">
            <ul class="nav flex-column ms-3 mb-5">
                <li class="nav-item">
                    <a class="nav-link active text-white" href="dashboard.php"><i
                            class="fas fa-tachometer-alt me-2"></i>Dashboard</a>
                    <hr class="bg-secondary">
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="lapangan.php"><i class="fas fa-cube me-2"></i>Lapangan</a>
                    <hr class="bg-secondary">
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="pelanggan.php"><i class="fas fa-users me-2"></i>Pelanggan</a>
                    <hr class="bg-secondary">
                </li>
            </ul>
        </div>

        <!-- Content -->
        <div class="content flex-grow-1 col-md-10">
            <div class="d-flex justify-content-around">
                <h3 class="text-center">Daftar Lapangan</h3>
            </div>
            <div class="container mt-5">
                <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addModal">Tambah Data</button>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Id Lapangan</th>
                            <th>Nama Lapangan</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th>Gambar</th>
                            <th>Deskripsi</th>
                            <th>Fasilitas</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include 'koneksi.php';
                        $query = mysqli_query($koneksi, "SELECT * FROM lapangan");
                        while($data = mysqli_fetch_assoc($query)) { ?> 
                        <tr>
                            <td><?= $data['id_lapangan']; ?></td>
                            <td><?= $data['nama_lapangan']; ?></td>
                            <td><?= $data['kategori']; ?></td>
                            <td><?= $data['harga']; ?></td>
                            <td><img src="uploads/<?= $data['gambar']; ?>" alt="gambar" width="100"></td>
                            <td><?= $data['deskripsi']; ?></td>
                            <td><?= $data['fasilitas']; ?></td>
                            <td>
                                <div class="d-flex">
                                    <button class="btn btn-warning btn-edit me-2" data-bs-toggle="modal" data-bs-target="#editModal"
                                        data-id_lapangan="<?= $data['id_lapangan']; ?>" 
                                        data-nama_lapangan="<?= $data['nama_lapangan']; ?>" 
                                        data-kategori="<?= $data['kategori']; ?>" 
                                        data-harga="<?= $data['harga']; ?>" 
                                        data-gambar="<?= $data['gambar']; ?>" 
                                        data-deskripsi="<?= $data['deskripsi']; ?>" 
                                        data-fasilitas="<?= $data['fasilitas']; ?>">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <a href="hapus_lapangan.php?id_lapangan=<?= $data['id_lapangan']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>  
                        <?php } ?>
                    </tbody>
                </table>
            </div>

            <!-- Modal Tambah Data -->
            <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <form action="tambah_lapangan.php" method="POST" enctype="multipart/form-data">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addModalLabel">Tambah Data</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="nama_lapangan" class="form-label">Nama Lapangan</label>
                                    <input type="text" class="form-control" id="nama_lapangan" name="nama_lapangan" required>
                                </div>
                                <div class="mb-3">
                                    <label for="kategori" class="form-label">Kategori</label>
                                    <select class="form-select" name="kategori" id="kategori" required>
                                        <option value="Indoor vinyl">Indoor Vinyl</option>
                                        <option value="Indoor sintetis">Indoor Sintetis</option>
                                        <option value="Indoor semen">Indoor Semen</option>
                                        <option value="outdoor">Outdoor</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                <label for="harga" class="form-label">Harga</label>
                                <input type="text" class="form-control" id="harga" name="harga" oninput="formatRupiah(this)" required>
                            </div>
                                <div class="mb-3">
                                    <label for="gambar" class="form-label">Gambar</label>
                                    <input type="file" class="form-control" id="gambar" name="gambar" required>
                                </div>
                                <div class="mb-3">
                                    <label for="deskripsi" class="form-label">Deskripsi</label>
                                    <textarea class="form-control" id="deskripsi" name="deskripsi" required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="fasilitas" class="form-label">Fasilitas</label>
                                    <textarea class="form-control" id="fasilitas" name="fasilitas" required></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Modal Edit Data -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="edit_lapangan.php" method="POST" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id_lapangan" id="editIdLapangan">
                        <input type="hidden" name="current_image" id="currentImage"> <!-- Hidden input for current image -->
                        <div class="mb-3">
                            <label for="editNamaLapangan" class="form-label">Nama Lapangan</label>
                            <input type="text" class="form-control" id="editNamaLapangan" name="nama_lapangan" required>
                        </div>
                        <div class="mb-3">
                            <label for="editKategori" class="form-label">Kategori</label>
                            <select class="form-select" name="kategori" id="editKategori" required>
                                <option value="Indoor vinyl">Indoor Vinyl</option>
                                <option value="Indoor sintetis">Indoor Sintetis</option>
                                <option value="Indoor semen">Indoor Semen</option>
                                <option value="outdoor">Outdoor</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="editHarga" class="form-label">Harga</label>
                            <input type="text" class="form-control" id="editHarga" name="harga" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Gambar saat ini</label><br>
                            <img src="" id="editFotoPreview" width="150" alt="gambar" class="mb-3 border rounded"><br>
                            <label for="editgambar" class="form-label">Ganti gambar (jika ingin mengganti)</label>
                            <input type="file" class="form-control" id="editgambar" name="gambar">
                        </div>
                        <div class="mb-3">
                            <label for="editDeskripsi" class="form-label">Deskripsi</label>
                            <textarea class="form-control" id="editDeskripsi" name="deskripsi" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="editFasilitas" class="form-label">Fasilitas</label>
                            <textarea class="form-control" id="editFasilitas" name="fasilitas" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </div>
            </form>
       </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
// Populate Edit Modal
document.querySelectorAll('.btn-edit').forEach(button => {
    button.addEventListener('click', function () {
        const modal = document.getElementById('editModal');
        modal.querySelector('#editIdLapangan').value = this.getAttribute('data-id_lapangan');
        modal.querySelector('#editNamaLapangan').value = this.getAttribute('data-nama_lapangan');
        modal.querySelector('#editKategori').value = this.getAttribute('data-kategori');
        modal.querySelector('#editHarga').value = this.getAttribute('data-harga');
        modal.querySelector('#editDeskripsi').value = this.getAttribute('data-deskripsi');
        modal.querySelector('#editFasilitas').value = this.getAttribute('data-fasilitas');
        
        const previewImage = modal.querySelector('#editFotoPreview');
        previewImage.src = 'uploads/' + this.getAttribute('data-gambar');
        previewImage.style.display = 'block';
        
        // Set current image in hidden input
        modal.querySelector('#currentImage').value = this.getAttribute('data-gambar');
    });
});
        // Reset Edit Modal on Close
        document.getElementById('editModal').addEventListener('hidden.bs.modal', function () {
            const modal = this;
            modal.querySelector('form').reset();
            const previewImage = modal.querySelector('#editFotoPreview');
            previewImage.src = '';
            previewImage.style.display = 'none';
        });
    </script>
</body>

</html>
