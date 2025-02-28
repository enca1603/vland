<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title></title>
    <style>
        
    </style>
</head>

<body>
    <div class="content">
        <table class="table">
            <thead>
                <tr>
                    <th>Pengirim</th>
                    <th>No. Surat</th>
                    <th>Tanggal</th>
                    <th>Prihal</th>
                    <th>Tgl. Diterima</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $dt)
                <tr>
                    <td>{{ $dt->pengirim }}</td>
                    <td>{{ $dt->no_surat }}</td>
                    <td>{{ $dt->tgl_surat }}</td>
                    <td>{{ $dt->prihal }}</td>
                    <td>{{ $dt->tgl_terima }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>