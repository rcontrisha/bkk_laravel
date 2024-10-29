<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard</title>

    <link rel="stylesheet" href="./assets/compiled/css/app.css">
    <link rel="stylesheet" href="./assets/compiled/css/app-dark.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Tambahkan Library html2canvas dan jsPDF -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

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
                            <h3>Dashboard Admin</h3>
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
                <section>
                    <div class="container mt-4">
                        <h5>Rekap Penelusuran Tamatan:</h5>
                        <div class="form-group d-flex justify-content-between align-items-center">
                            <select class="form-control" style="width: 200px;" id="tahunKelulusanDropdown">
                                <option>--Tahun--</option>
                                @foreach($tahunKelulusan as $tahun)
                                <option value="{{ $tahun->tahun_kelulusan }}">{{ $tahun->tahun_kelulusan }}</option>
                                @endforeach
                            </select>
                            <button class="btn btn-secondary ml-2 no-pdf" id="downloadPdfBtn">Download PDF</button>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Tahun</th>
                                        <th>Jumlah</th>
                                        <th colspan="2">Bekerja</th>
                                        <th colspan="2">Kuliah</th>
                                        <th colspan="2">Wirausaha</th>
                                        <th colspan="2">Belum Kerja</th>
                                        <th colspan="2">Belum Terdata</th>
                                        <th>Opsi</th>
                                    </tr>
                                    <tr>
                                        <th></th>
                                        <th></th>
                                        <th>Orang</th>
                                        <th>Persen (%)</th>
                                        <th>Orang</th>
                                        <th>Persen (%)</th>
                                        <th>Orang</th>
                                        <th>Persen (%)</th>
                                        <th>Orang</th>
                                        <th>Persen (%)</th>
                                        <th>Orang</th>
                                        <th>Persen (%)</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="rekapTableBody">
                                    @foreach($rekapitulasi as $data)
                                    <tr>
                                        <td>{{ $data->tahun_kelulusan }}</td>
                                        <td>{{ $data->total }}</td>
                                        <td>{{ $data->bekerja }}</td>
                                        <td>{{ number_format(($data->bekerja / $data->total) * 100, 2) }}</td>
                                        <td>{{ $data->kuliah }}</td>
                                        <td>{{ number_format(($data->kuliah / $data->total) * 100, 2) }}</td>
                                        <td>{{ $data->wirausaha }}</td>
                                        <td>{{ number_format(($data->wirausaha / $data->total) * 100, 2) }}</td>
                                        <td>{{ $data->belum_kerja }}</td>
                                        <td>{{ number_format(($data->belum_kerja / $data->total) * 100, 2) }}</td>
                                        <td>{{ $data->belum_terdata }}</td>
                                        <td>{{ number_format(($data->belum_terdata / $data->total) * 100, 2) }}</td>
                                        <td>
                                            <a href="{{ route('alumni.data.tahun', ['tahun' => $data->tahun_kelulusan]) }}" class="btn btn-primary no-pdf">Lihat Data Tamatan</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <h5>Kompetensi Keahlian:</h5>
                        <table class="table table-bordered">
                            <thead class="thead-light">
                                <tr>
                                    <th>No.</th>
                                    <th>Kompetensi Keahlian</th>
                                    <th>Jumlah Alumni</th>
                                </tr>
                            </thead>
                            <tbody id="kompetensiTableBody">
                                @php $no = 1; @endphp
                                @foreach($kompetensi as $kompeten)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $kompeten->kompetensi_keahlian }}</td>
                                    <td>{{ $kompeten->jumlah_alumni }}</td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td colspan="2"><strong>Total</strong></td>
                                    <td><strong>{{ $totalAlumni }}</strong></td>
                                </tr>
                            </tbody>
                        </table>

                        <h5>Grafik Lulusan:</h5>
                        <canvas id="lulusanChart" style="max-width: 800px; height: 400px;"></canvas>
                    </div>
                </section>
            </div>
        </div>
        @include('partials.footer')
    </div>
    <script>
        console.log("Chart.js loaded:", typeof Chart !== 'undefined');
    
        // Initialize chart as a global variable
        var ctx = document.getElementById('lulusanChart').getContext('2d');
        var lulusanChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [], // Initial labels
                datasets: [{
                    label: 'Jumlah Alumni',
                    data: [], // Initial data
                    backgroundColor: 'rgba(54, 162, 235, 0.6)',
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        suggestedMin: 5,
                        suggestedMax: 10
                    }
                }
            }
        });
    
        $(document).ready(function () {
            // Set initial chart data using all alumni data
            updateChart(@json($chartData)); // Mengisi chart dengan data awal
    
            // Event listener for dropdown change
            $('#tahunKelulusanDropdown').change(function () {
                var selectedTahun = $(this).val();
    
                $.ajax({
                    url: '{{ route("dashboard") }}',
                    method: 'GET',
                    data: {
                        tahun: selectedTahun
                    },
                    success: function (response) {
                        console.log(response); // Debugging response data
                        $('#rekapTableBody').html(response.rekapHtml);
                        $('#kompetensiTableBody').html(response.kompetensiHtml);
                        updateChart(response.rekap); // Update chart with received data
                    },
                    error: function (xhr) {
                        console.error("Error fetching data: ", xhr);
                    }
                });
            });
    
            // Function to update chart
            function updateChart(data) {
                console.log(data); // Debugging received data
                lulusanChart.data.labels = data.labels; // Update chart labels
                lulusanChart.data.datasets[0].data = data.counts; // Update chart data
                lulusanChart.update(); // Refresh chart
            }
    
        });

        document.getElementById('downloadPdfBtn').addEventListener('click', function () {
            const { jsPDF } = window.jspdf;

            // Buat instance PDF
            const pdf = new jsPDF('p', 'pt', 'a4');

            // Ambil elemen tabel dan grafik tanpa elemen dengan kelas no-pdf
            const content = document.querySelector('.container');
            content.querySelectorAll('.no-pdf').forEach(element => element.style.display = 'none');

            html2canvas(content).then(canvas => {
                // Kembalikan tampilan elemen no-pdf setelah mengambil screenshot
                content.querySelectorAll('.no-pdf').forEach(element => element.style.display = '');

                const imgData = canvas.toDataURL('image/png');
                const imgWidth = 500;
                const pageHeight = 800;
                const imgHeight = canvas.height * imgWidth / canvas.width;
                let heightLeft = imgHeight;
                let position = 0;

                // Tambahkan gambar ke PDF
                pdf.addImage(imgData, 'PNG', 15, position, imgWidth, imgHeight);
                heightLeft -= pageHeight;

                while (heightLeft >= 0) {
                    position -= pageHeight;
                    pdf.addPage();
                    pdf.addImage(imgData, 'PNG', 15, position, imgWidth, imgHeight);
                    heightLeft -= pageHeight;
                }

                pdf.save('dashboard.pdf'); // Nama file PDF
            });
        });
    </script>    

    <script src="assets/static/js/initTheme.js"></script>
    <script src="assets/static/js/components/dark.js"></script>
    <script src="assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/compiled/js/app.js"></script>
</body>

</html>
