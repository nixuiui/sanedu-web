<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title></title>
    <style media="screen">
    .wrapper { 
        width: 750px;
        height: 57px;
    }
    .tiket-wrapper { 
        position: relative;
    }
    .tiket-1 {
        left: 0;
        position: absolute;
    }
    .tiket-2 {
        left: 150px;
        position: absolute;
    }
    .tiket-3 {
        left: 300px;
        position: absolute;
    }
    .tiket-4 {
        left: 450px;
        position: absolute;
    }
    .tiket-5 {
        left: 600px;
        position: absolute;
    }
    .tiket-wrapper .tiket { 
        margin-bottom: 0px; 
        width: 150px;
    }
    .pin {
        font-weight: bold;
        color: #444;
        font-family: helvetica;
        font-size: 5px;
        position: absolute;
        letter-spacing: 0px;
        left: 22px;
        top: 31px;
        z-index: 999;
    }
    @page { margin: 10px; }
    </style>
</head>
<body>
    @foreach($tiket as $key => $val)
    {!! $key%5 == 0 ? "<div class=\"wrapper\">":"" !!}
        <div class="tiket-wrapper tiket-{{ $key%5+1 }}">
            <img class="tiket" src="{{ asset('image/tiket_legacy_2019.jpg')}}" />
            <span class="pin">{{ substr($val->pin, -16, 4) }} - {{ substr($val->pin, -12, 4) }} - {{ substr($val->pin, -8, 4) }} - {{ substr($val->pin, -4, 4) }}</span>
        </div>
    {!! $key%5 == 4 ? "</div>":"" !!}
    @endforeach
</body>
</html>
