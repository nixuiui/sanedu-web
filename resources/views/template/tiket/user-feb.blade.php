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
        left: 286px;
    }
    .kap {
        position: absolute;
        top: 48px;
        left: 0px;
    }
    .pin {
        position: absolute;
        top: 65px;
        left: 0px;
        letter-spacing: 0px;
    }
    @page { margin: 10px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <table width="100%">
            @foreach($tiket as $key => $val)
            @if($key % 2 == 0)
            <tr>
            @endif
                <td class="tiket-wrapper">
                    <img class="tiket" src="{{ asset('image/tiket_user_feb.png')}}" width="383px" />
                    <div class="field">
                        <span class="kap">{{ substr($val->kap, -12, 6) }} - {{ substr($val->kap, -6, 6) }}</span>
                        <span class="pin">{{ substr($val->pin, -16, 4) }} - {{ substr($val->pin, -12, 4) }} - {{ substr($val->pin, -8, 4) }} - {{ substr($val->pin, -4, 4) }}</span>
                    </div>
                </td>
            @if($key % 2 == 1)
            </tr>
            @endif
            @endforeach
        </table>
    </div>
</body>
</html>
