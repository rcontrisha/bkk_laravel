<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Pendaftaran Lowongan</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="./assets/compiled/css/app.css">
    <link rel="stylesheet" href="./assets/compiled/css/app-dark.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
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
                            <h3>Data Pendaftaran Lowongan</h3>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="data-pendaftaran">Data Pendaftaran</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Form Pendaftaran</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <section class="section">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">
                                Pendaftaran Lowongan
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="pendaftaranTable">
                                    <thead>
                                        <tr>
                                            <th>Nama Pelamar</th>
                                            <th>E-Mail</th>
                                            <th>Judul Lowongan</th>
                                            <th>Perusahaan</th>
                                            <th>Tanggal Pendaftaran</th>
                                            <th>Status</th>
                                            <th>CV Pelamar</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($pendaftaranLowongans as $item)
                                        <tr>
                                            <td>{{ $item->nama }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td>{{ $item->lowongan->judul }}</td>
                                            <td>{{ $item->lowongan->mitra->perusahaan }}</td>
                                            <td>{{ $item->created_at }}</td>
                                            <td>{{ $item->status }}</td>
                                            <td>
                                                @if($item->cv)
                                                    <!-- Lihat CV -->
                                                    <button class="btn btn-info" onclick="viewCV('{{ asset('storage/' . $item->cv) }}')">
                                                        <i class="bi bi-eye"></i>
                                                    </button>
                                                    <!-- Unduh CV -->
                                                    <a href="{{ asset('storage/' . $item->cv) }}" class="btn btn-primary" download>
                                                        <i class="bi bi-download"></i>
                                                    </a>
                                                @else
                                                    <button class="btn btn-secondary" disabled>
                                                        <i class="bi bi-x-circle"></i> CV Tidak Ada
                                                    </button>
                                                @endif
                                            </td>                                            
                                            <td>
                                                <button class="btn btn-success accept-btn" data-id="{{ $item->id }}">Accept</button>
                                                <button class="btn btn-danger reject-btn" data-id="{{ $item->id }}">Reject</button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- Modal for viewing CV -->
                            <div class="modal fade" id="cvModal" tabindex="-1" aria-labelledby="cvModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="cvModalLabel">CV Pelamar</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <iframe id="cvFrame" src="" width="100%" height="500px" frameborder="0"></iframe>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div>
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

    <script>
        $(document).ready(function () {
            $('#pendaftaranTable').DataTable({
                responsive: true,
                autoWidth: true
            });

            // Handle Accept button
            $(document).on('click', '.accept-btn', function () {
                const id = $(this).data('id');
                if (confirm('Apakah Anda yakin ingin menerima aplikasi ini?')) {
                    $.ajax({
                        url: `/pendaftaran/${id}/update-status`,
                        type: 'POST',
                        data: {
                            status: 'accepted',
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (response) {
                            toastr.success(response.message);
                            location.reload();
                        },
                        error: function (xhr) {
                            toastr.error('Terjadi kesalahan saat memproses permintaan.');
                        }
                    });
                }
            });

            // Handle Reject button
            $(document).on('click', '.reject-btn', function () {
                const id = $(this).data('id');
                if (confirm('Apakah Anda yakin ingin menolak aplikasi ini?')) {
                    $.ajax({
                        url: `/pendaftaran/${id}/update-status`,
                        type: 'POST',
                        data: {
                            status: 'rejected',
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (response) {
                            toastr.success(response.message);
                            location.reload();
                        },
                        error: function (xhr) {
                            toastr.error('Terjadi kesalahan saat memproses permintaan.');
                        }
                    });
                }
            });
        });

        // Function to view CV in modal
        function viewCV(cvUrl) {
            $('#cvFrame').attr('src', cvUrl); // Set the iframe source
            $('#cvModal').modal('show'); // Show the modal
        }
    </script>
</body>

</html>
