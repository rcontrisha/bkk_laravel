<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Alumni</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Data Alumni</title>
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
                            {{-- <p class="text-subtitle text-muted">Multiple form layouts, you can use.</p> --}}
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
                                Alumni
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
                                        <!-- Data akan dimuat di sini -->
                                    </tbody>
                                </table>
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
        $(document).ready(function() {

            loadDataFromDatabase();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Opsi default
            var kompetensiDefault = [
                'Akuntansi dan Keuangan Lembaga',
                'Bisnis Daring dan Pemasaran',
                'Multimedia',
                'Otomatisasi dan Tata Kelola Perkantoran'
            ];

            // Opsi khusus untuk Tahun Kelulusan 2024
            var kompetensi2024 = [
                'Akuntansi dan Keuangan Lembaga',
                'Manajemen Perkantoran',
                'Broadcasting dan Perfilman',
                'Bisnis Retail'
            ];

            // Event listener untuk perubahan pada dropdown Tahun Kelulusan
            $('#tahun_kelulusan').on('change', function() {
                var selectedYear = $(this).val();
                var kompetensiDropdown = $('#kompetensi');

                // Hapus semua opsi di dropdown Kompetensi
                kompetensiDropdown.empty();

                // Jika Tahun Kelulusan adalah 2024, gunakan opsi khusus 2024
                if (selectedYear === '2024') {
                    kompetensi2024.forEach(function(item) {
                        kompetensiDropdown.append(new Option(item, item));
                    });
                } else {
                    // Jika tahun selain 2024, gunakan opsi default
                    kompetensiDefault.forEach(function(item) {
                        kompetensiDropdown.append(new Option(item, item));
                    });
                }
            });

            function loadDataFromDatabase() {
                // Kosongkan tabel terlebih dahulu
                $('#alumniTable tbody').empty();

                $.ajax({
                    url: '{{ route('alumni.data') }}',
                    type: 'GET',
                    success: function(response) {
                        $.each(response.data, function(key, item) {
                            var rows = '<tr>';
                            rows += '<td>' + item.nisn + '</td>';
                            rows += '<td>' + item.nama_siswa + '</td>';
                            rows += '<td>' + item.jenis_kelamin + '</td>';
                            rows += '<td>' + item.jurusan + '</td>';
                            rows += '<td>' + item.tahun_kelulusan + '</td>';
                            rows += '<td>' + item.sasaran + '</td>';
                            rows += '<td>' + item.tempat_sasaran + '</td>';
                            rows += '<td>' + item.nomor_telepon + '</td>';
                            rows += '<td>' + item.email + '</td>';
                            rows += '<td><button class="btn btn-warning edit-btn" data-id="' + item.id + '">Edit</button>';
                            rows += '<button class="btn btn-danger delete-btn" data-id="' + item.id + '">Hapus</button></td>';
                            rows += '</tr>';
                            $('#alumniTable tbody').append(rows);
                        });

                    },
                    error: function(xhr) {
                        console.log('Error:', xhr.responseText);
                    }
                });
            }

            //edit button
            $(document).on('click', '.edit-btn', function() {
                var id = $(this).data('id');
                console.log("Editing ID:", id); // Tambahkan ini untuk cek ID

                // Isi input hidden dengan ID yang benar
                $('#editId').val(id); 
                $.ajax({
                    url: '{{ route('alumni.edit', '') }}/' + id,
                    type: 'GET',
                    success: function(response) {
                        var alumni = response.data;
                        $('#editNISN').val(alumni.nisn);
                        $('#editNAMA').val(alumni.nama_siswa);
                        $('#editjenis_Kelamin').val(alumni.jenis_kelamin);
                        $('#editJurusan').val(alumni.jurusan);
                        $('#editTahun').val(alumni.tahun_kelulusan);
                        $('#editSasaran').val(alumni.sasaran);
                        $('#editTempat').val(alumni.tempat_sasaran);
                        $('#editNomor').val(alumni.nomor_telepon);
                        $('#editEmail').val(alumni.email);
                        // Isi input lainnya sesuai kebutuhan
                        $('#editModal').modal('show');
                    },
                    error: function(xhr) {
                        console.log('Error:', xhr.responseText);
                    }
                });
            });

            $('#editForm').on('submit', function(event) {
                event.preventDefault();
                var formData = $(this).serialize();
                // Ambil ID alumni dari form atau sesuaikan dengan kebutuhan Anda
                var id = $('#editId').val();
                console.log(id)
                // Kirim data alumni yang telah diedit ke server dengan AJAX
                $.ajax({
                    url: '{{ route('alumni.update', '') }}/' + id,
                    type: 'PUT',
                    data: formData,
                    success: function(response) {
                        // Tutup modal edit
                        $('#editModal').modal('hide');
                        // Muat ulang data di tabel
                        loadDataFromDatabase();
                    },
                    error: function(xhr) {
                        console.log('Error:', xhr.responseText);
                        // Tampilkan pesan error
                    }
                });
            });


            // Delete button handler
            $(document).on('click', '.delete-btn', function() {
                var id = $(this).data('id');
                if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                    $.ajax({
                        url: '{{ route('alumni.destroy', '') }}/' + id,
                        type: 'DELETE',
                        success: function(response) {
                            $('#messages').html('<div class="alert alert-success">Data berhasil disimpan!</div>');
                            $('#alumniTable')[0].reset();
                            loadDataFromDatabase();
                        },
                        error: function(xhr) {
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
                        <!-- Isi Form Edit Di sini -->
                        <input type="hidden" id="editId" name="id">
                        <div class="form-group">
                            <label for="editNISN">NISN</label>
                            <input type="number" class="form-control" id="editNISN" name="nisn">
                        </div>
                        <div class="form-group">
                            <label for="editNISN">Nama</label>
                            <input type="text" class="form-control" id="editNAMA" name="editNAMA">
                        </div>
                        <div class="form-group">
                            <label for="editNISN">jenis_kelamin</label>
                            <fieldset class="form-group">
                                <select class="form-select" id="jenis_kelamin"
                                    name="jenis_kelamin">
                                    <option>Laki-laki</option>
                                    <option>Perempuan</option>
                                </select>
                            </fieldset>
                        </div>
                        <div class="form-group">
                            <label for="kompetensi">Kompetensi</label>
                            <select class="form-select" id="kompetensi" name="jurusan">
                                <!-- Opsi default akan diisi di skrip JavaScript -->
                                <option>Akuntansi dan Keuangan Lembaga</option>
                                <option>Bisnis Daring dan Pemasaran</option>
                                <option>Multimedia</option>
                                <option>Otomatisasi dan Tata Kelola Perkantoran</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="editNISN">Tahun Kelulusan</label>
                            <fieldset class="form-group">
                                <select class="form-select" id="tahun_kelulusan"
                                    name="tahun_kelulusan">
                                    <option>2021</option>
                                    <option>2022</option>
                                    <option>2023</option>
                                    <option>2024</option>
                                    <option>2025</option>
                                    <option>2026</option>
                                </select>
                            </fieldset>
                        </div>
                        <div class="form-group">
                            <label for="editNISN">Sasaran</label>
                            <fieldset class="form-group">
                                <select class="form-select" id="sasaran" name="sasaran">
                                    <option>Belum Terdata</option>
                                    <option>Belum Kerja</option>
                                    <option>Bekerja</option>
                                    <option>Kuliah</option>
                                    <option>Wirausaha</option>
                                </select>
                            </fieldset>
                        </div>
                        <div class="form-group">
                            <label for="editTempat">Tempat</label>
                            <input type="text" class="form-control" id="editTempat" name="tempat_sasaran">
                        </div>
                        <div class="form-group">
                            <label for="editNomor">Nomor Telepon</label>
                            <input type="text" class="form-control" id="editNomor" name="nomor_telepon">
                        </div>
                        <div class="form-group">
                            <label for="editEmail">Email</label>
                            <input type="text" class="form-control" id="editEmail" name="email">
                        </div>
                        

                        <!-- Tambahkan input lainnya sesuai kebutuhan -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
