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
        font-size: 9px;
        letter-spacing: 0px;
        top: 0;
        right: 0;
        left: 0px;
    }
    .pin {
        position: absolute;
        top: 39px;
        left: 42px;
        letter-spacing: 0px;
        color: #333;
    }
    .online, .offline {
        position: absolute;
        font-size: 6px;
        background: #444;
        padding: 1px;
        border-radius: 1px;
        right: 15px;
        top: 25px;
        letter-spacing: 0px;
        color: #FFF;
    }
    .offline {
        background: #e94335;
    }
    .online {
        background: #fbbc05;
    }
    @page { margin: 10px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <table width="100%">
            @foreach($tiket as $key => $val)
            {!! $key%5 == 0 ? "<tr>":"" !!}
                <td class="tiket-wrapper">
                    <img class="tiket" src="{{ $simulasi->tiket_url }}" width="187px" />
                    <div class="field">
                        {!! $simulasi->is_offline ? "<span class='offline'>OFFLINE</span>":"" !!}
                        {!! $simulasi->is_online ? "<span class='online'>ONLINE</span>":"" !!}
                        <span class="pin">{{ substr($val->pin, -16, 4) }} - {{ substr($val->pin, -12, 4) }} - {{ substr($val->pin, -8, 4) }} - {{ substr($val->pin, -4, 4) }}</span>
                    </div>
                </td>
                @if($key+1 == $tiket->count())
                    @for ($i = 0; $i < 5-($tiket->count()%5); $i++)
                    <td class="tiket-wrapper" style="visibility:hidden">
                        <img class="tiket" src="{{ $simulasi->tiket_url }}" width="187px" />
                        <div class="field">
                            {!! $simulasi->is_offline ? "<span class='offline'>OFFLINE</span>":"" !!}
                            {!! $simulasi->is_online ? "<span class='online'>ONLINE</span>":"" !!}
                            <span class="pin">{{ substr($val->pin, -16, 4) }} - {{ substr($val->pin, -12, 4) }} - {{ substr($val->pin, -8, 4) }} - {{ substr($val->pin, -4, 4) }}</span>
                        </div>
                    </td>
                    @endfor
                @endif
            {!! $key%5 == 4 ? "</tr>":"" !!}
            @endforeach
        </table>
    </div>
</body>
</html>
