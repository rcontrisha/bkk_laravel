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
