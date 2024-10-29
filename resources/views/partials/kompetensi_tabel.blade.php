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
        <td><strong>{{ $kompetensi->sum('jumlah_alumni') }}</strong></td>
    </tr>
