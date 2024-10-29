<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Input Lowongan</title>

    <link rel="stylesheet" href="./assets/compiled/css/app.css">
    <link rel="stylesheet" href="./assets/compiled/css/app-dark.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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
                            <h3>Input Lowongan</h3>
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

                <section id="multiple-column-form">
                    <div class="row match-height">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Input Data Lowongan</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form class="form" id="lowongan_Form" action="{{ route('lowongan.store') }}" method="post">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-12 col-12">
                                                    <div class="form-group">
                                                        <label for="judul_lowongan">Judul Lowongan</label>
                                                        <input type="text" id="judul_lowongan" class="form-control"
                                                            placeholder="Judul Lowongan" name="judul">
                                                    </div>
                                                </div>

                                                <div class="col-md-12 col-12">
                                                    <div class="form-group">
                                                        <label for="perusahaan">Nama Perusahaan</label>
                                                        <input type="text" id="perusahaan" class="form-control"
                                                            name="perusahaan" placeholder="Nama Perusahaan">
                                                    </div>
                                                </div>

                                                <div class="col-md-12 col-12">
                                                    <div class="form-group">
                                                        <label for="kategori">Kategori</label>
                                                        <input type="text" id="kategori" class="form-control"
                                                            name="kategori" placeholder="Nama Kategori">
                                                    </div>
                                                </div>

                                                <div class="col-md-12 col-12">
                                                    <div class="form-group">
                                                        <label for="jenis_pekerjaan">Jenis Pekerjaan</label>
                                                        <fieldset class="form-group">
                                                            <select class="form-select" id="jenis_pekerjaan" name="tipe">
                                                                <option>Penuh Waktu</option>
                                                                <option>Paruh Waktu</option>
                                                                <option>Kontrak</option>
                                                                <option>Magang</option>
                                                            </select>
                                                        </fieldset>
                                                    </div>
                                                </div>

                                                <div class="col-md-12 col-12">
                                                    <div class="form-group">
                                                        <label for="lokasi">Lokasi Pekerjaan</label>
                                                        <input type="text" id="lokasi" class="form-control"
                                                            name="lokasi" placeholder="Lokasi Pekerjaan">
                                                    </div>
                                                </div>

                                                <div class="col-md-12 col-12">
                                                    <div class="form-group">
                                                        <label for="gaji">Gaji (Opsional)</label>
                                                        <input type="number" id="gaji" class="form-control"
                                                            name="gaji" placeholder="Gaji">
                                                    </div>
                                                </div>

                                                <div class="col-md-12 col-12">
                                                    <div class="form-group">
                                                        <label for="deskripsi">Deskripsi Lowongan</label>
                                                        <textarea id="deskripsi" class="form-control" name="deskripsi" placeholder="Deskripsi Lowongan" rows="3"></textarea>
                                                    </div>
                                                </div>

                                                <div class="col-md-12 col-12">
                                                    <div class="form-group">
                                                        <label for="requirement">Requirement</label>
                                                        <div id="requirementFields">
                                                            <input type="text" class="form-control" name="requirement[]" placeholder="Masukkan requirement" required>
                                                        </div>
                                                        <button type="button" id="addRequirement" class="btn btn-secondary mt-2">Tambah Requirement</button>
                                                        <small class="form-text text-muted">Contoh isi: "Pengalaman minimal 2 tahun di bidang pengembangan perangkat lunak"</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 d-flex justify-content-end">
                                                <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                                <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                            </div>
                                        </form>
                                        <div id="messages"></div>
                                    </div>
                                </div>
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
            // CSRF token setup for AJAX
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Form submit handler for adding new data
            $('#lowongan_Form').on('submit', function(event) {
                event.preventDefault();

                var formData = $(this).serialize();
                console.log(formData);

                $.ajax({
                    url: '{{ route("lowongan.store") }}',
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        $('#messages').html('<div class="alert alert-success">Data berhasil disimpan!</div>');
                        $('#lowongan_Form')[0].reset();
                        $('#requirementFields').empty().append('<input type="text" class="form-control" name="requirement[]" placeholder="Masukkan requirement" required>');
                        // Call a function to reload data if necessary
                        // loadDataFromDatabase();
                    },
                    error: function(xhr) {
                        var errors = xhr.responseJSON.errors;
                        var errorMsg = '<ul>';
                        $.each(errors, function(key, value) {
                            errorMsg += '<li>' + value + '</li>';
                        });
                        errorMsg += '</ul>';
                        $('#messages').html('<div class="alert alert-danger">' + errorMsg + '</div>');
                    }
                });
            });

            // Handle adding new requirement input
            $('#addRequirement').on('click', function() {
                $('#requirementFields').append('<input type="text" class="form-control mt-2" name="requirement[]" placeholder="Masukkan requirement" required>');
            });
        });
    </script>
</body>

</html>
