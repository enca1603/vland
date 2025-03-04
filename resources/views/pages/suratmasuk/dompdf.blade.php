<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <!-- Core CSS -->

    <style>
        body {
            margin: 0;
            padding: 0;
            text-align: center;
            font-family: Arial, Helvetica, sans-serif;
        }

        h1 {
            margin-bottom: 5px;
        }

        h4 {
            margin-top: 0;
            font-weight: normal;
        }

        table {
            width: 100%;
        }

        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 10px;
        }

        hr {
            border: 1px solid black;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <div>
        <h1 class="text-center">Laporan Surat Masuk</h1>
        <h4 class="text-center">Tanggal : {{ $awal ?? '-' }} s.d {{ $akhir ?? '-' }}</h4>
        <table>
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