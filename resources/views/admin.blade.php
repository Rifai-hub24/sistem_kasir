<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard Dinamis</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <style>
        /* Styling Sidebar */
        .sidebar {
            min-width: 250px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #ff8400;
            color: rgb(0, 0, 0);
            padding: 30px 20px;
            overflow-y: auto;
        }

        .sidebar .logo {
            text-align: center;
            margin-bottom: 30px;
            font-size: 24px;
            font-weight: bold;
            color: #ffffff;
        }

        .sidebar a {
            color: #000000;
            display: block;
            padding: 12px;
            margin-bottom: 10px;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }

        .sidebar a:hover {
            background-color: #fffb2d;
            text-decoration: none;
        }

        .sidebar .active {
            background-color: #fffb2d;
        }

        /* Styling Main Content */
        .main-content {
            margin-left: 250px;
            padding: 30px;
            background: #fce45e;
            min-height: 100vh;
        }

        /* Header */
        .navbar {
            background-color: #343a40;
            color: white;
            padding: 15px;
        }

        .navbar .navbar-brand {
            color: white;
        }

        /* Header with Search */
        .header-top {
           display: flex;
           justify-content: space-between;
           align-items: center;
           background-color: #ff8400;
           color: white;
           padding: 20px 40px; /* Menambah padding untuk memperpanjang dan mempertinggi */
           height: 60px; /* Menentukan tinggi kotak header */
           margin-top: -20px; /* Memindahkan posisi lebih ke atas */
        }



        .header-top .dashboard-title {
           font-size: 24px;
           font-weight: bold;
        }

        .header-top .search-bar {
           width: 200px; /* Memperbesar lebar kotak pencarian */
        }

        .header-top .search-bar input {
          padding: 10px; /* Menambahkan padding agar lebih besar */
          font-size: 16px;
          border-radius: 4px;
          border: 1px solid #ddd;
          width: 100%;
        }


        /* Card Section */
        .card {
            border: none;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        /* Table Styling */
        table {
            margin-top: 20px;
        }

        /* Responsiveness */
        @media (max-width: 768px) {
            .sidebar {
                min-width: 200px;
            }

            .main-content {
                margin-left: 200px;
            }

            .header-top .search-bar {
                width: 150px;
            }
            /* CSS untuk tampilan laporan */
#laporan {
    margin-bottom: 2rem;
}

.card {
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
}

.table {
    margin-top: 1.5rem;
}

/* CSS untuk print */
@media print {
    body * {
        visibility: hidden;
    }
    #laporan, #laporan * {
        visibility: visible;
    }
    #laporan {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
    }
    .card, .card-body {
        border: none;
        box-shadow: none;
    }
    .btn, .form-control, .form-group {
        display: none;
    }
    table {
        width: 100%;
        border-collapse: collapse;
    }
    table, th, td {
        border: 1px solid black;
    }
    th, td {
        padding: 8px;
        text-align: left;
    }
}
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="logo">Dashboard Admin</div>
        <ul class="list-unstyled">
            <li><a href="#barang"><i class="fas fa-cogs"></i> Barang</a></li>
            <li><a href="#pelanggan"><i class="fas fa-users"></i> Pelanggan</a></li>
            <li><a href="#User"><i class="fas fa-user-cog"></i> User</a></li>
            <li><a href="#laporan"><i class="fas fa-chart-line"></i> Laporan</a></li>
            <li><a href="{{ route('from') }}"><i class="fas fa-cash-register"></i>Kasir</a></li>
            <li><a href="#login" class="logout-btn"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
            
        </ul>
        
    </div>

    <!-- Main Content -->
    <div class="main-content">

        <!-- Header with Dashboard Title and Search -->
        <div class="header-top">
            <div class="dashboard-title">Dashboard</div>
            <div class="search-bar">
                <input type="text" id="searchInput" placeholder="Search by ID" onkeyup="searchTable()">
            </div>
        </div>

        <!-- Section Barang -->
        <div id="barang" class="mb-5">
            <h3 class="text-center my-4">Barang</h3>
            <hr>
            <div class="card shadow-sm rounded">
                <div class="card-body">
                    <a href="{{ route('admin.createBarang') }}" class="btn btn-md btn-success mb-3">TAMBAH DATA</a>
                    <table class="table table-bordered" id="barang-table">
                        <thead>
                            <tr>
                                <th>ID Barang</th>
                                <th>Nama Barang</th>
                                <th>Harga Barang</th>
                                <th>Stock</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Loop Barang -->
                            @foreach ($barangs as $barang)
                            <tr>
                                <td>{{ $barang->id_barang }}</td>
                                <td>{{ $barang->nama_barang }}</td>
                                <td>{{ $barang->harga_barang }}</td>
                                <td>{{ $barang->stock }}</td>
                                <td>
                                    <a href="{{ route('admin.editbarang', $barang->id_barang) }}" class="btn btn-primary btn-sm">Edit</a>
                                    <form action="{{ route('admin.delete_barang', $barang->id_barang) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus item ini?')"style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm" onclick="">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            @if($barangs->isEmpty())
                            <tr>
                                <td colspan="5" class="text-center">Data Barang Belum Tersedia.</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        <!-- Section Pelanggan -->
        <div id="pelanggan" class="mb-5">
            <h3 class="text-center my-4">Pelanggan</h3>
            <hr>
            <div class="card shadow-sm rounded">
                <div class="card-body">
                    <a href="{{ route('admin.createpelanggan') }}" class="btn btn-md btn-success mb-3">TAMBAH DATA</a>
                    <table class="table table-bordered" id="pelanggan-table">
                        <thead>
                            <tr>
                                <th>ID Pelanggan</th>
                                <th>Nama</th>
                                <th>Gender</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Loop Pelanggan -->
                            @foreach ($pelanggans as $pelanggan)
                            <tr>
                                <td>{{ $pelanggan->id_pelanggan }}</td>
                                <td>{{ $pelanggan->nama }}</td>
                                <td>{{ $pelanggan->gender }}</td>
                                <td>
                                    <a href="{{ route('admin.editpelanggan', $pelanggan->id_pelanggan) }}" class="btn btn-primary btn-sm">Edit</a>
                                    <form action="{{ route('admin.delete_pelanggan', $pelanggan->id_pelanggan) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pelanggan ini?')"style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm" onclick="">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            @if($pelanggans->isEmpty())
                            <tr>
                                <td colspan="4" class="text-center">Data Pelanggan Belum Tersedia.</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


         <!-- User -->
         <div id="User" class="mb-5">
            <h3 class="text-center my-4">User</h3>
            <hr>
            <div class="card shadow-sm rounded">
                <div class="card-body">
                    <a href="{{ route('admin.add_user') }}" class="btn btn-md btn-success mb-3">TAMBAH USER</a>
                    <table class="table table-bordered" id="detail-penjualan-table">
                        <thead>
                            <tr>
                                <th>ID USER</th>
                                <th>USERNAME</th>
                                <th>ROLE</th>
                                <th>AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- USER -->
                            @foreach ($Users as $User)
                            <tr>
                                <td>{{ $User->id_user }}</td>
                                <td>{{ $User->username }}</td>
                                <td>{{ $User->role}}</td>
                                <td>
                                    <a href="{{ route('admin.edit_user', $User->id_user) }}" class="btn btn-primary btn-sm">Edit</a>
                                    <form action="{{ route('admin.delete_user', $User->id_user) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini?')"style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm" onclick="">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            @if($Users->isEmpty())
                            <tr>
                                <td colspan="6" class="text-center">Data Detail Penjualan Belum Tersedia.</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

      
        <div id="laporan" class="mb-5">
            <h3 class="text-center my-4">Laporan</h3>
            <hr>
            <div class="card shadow-sm rounded">
                <div class="card-body">
                    <form action="" method="get">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="tanggal_awal">Tanggal Awal</label>
                                <input type="date" id="tanggal_awal" name="tanggal_awal" class="form-control" value="{{ request()->input('tanggal_awal') }}">
                            </div>
                            <div class="col-md-4">
                                <label for="tanggal_akhir">Tanggal Akhir</label>
                                <input type="date" id="tanggal_akhir" name="tanggal_akhir" class="form-control" value="{{ request()->input('tanggal_akhir') }}">
                            </div>
                            <div class="col-md-4 mt-4">
                                <button type="submit" class="btn btn-primary w-100 mb-2">Tampilkan Laporan</button>
                                <a href="{{ url()->current() }}" class="btn btn-success w-100 mb-2">Tampilkan Semua</a>
                                <button type="button" class="btn btn-warning w-100" onclick="printLaporan()">Print Laporan</button>
                            </div>
                        </div>
                    </form>
                    <table class="table table-bordered mt-4" id="inner-table">
                        <thead>
                            <tr>
                                <th>ID TRANSAKSI</th>
                                <th>NAMA BARANG</th>
                                <th>JUMLAH BARANG</th>
                                <th>HARGA SATUAN</th>
                                <th>TANGGAL TRANSAKSI</th>
                                <th>TOTAL TRANSAKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $tanggal_awal = request()->input('tanggal_awal');
                                $tanggal_akhir = request()->input('tanggal_akhir');
            
                                if ($tanggal_awal && $tanggal_akhir) {
                                    $penjualans = App\Models\Penjualan::whereBetween('tgl_transaksi', [$tanggal_awal, $tanggal_akhir])
                                        ->with('detilPenjualan.barang')
                                        ->get();
                                } else {
                                    $penjualans = App\Models\Penjualan::with('detilPenjualan.barang')
                                        ->get();
                                }
                            @endphp
                            @foreach ($penjualans as $penjualan)
                                @foreach ($penjualan->detilPenjualan as $detil)
                                    <tr>
                                        <td>{{ $penjualan->id_transaksi }}</td>
                                        <td>{{ $detil->barang->nama_barang }}</td>
                                        <td>{{ $detil->jml_barang }}</td>
                                        <td>{{ $detil->harga_satuan }}</td>
                                        <td>{{ $penjualan->tgl_transaksi }}</td>
                                        <td>{{ $penjualan->total_transaksi }}</td>
                                    </tr>
                                @endforeach
                            @endforeach
                            @if($penjualans->isEmpty())
                            <tr>
                                <td colspan="6" class="text-center">Data Tidak Tersedia.</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        // Menangani klik pada tautan sidebar
document.querySelectorAll('.sidebar a').forEach(link => {
    link.addEventListener('click', function (e) {
        const href = this.getAttribute('href');

        // Jika href adalah anchor link (mengandung #)
        if (href.startsWith('#')) {
            e.preventDefault();

            // Menghapus kelas aktif dari semua tautan
            document.querySelectorAll('.sidebar a').forEach(item => {
                item.classList.remove('active');
            });

            // Menambahkan kelas aktif pada tautan yang diklik
            this.classList.add('active');

            // Scroll ke bagian yang sesuai
            const targetId = href.substring(1); // Menghapus #
            const targetElement = document.getElementById(targetId);
            if (targetElement) {
                targetElement.scrollIntoView({ behavior: 'smooth' });
            }
        } else {
            // Untuk tautan non-anchor, biarkan navigasi default berjalan
            this.classList.add('active');
        }
    });
});

        // Menambahkan logika untuk scroll dan mengubah warna berdasarkan posisi scroll
        window.addEventListener('scroll', function () {
            const sections = document.querySelectorAll('.main-content > div');
            let currentSection = null;

            sections.forEach(section => {
                const sectionTop = section.offsetTop - 50;  // Sesuaikan dengan posisi scroll
                const sectionBottom = sectionTop + section.offsetHeight;
                if (window.scrollY >= sectionTop && window.scrollY < sectionBottom) {
                    currentSection = section;
                }
            });

            if (currentSection) {
                const targetLink = document.querySelector(`.sidebar a[href="#${currentSection.id}"]`);
                document.querySelectorAll('.sidebar a').forEach(link => {
                    link.classList.remove('active');
                });
                if (targetLink) {
                    targetLink.classList.add('active');
                }
            }
        });

        // Pencarian pada tabel berdasarkan primary key (ID)
        function searchTable() {
            const input = document.getElementById("searchInput");
            const filter = input.value.toUpperCase();
            const tables = document.querySelectorAll("table");
            
            tables.forEach(table => {
                const rows = table.querySelectorAll("tbody tr");
                rows.forEach(row => {
                    const cells = row.querySelectorAll("td");
                    const idCell = cells[0]; // Asumsikan ID berada di kolom pertama
                    if (idCell && idCell.textContent.toUpperCase().includes(filter)) {
                        row.style.display = "";
                    } else {
                        row.style.display = "none";
                    }
                });
            });
        }
        document.querySelector('.logout-btn').addEventListener('click', function (e) {
        e.preventDefault();
        window.location.href = '/'; // Sesuaikan dengan URL halaman login Anda
     });

     function printLaporan() {
        window.print();
    }

    </script>
    
</body>
</html>
