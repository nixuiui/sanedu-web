<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title></title>
    <style media="screen">
    .wrapper { overflow: hidden; }
    .tiket-wrapper { position: relative; }
    .tiket-wrapper .tiket { margin-bottom: 0px; }
    .tiket-wrapper .field {
        font-weight: bold;
        color: #444;
        width: 100%;
        height: 100%;
        font-family: helvetica;
        position: absolute;
        font-size: 7px;
        letter-spacing: 0px;
        top: 0;
        right: 0;
        left: 0px;
    }
    .pin {
        position: absolute;
        top: 38px;
        left: 78px;
        letter-spacing: 0px;
        color: #FFF;
    }
    @page { margin: 10px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <table width="100%">
            @foreach($tiket as $key => $val)
            {!! $key%4 == 0 ? "<tr>":"" !!}
                <td class="tiket-wrapper">
                    <img class="tiket" src="{{ asset("image/voucher_pg_" . $cetak->harga . ".jpg")}}" width="187px" />
                    <div class="field">
                        <span class="pin">{{ substr($val->pin, -16, 4) }} - {{ substr($val->pin, -12, 4) }} - {{ substr($val->pin, -8, 4) }} - {{ substr($val->pin, -4, 4) }}</span>
                    </div>
                </td>
                @if($key+1 == $tiket->count())
                    @for ($i = 0; $i < 4-($tiket->count()%4); $i++)
                    <td class="tiket-wrapper">
                        <img class="tiket" src="{{ asset("image/voucher_pg_" . $cetak->harga . ".jpg")}}" width="187px" />
                        <div class="field">
                            <span class="pin">{{ substr($val->pin, -16, 4) }} - {{ substr($val->pin, -12, 4) }} - {{ substr($val->pin, -8, 4) }} - {{ substr($val->pin, -4, 4) }}</span>
                        </div>
                    </td>
                    @endfor
                @endif
            {!! $key%4 == 3 ? "</tr>":"" !!}
            @endforeach
        </table>
    </div>
</body>
</html>
