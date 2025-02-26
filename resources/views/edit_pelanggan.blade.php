<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pelanggan</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body style="background: #fce45e">

    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <!-- Form untuk Mengupdate Pelanggan -->
                        <form action="{{ route('admin.updatepelanggan', $pelanggan->id_pelanggan) }}" method="POST">
                            @csrf
                            @method('PUT') <!-- Menambahkan metode PUT untuk update -->

                            <div class="form-group">
                                <label class="font-weight-bold">Nama Pelanggan</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ old('nama', $pelanggan->nama) }}">

                                @error('nama')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Gender</label>
                                <select class="form-control @error('gender') is-invalid @enderror" name="gender">
                                    <option value="">Pilih Gender</option>
                                    <option value="Laki-laki" {{ old('gender', $pelanggan->gender) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="Perempuan" {{ old('gender', $pelanggan->gender) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                </select>

                                @error('gender')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-md btn-primary">Update</button>
                            <a href="{{ route('admin') }}" class="btn btn-md btn-secondary">Kembali</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
