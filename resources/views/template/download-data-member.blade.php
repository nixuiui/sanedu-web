<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="{{ asset('img/logo.png') }}">
    <title>@yield('title') - Baristand</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <style media="screen">
    tr td, tr th{
        padding: 10px !important;
        margin: 0 !important;
    }
</style>
<script src="{{ asset('asset-beagle/lib/jquery/jquery.min.js') }}" type="text/javascript"></script>
</head>
<!-- END HEAD -->

<body style="background: white">
    <h1 class="text-center" style="margin-top: 50px;">
        DATA MEMBER SANEDU
    </h1>
    <div class="text-center" style="margin-bottom: 20px;">{{ hariTanggalWaktu() }}</div>
    <table class="table table-bordered" style="font-weight: normal;">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Sekolah</th>
                <th>No. Telp</th>
                <th>Point</th>
            </tr>
        </thead>
        <tbody>
            @foreach($member as $no => $val)
            <tr>
                <td>{{ $no+1 }}</td>
                <td>{{ $val->nama }}</td>
                <td>{{ $val->sekolah }}</td>
                <td>{{ $val->no_hp }}</td>
                <td></td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Sekolah</th>
                <th>No. Telp</th>
                <th>Point</th>
            </tr>
        </tfoot>
    </table>
</body>
</html>
