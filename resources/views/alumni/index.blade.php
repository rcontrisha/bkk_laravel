<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>input data</title>

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
                            <h3>Input Data Alumni </h3>
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

                <section id="multiple-column-form">
                    <div class="row match-height">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Input Data Alumni</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form class="form" id="alumni_Form" action="{{ route('index.store') }}" method="post">
                                            {{-- @csrf --}}
                                            <div class="row">
                                                <div class="col-md-12 col-12">
                                                    <div class="form-group">
                                                        <label for="first-name-column">NISN</label>
                                                        <input type="number" id="nisn" class="form-control"
                                                            placeholder="NISN" name="nisn">
                                                    </div>
                                                </div>

                                                <div class="col-md-12 col-12">
                                                    <div class="form-group">
                                                        <label for="company-column">Nama Siswa</label>
                                                        <input type="text" id="nama_siswa" class="form-control"
                                                            name="nama_siswa" placeholder="Nama Siswa">
                                                    </div>
                                                </div>
                                                <div class="col-md-12 mb-12">
                                                    <h6>Jenis Kelamin</h6>
                                                    <fieldset class="form-group">
                                                        <select class="form-select" id="jenis_kelamin"
                                                            name="jenis_kelamin">
                                                            <option>Laki - laki</option>
                                                            <option>Perempuan</option>
                                                        </select>
                                                    </fieldset>
                                                </div>
                                                <div class="col-md-12 col-12">
                                                    <div class="form-group">
                                                        <label for="company-column">Jurusan</label>
                                                        <fieldset class="form-group">
                                                            <select class="form-select" id="jurusan" name="jurusan">
                                                                <option>Akuntansi dan Keuangan Lembaga</option>
                                                                <option>Bisnis Daring dan Pemasaran</option>
                                                                <option>Multimedia</option>
                                                                <option>Otomatisasi dan Tata Kelola Perkantoran</option>
                                                            </select>
                                                        </fieldset>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 col-12">
                                                    <div class="form-group">
                                                        <label for="company-column">Tahun Kelulusan</label>
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
                                                </div>
                                                <div class="col-md-12 col-12">
                                                    <div class="form-group">
                                                        <label for="company-column">Sasaran</label>
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
                                                </div>
                                                <div class="col-md-12 col-12">
                                                    <div class="form-group">
                                                        <label for="company-column">Tempat Sasaran</label>
                                                        <input type="text" id="tempat_sasaran" class="form-control"
                                                            name="tempat_sasaran" placeholder="Tempat Sasaran">
                                                    </div>
                                                </div>
                                                <div class="col-md-12 col-12">
                                                    <div class="form-group">
                                                        <label for="company-column">Nomor Telepon</label>
                                                        <input type="number" id="nomor_telepon" class="form-control"
                                                            name="nomor_telepon" placeholder="Nomor Telepon  ">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="company-column">Email</label>
                                                    <input type="text" id="email" class="form-control"
                                                        name="email" placeholder="Email">
                                                </div>
                                            </div>
                                            <div class="col-12 d-flex justify-content-end">
                                                <button type="submit"
                                                    class="btn btn-primary me-1 mb-1">Submit</button>
                                                <button type="reset"
                                                    class="btn btn-light-secondary me-1 mb-1">Reset</button>
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
            $('#alumni_Form').on('submit', function(event) {
                event.preventDefault();

                var formData = $(this).serialize();
                var id = $('#id').val();

                $.ajax({
                    url: '{{ route("index.store") }}', // Adjust URL for update as needed
                    type: 'POST', // Use 'PUT' for update if needed
                    data: formData,
                    success: function(response) {
                        $('#messages').html('<div class="alert alert-success">Data berhasil disimpan!</div>');
                        $('#alumni_Form')[0].reset();
                        $('#id').val('');
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
        });
    </script>
</body>

</html>
