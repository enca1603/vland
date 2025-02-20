<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <script>
        window.print();
        window.onafterprint = function() {
            setTimeout(function() {
                window.close();
            }, 500);
        }
    </script>
</head>

<body>
    @foreach ($data as $d)
    <p>{{ $d->no_surat }}</p>
    @endforeach
</body>

</html>