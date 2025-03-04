<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>

    <title></title>

    {{-- <script>
        $(function(){
            window.print();
            window.onafterprint = function(){
                setTimeOut(function(){
                    window.close()
                }, 1000)
            }
        })
    </script> --}}

</head>

<body>
    <h2 class="h2 text-center">Laporan Surat Masuk</h2>
    <p class="text-center">Tanggal : {{ $awal ?? '-' }} s.d {{ $akhir ?? '-' }}</p>
    <table class="table table-bordered">
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