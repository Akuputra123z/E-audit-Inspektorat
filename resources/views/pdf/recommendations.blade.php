<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: sans-serif; font-size: 12px; }

        .kop-surat {
            width: 80%;
            text-align: center;
            margin-bottom: 15px;
        }

        .kop-surat img {
            width: 100%;
            height: auto;
        }

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

        .ttd-single {
            width: 100%;
            text-align: right;
            margin-top: 60px;
            padding-right: 40px;
        }

        .ttd-single img {
            width: 120px;
            height: auto;
            margin-bottom: -10px;
        }
    </style>
</head>
<body>

<!-- KOP SURAT -->
<div class="kop-surat">
    <img src="{{ public_path('images/logorembang.png') }}" alt="Kop Surat">
</div>

<h3 style="text-align:center;">LAPORAN REKOMENDASI LHP</h3>

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

<!-- TTD -->
<div class="ttd-single">
    <p>{{ now()->format('d F Y') }}</p>
    <p><strong>Kepala Unit</strong></p>

    <!-- GAMBAR TANDA TANGAN -->
    <img src="{{ public_path('images/ttd.png') }}" alt="Tanda Tangan">

    <p><strong>Nama Pejabat</strong></p>
</div>

</body>
</html>
