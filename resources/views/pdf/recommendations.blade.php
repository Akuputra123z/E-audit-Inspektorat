<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: sans-serif; font-size: 12px; }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        th, td {
            border: 1px solid #000;
            padding: 6px;
        }
        th {
            background: #eee;
        }
    </style>
</head>
<body>

<h2>Laporan Rekomendasi LHP</h2>
<p><strong>Nomor LHP:</strong> {{ $lhp->nomor_lhp }}</p>
<p><strong>Kecamatan:</strong> {{ $lhp->nama_kecamatan }}</p>
<p><strong>Unit:</strong> {{ $lhp->unit->nama_unit ?? '-' }}</p>

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Kode Temuan</th>
            <th>Kode Rekom</th>
            <th>Status</th>
            <th>Nilai Rekom</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($lhp->recommendations as $i => $r)
        <tr>
            <td>{{ $i + 1 }}</td>
            <td>{{ $r->kodeTemuan->kode ?? '-' }}</td>
            <td>{{ $r->kodeRekomendasi->kategori ?? '-' }}</td>
            <td>{{ $r->status }}</td>
            <td>{{ number_format($r->nilai_rekom, 0, ',', '.') }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>
