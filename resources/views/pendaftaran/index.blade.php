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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
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
                                            <th>Judul Lowongan</th>
                                            <th>Perusahaan</th>
                                            <th>Tanggal Pendaftaran</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($pendaftaranLowongans as $item)
                                        <tr>
                                            <td>{{ $item->user->name }}</td>
                                            <td>{{ $item->lowongan->judul }}</td>
                                            <td>{{ $item->lowongan->perusahaan }}</td>
                                            <td>{{ $item->tanggal_pendaftaran }}</td>
                                            <td>{{ $item->status }}</td>
                                            <td>
                                                <button class="btn btn-success accept-btn" data-id="{{ $item->id }}">Accept</button>
                                                <button class="btn btn-danger reject-btn" data-id="{{ $item->id }}">Reject</button>
                                            </td>                                            
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="modal fade" id="interviewModal" tabindex="-1" aria-labelledby="interviewModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="interviewModalLabel">Interview Details</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="interviewForm">
                                                <div class="form-group">
                                                    <label for="lokasi_interview">Lokasi Interview</label>
                                                    <input type="text" class="form-control" id="lokasi_interview" name="lokasi_interview" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="tanggal_interview">Tanggal Interview</label>
                                                    <input type="date" class="form-control" id="tanggal_interview" name="tanggal_interview" required>
                                                </div>
                                                <input type="hidden" id="lamaran_id">
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary save-interview-btn">Save</button>
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
    <script src="assets/static/js/components/dark.js"></script>
    <script src="assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/compiled/js/app.js"></script>

    <script>
        $(document).ready(function () {
            $('#pendaftaranTable').DataTable({
                responsive: true,
                autoWidth: true
            });

            // Handle Accept button
            $(document).on('click', '.accept-btn', function () {
                const id = $(this).data('id');
                $('#lamaran_id').val(id); // Set the lamaran ID in the hidden input
                $('#interviewModal').modal('show'); // Show the modal
            });

            // Save interview details
            $('.save-interview-btn').click(function () {
                const id = $('#lamaran_id').val();
                const lokasi = $('#lokasi_interview').val();
                const tanggal = $('#tanggal_interview').val();

                $.ajax({
                    url: `/pendaftaran/${id}/update-status`,
                    type: 'POST',
                    data: {
                        status: 'accepted',
                        lokasi_interview: lokasi,
                        tanggal_interview: tanggal,
                        _token: $('meta[name="csrf-token"]').attr('content') // Include CSRF token
                    },
                    success: function (response) {
                        alert(response.message);
                        location.reload(); // Reload the page
                    },
                    error: function (xhr) {
                        console.error('Error:', xhr.responseText);
                    }
                });
            });

            // Handle Reject button
            $(document).on('click', '.reject-btn', function () {
                const id = $(this).data('id');
                if (confirm('Are you sure you want to reject this application?')) {
                    $.ajax({
                        url: `/pendaftaran/${id}/update-status`,
                        type: 'POST',
                        data: {
                            status: 'rejected',
                            _token: $('meta[name="csrf-token"]').attr('content') // Include CSRF token
                        },
                        success: function (response) {
                            alert(response.message);
                            location.reload(); // Reload the page
                        },
                        error: function (xhr) {
                            console.error('Error:', xhr.responseText);
                        }
                    });
                }
            });
        });
    </script>
</body>

</html>
