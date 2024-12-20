<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Lowongan</title>

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
                            <h3>Data Lowongan</h3>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="data-lowongan">Data Lowongan</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Form Lowongan</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <section class="section">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">
                                Lowongan
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table" id="lowonganTable">
                                    <thead>
                                        <tr>
                                            <th>Judul Lowongan</th>
                                            <th>Kategori</th>
                                            <th>Tipe Pekerjaan</th>
                                            <th>Gaji</th>
                                            <th>Deskripsi</th>
                                            <th>Requirement</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($lowongans as $item)
                                        <tr>
                                            <td>{{ $item->judul }}</td>
                                            <td>{{ $item->kategori }}</td>
                                            <td>{{ $item->tipe }}</td>
                                            <td>Rp{{ $item->gaji }}</td>
                                            <td>{{ $item->deskripsi }}</td>
                                            <td>
                                                <ul>
                                                    @foreach(json_decode($item->requirement) as $requirement)
                                                        <li>{{ $requirement }}</li>
                                                    @endforeach
                                                </ul>
                                            </td>
                                            <td>
                                                <button class="btn btn-warning edit-btn" data-id="{{ $item->id }}">Edit</button>
                                                <button class="btn btn-danger delete-btn"
                                                    data-id="{{ $item->id }}">Hapus</button>
                                            </td>
                                        </tr>
                                        @endforeach
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
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Edit button handler
            $(document).on('click', '.edit-btn', function() {
                var id = $(this).data('id');
                console.log("Editing ID:", id); // Tambahkan ini untuk cek ID

                // Isi input hidden dengan ID yang benar
                $('#editId').val(id); 
                
                $.ajax({
                    url: '{{ route('lowongan.edit', ':id') }}'.replace(':id', id),
                    type: 'GET',
                    success: function(response) {
                        console.log(response);
                        var lowongan = response.data || response;
                        $('#editJudul').val(lowongan.judul);
                        $('#editKategori').val(lowongan.kategori);
                        $('#editTipe').val(lowongan.tipe);
                        $('#editGaji').val(lowongan.gaji);
                        $('#editDeskripsi').val(lowongan.deskripsi);

                        // Clear existing inputs and populate new ones
                        $('#editRequirementFields').empty();
                        const requirements = JSON.parse(lowongan.requirement) || [];
                        requirements.forEach(function(req, index) {
                            $('#editRequirementFields').append(`
                                <div class="input-group mt-2" data-requirement-id="${index}">
                                    <input type="text" class="form-control" name="requirement[]" value="${req}" placeholder="Masukkan requirement" required>
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-danger remove-existing-requirement">Hapus</button>
                                    </div>
                                </div>
                            `);
                        });
                        $('#editModal').modal('show');
                    },
                    error: function(xhr) {
                        console.log('Error:', xhr.responseText);
                    }
                });
            });

            $(document).on('click', '.delete-btn', function() {
                var id = $(this).data('id');
                if (confirm('Apakah Anda yakin ingin menghapus lowongan ini?')) {
                    $.ajax({
                        url: '{{ route('lowongan.delete', ':id') }}'.replace(':id', id),
                        type: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            console.log('Delete Success:', response); // Debugging
                            alert(response.message); // Tampilkan pesan
                            location.reload(); // Refresh halaman
                        },
                        error: function(xhr) {
                            console.error('Delete Error:', xhr.responseText); // Debugging
                            alert('Terjadi kesalahan saat menghapus data.');
                        }
                    });
                }
            });

            // Event handler for adding new requirement input fields
            $('#addEditRequirement').on('click', function() {
                $('#editRequirementFields').append(`
                    <div class="input-group mt-2">
                        <input type="text" class="form-control" name="requirement[]" placeholder="Masukkan requirement" required>
                        <div class="input-group-append">
                            <button type="button" class="btn btn-danger remove-requirement">Hapus</button>
                        </div>
                    </div>
                `);
            });

            // Event handler for removing a requirement field
            $(document).on('click', '.remove-requirement', function() {
                $(this).closest('.input-group').remove();
            });

            $(document).on('click', '.remove-existing-requirement', function() {
                $(this).closest('.input-group').remove();
            });

            $('#editForm').on('submit', function(event) {
                event.preventDefault();
                var formData = $(this).serializeArray(); // Use serializeArray to get an array format
                var id = $('#editId').val();
                
                // Create an object for sending as JSON
                var data = {};
                $(formData).each(function(index, obj){
                    if (obj.name === 'requirement[]') {
                        if (!data.requirement) {
                            data.requirement = [];
                        }
                        data.requirement.push(obj.value); // Add to requirement array
                    } else {
                        data[obj.name] = obj.value; // Add other fields
                    }
                });
                
                $.ajax({
                    url: '{{ route('lowongan.update', ':id') }}'.replace(':id', id),
                    type: 'PUT',
                    data: data, // Send the updated data object
                    success: function(response) {
                        alert(response.message); // Tampilkan pesan sukses
                        window.location.href = '{{ route('lowongan.data') }}';
                    },
                    error: function(xhr) {
                        console.log('Error:', xhr.responseText);
                    }
                });
            });

            $(document).on('click', '.btn-close, #closeModal', function () {
                $('#editModal').modal('hide');
            });
        });
    </script>

    <!-- Modal Edit -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Data Lowongan</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editForm">
                    <div class="modal-body">
                        <input type="hidden" id="editId" name="id">
                        <div class="form-group">
                            <label for="editJudul">Judul Lowongan</label>
                            <input type="text" class="form-control" id="editJudul" name="judul">
                        </div>
                        <div class="form-group">
                            <label for="editKategori">Kategori</label>
                            <input type="text" class="form-control" id="editKategori" name="kategori">
                        </div>
                        <div class="form-group">
                            <label for="editTipe">Tipe Pekerjaan</label>
                            <input type="text" class="form-control" id="editTipe" name="tipe">
                        </div>
                        <div class="form-group">
                            <label for="editGaji">Gaji</label>
                            <input type="text" class="form-control" id="editGaji" name="gaji">
                        </div>
                        <div class="form-group">
                            <label for="editDeskripsi">Deskripsi</label>
                            <textarea class="form-control" id="editDeskripsi" name="deskripsi"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="editRequirement">Requirement</label>
                            <div id="editRequirementFields">
                                <!-- Dynamic input fields with remove buttons will be appended here -->
                                <div class="input-group mt-2">
                                    <input type="text" class="form-control" name="requirement[]" placeholder="Masukkan requirement" required>
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-danger remove-requirement">Hapus</button>
                                    </div>
                                </div>
                            </div>
                            <button type="button" id="addEditRequirement" class="btn btn-secondary mt-2">Tambah Requirement</button>
                            <small class="form-text text-muted">Contoh isi: "Pengalaman minimal 2 tahun di bidang pengembangan perangkat lunak"</small>
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
