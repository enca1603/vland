<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title></title>

    <style>
        table {
            border: 1px !important;
        }
    </style>
</head>

<body>
    <h2 class="h2 text-center">Laporan Surat Masuk</h2>
    <p class="text-center">Tanggal : {{ $awal ?? '-' }} s.d {{ $akhir ?? '-' }}</p>
    <table class=" table">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>No. Surat</th>
                <th>Pengirim</th>
                <th>Prihal</th>
                <th>Tgl. Diterima</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $dt)
            <tr>
                <td>{{ $dt->tgl_surat }}</td>
                <td>{{ $dt->no_surat }}</td>
                <td>{{ $dt->pengirim }}</td>
                <td>{{ $dt->prihal }}</td>
                <td>{{ $dt->tgl_terima }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>