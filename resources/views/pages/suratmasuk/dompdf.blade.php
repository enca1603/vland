<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>

    <link rel="stylesheet" href="{{ base_path('public/assets/vendor/css/core.css') }}">
</head>

<body>
    <div>
        <p>{{ asset('assets/vendor/css/core.css') }}</p>
        <p>{{ public_path('assets/vendor/css/core.css') }}</p>
        <p class=" text-center">Laporan Surat Masuk</p>
        <p class=" text-center">Tanggal : {{ $awal ?? '-' }} s.d {{ $akhir ?? '-' }}</p>
        <table class="table" style="border: 1px solid;">
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
        </>
        </script>
</body>

</html>