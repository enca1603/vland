<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Lembar Disposisi</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('') }}assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&ampdisplay=swap"
        rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('') }}assets/vendor/fonts/tabler-icons.css" />
    <link rel="stylesheet" href="{{ asset('') }}assets/vendor/fonts/fontawesome.css" />
    <!-- <link rel="stylesheet" href="{{ asset('') }}assets/vendor/fonts/flag-icons.css" /> -->

    <!-- Core CSS -->

    <link rel="stylesheet" href="{{ asset('') }}assets/vendor/css/rtl/core.css" />
    <link rel="stylesheet" href="{{ asset('') }}assets/vendor/css/rtl/theme-default.css" />

    <link rel="stylesheet" href="{{ asset('') }}assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('') }}assets/vendor/libs/node-waves/node-waves.css" />
    <link rel="stylesheet" href="{{ asset('') }}assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />


    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="{{ asset('') }}assets/vendor/js/helpers.js"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->

    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('') }}assets/js/config.js"></script>

    <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>

    <style>
        .content {
            width: 210mm;
            padding: 20px
        }

        @media print {
            @page {
                width: 210mm;
                height: 297mm;
                margin: 3mm
            }
        }
    </style>

    <script>
        $(function(){
            window.print();
            window.onafterprint = function(){
                setTimeOut(function(){
                    window.close()
                }, 1000)
            }
        })
    </script>
</head>

<body>
    <div class="content">

        <table class="table table-bordered">
            <tbody>
                <tr>
                    <td colspan="4" class="text-center fw-bold">LEMBAR DISPOSISI</td>
                </tr>
                <tr>
                    <td>Dari</td>
                    <td> {{ $data->surat_masuk->pengirim }}</td>
                    <td>Tgl Diterima:</td>
                    <td> {{ $data->surat_masuk->tgl_terima }}</td>
                </tr>
                <tr>
                    <td>No. Surat</td>
                    <td> {{ $data->surat_masuk->no_surat }}</td>
                    <td>No. Agenda:</td>
                    <td> {{ $data->surat_masuk->no_agenda }}</td>
                </tr>
                <tr>
                    <td>Tgl.Surat</td>
                    <td> {{ $data->surat_masuk->tgl_surat }}</td>
                    <td>Sifat</td>
                    <td> {{ $data->status->sifat }}</td>
                </tr>
                <tr>
                    <td>Prihal</td>
                    <td colspan="3">{{ $data->surat_masuk->prihal }}</td>
                </tr>
                <tr>
                    <td>Diteruskan Kepada</td>
                    <td colspan="3"> {{ $data->kepada }}</td>
                </tr>
                <tr>
                    <th>isi Disposisi</th>
                    <td colspan="3">{{ $data->isi }}</td>
                </tr>
                <tr>
                    <td>Catatan</td>
                    <td colspan="3">{{ $data->catatan }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>