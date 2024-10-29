<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Alumni</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="./assets/compiled/css/app.css">
    <link rel="stylesheet" href="./assets/compiled/css/app-dark.css">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
</head>

<body>
    @include('partials.sidebar')
    <script src="assets/static/js/initTheme.js"></script>
    <div id="app">
        @include('partials.topbar')
        <div id="main">
            <div class="page-heading">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3>Data Alumni</h3>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="data-alumni">Data Alumni</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Form Alumni</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <section class="section">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">
                                Alumni Tahun {{ $tahun }}
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table" id="alumniTable">
                                    <thead>
                                        <tr>
                                            <th>NISN</th>
                                            <th>Nama Siswa</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Jurusan</th>
                                            <th>Tahun Kelulusan</th>
                                            <th>Sasaran</th>
                                            <th>Tempat Sasaran</th>
                                            <th>Nomor Telepon</th>
                                            <th>Email</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($alumni as $item)
                                        <tr>
                                            <td>{{ $item->nisn }}</td>
                                            <td>{{ $item->nama_siswa }}</td>
                                            <td>{{ $item->jenis_kelamin }}</td>
                                            <td>{{ $item->jurusan }}</td>
                                            <td>{{ $item->tahun_kelulusan }}</td>
                                            <td>{{ $item->sasaran }}</td>
                                            <td>{{ $item->tempat_sasaran }}</td>
                                            <td>{{ $item->nomor_telepon }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td>
                                                <button class="btn btn-warning edit-btn"
                                                    data-id="{{ $item->id }}">Edit</button>
                                                <button class="btn btn-danger delete-btn"
                                                    data-id="{{ $item->id }}">Hapus</button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                @if($alumni->isEmpty())
                                <p class="text-muted">Tidak ada data alumni untuk tahun ini.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        @include('partials.footer')
    </div>

    <script src="assets/static/js/components/dark.js"></script>
    <script src="assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/compiled/js/app.js"></script>

    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Edit button handler
            $(document).on('click', '.edit-btn', function () {
                var id = $(this).data('id');
                $.ajax({
                    url: '{{ route('alumni.edit', ':id') }}'.replace(':id', id),
                    type: 'GET',
                    success: function (response) {
                        var alumni = response.data;
                        $('#editNISN').val(alumni.nisn);
                        $('#editNAMA').val(alumni.nama_siswa);
                        $('#editjenis_kelamin').val(alumni.jenis_kelamin);
                        $('#editJurusan').val(alumni.jurusan);
                        $('#editTahun').val(alumni.tahun_kelulusan);
                        $('#editSasaran').val(alumni.sasaran);
                        $('#editTempat').val(alumni.tempat_sasaran);
                        $('#editNomor').val(alumni.nomor_telepon);
                        $('#editEmail').val(alumni.email);
                        $('#editId').val(alumni.id);
                        $('#editModal').modal('show');
                    },
                    error: function (xhr) {
                        console.log('Error:', xhr.responseText);
                    }
                });
            });

            // Edit form submission
            $('#editForm').on('submit', function (event) {
                event.preventDefault(); // Mencegah pengiriman form secara default
                var formData = $(this).serialize();
                var id = $('#editId').val(); // Ambil ID alumni dari input

                // Ambil tahun dari URL
                var urlParams = new URLSearchParams(window.location.search);
                var tahun = urlParams.get('tahun'); // Dapatkan parameter tahun dari URL

                $.ajax({
                    url: '{{ route('alumni.update', ':id') }}'.replace(':id', id),
                    type: 'PUT',
                    data: formData,
                    success: function (response) {
                        alert(response.message); // Tampilkan pesan sukses
                        // Redirect ke halaman yang diinginkan dengan menambahkan parameter tahun
                        window.location.href = '{{ route('alumni.data.tahun', ['tahun' => '__tahun__']) }}'.replace('__tahun__', tahun);
                    },
                    error: function (xhr) {
                        console.log('Error:', xhr.responseText);
                        // Anda bisa menampilkan error message kepada pengguna
                    }
                });
            });

            $(document).on('click', '.btn-close, #closeModal', function () {
                $('#editModal').modal('hide');
            });

            // Delete button handler
            $(document).on('click', '.delete-btn', function () {
                var id = $(this).data('id');
                if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                    $.ajax({
                        url: '{{ route('alumni.destroy', ':id') }}'.replace(':id', id),
                        type: 'DELETE',
                        success: function (response) {
                            location.reload();
                        },
                        error: function (xhr) {
                            console.log('Error:', xhr.responseText);
                        }
                    });
                }
            });
        });

    </script>

    <!-- Modal Edit -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Data Alumni</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editForm">
                    <div class="modal-body">
                        <input type="hidden" id="editId" name="id">
                        <div class="form-group">
                            <label for="editNISN">NISN</label>
                            <input type="number" class="form-control" id="editNISN" name="nisn">
                        </div>
                        <div class="form-group">
                            <label for="editNAMA">Nama</label>
                            <input type="text" class="form-control" id="editNAMA" name="nama_siswa">
                        </div>
                        <div class="form-group">
                            <label for="editjenis_kelamin">Jenis Kelamin</label>
                            <select class="form-control" id="editjenis_kelamin" name="jenis_kelamin">
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="editJurusan">Jurusan</label>
                            <select class="form-control" id="editJurusan" name="jurusan">
                                <option>Akuntansi dan Keuangan Lembaga</option>
                                <option>Bisnis Daring dan Pemasaran</option>
                                <option>Multimedia</option>
                                <option>Otomatisasi dan Tata Kelola Perkantoran</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="editTahun">Tahun Kelulusan</label>
                            <select class="form-control" id="editTahun" name="tahun_kelulusan">
                                <option>2021</option>
                                <option>2022</option>
                                <option>2023</option>
                                <option>2024</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="editSasaran">Sasaran</label>
                            <select class="form-control" id="editSasaran" name="sasaran">
                                <option>Bekerja</option>
                                <option>Kuliah</option>
                                <option>Wirausaha</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="editTempat">Tempat Sasaran</label>
                            <input type="text" class="form-control" id="editTempat" name="tempat_sasaran">
                        </div>
                        <div class="form-group">
                            <label for="editNomor">Nomor Telepon</label>
                            <input type="text" class="form-control" id="editNomor" name="nomor_telepon">
                        </div>
                        <div class="form-group">
                            <label for="editEmail">Email</label>
                            <input type="email" class="form-control" id="editEmail" name="email">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" id="closeModal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>