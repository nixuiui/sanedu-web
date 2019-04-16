<!DOCTYPE html>
<html lang="en">

<head>
    @include('partials.include.google')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- <meta name="google-signin-client_id" content="799758054471-0ni1243o0qtq17t9b5fu5l4s4c7q9cgh.apps.googleusercontent.com"> --}}
    <script src="https://apis.google.com/js/api:client.js"></script>
    <script>
    // var googleUser = {};
    // var startApp = function() {
    //     gapi.load('auth2', function(){
    //     auth2 = gapi.auth2.init({
    //         client_id: '799758054471-0ni1243o0qtq17t9b5fu5l4s4c7q9cgh.apps.googleusercontent.com',
    //         cookiepolicy: 'single_host_origin',
    //     });
    //     attachSignin(document.getElementById('customBtn'));
    //     });
    // };
    
    // function attachSignin(element) {
    //     auth2.attachClickHandler(element, {},
    //         function(googleUser) {
    //             var url = "{{ route('auth.login.with.google') }}";
    //             var profile = googleUser.getBasicProfile();
    //             var name = profile.getName();
    //             var givenName = profile.getGivenName();
    //             var familyName = profile.getFamilyName();
    //             var email = profile.getEmail();
    //             var id_token = googleUser.getAuthResponse().id_token;
    //             console.log('ID: ' + profile.getId());
    //             console.log('Full Name: ' + profile.getName());
    //             console.log('Given Name: ' + profile.getGivenName());
    //             console.log('Family Name: ' + profile.getFamilyName());
    //             console.log('Image URL: ' + profile.getImageUrl());
    //             console.log('Email: ' + profile.getEmail());
    //             axios({
    //                 method: 'post',
    //                 url: url,
    //                 data: {
    //                     "id_token": id_token,
    //                     "_token": "{{ csrf_token() }}"
    //                 },
    //                 headers: {}
    //             })
    //             .then(function(response) {
    //                 var data = response.data;
    //                 if(data.success) {
    //                     if(data.action == 'login') {
    //                         location.reload();
    //                     }
    //                     else if(data.action == 'register') {
    //                         url = "{{ route('auth.register') }}";
    //                         url += "?email=" + email + "&name=" + name;
    //                         window.location = url;
    //                     }
    //                 }
    //             })
    //             .catch(function(error) {
    //                 console.log(error);
    //             });
    //         }, function(error) {
    //             alert(JSON.stringify(error, undefined, 2));
    //         }
    //     );
    // }
    </script>
    <style type="text/css">
        #customBtn {
            display: inline-block;
            background: #EFEFEF;
            color: #444;
            border-radius: 5px;
            white-space: nowrap;
            width: 100%;
            padding: 5px 10px;
            position: relative;
        }
        #customBtn:hover {
          cursor: pointer;
          webkit-box-shadow: 0 2px 2px rgba(80, 182, 255, 0.31);
          box-shadow: 0 2px 2px rgba(80, 182, 255, 0.31);
        }
        #customBtn img {
            width: 15px;
            position: absolute;
            top: 8px;
        }
        span.label {
          font-family: serif;
          font-weight: normal;
        }
        span.buttonText {
            ertical-align: middle;
            font-size: 14px;
            font-weight: bold;
            font-family: 'Roboto', sans-serif;
            display: inline-block;
            line-height: 18px;
            width: 100%;
            box-sizing: border-box;
            text-align: center;
        }
      </style>

    <title>@yield('title') - Sanedu</title>

    <!-- =========================
    favicon and app touch icon
    ============================== -->
    <link rel="shortcut icon" href="{{ asset('asset-landing/img/main/favicon.png')}}" />
    <link rel="apple-touch-icon" href="{{ asset('asset-landing/img/main/sanedu-touch.png')}}" />

    <link rel="stylesheet" type="text/css" href="{{ asset('asset-sanone/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('asset-sanone/css/iofrm-style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('asset-sanone/css/iofrm-theme4.css') }}">

    <script src="https://apis.google.com/js/platform.js" async defer></script>
</head>

<body>
    <div class="form-body">
        <div class="website-logo">
            <a href="{{ route('guest.home') }}">
                <div class="logo">
                    <strong style="font-weight: 900">SANEDU</strong> {{-- <img class="logo-size" src="{{ asset('asset-sanone/images/logo-light.svg') }}"
                        alt=""> --}}
                </div>
            </a>
        </div>
        <div class="row">
            <div class="img-holder">
                <div class="bg"></div>
                <div class="info-holder">
                    <h3>@yield('desc')</h3>
                    <img src="{{ asset('asset-sanone/images/graphic3.svg') }}" alt="">
                </div>
            </div>
            @yield('content')
        </div>
    </div>
</body>
<script src="{{ asset('asset-sanone/js/jquery.min.js')}}"></script>
<script src="{{ asset('asset-sanone/js/popper.min.js')}}"></script>
<script src="{{ asset('asset-sanone/js/bootstrap.min.js')}}"></script>
<script src="{{ asset('asset-sanone/js/main.js')}}"></script>
<script src="{{ asset('asset-beagle/lib/axios/axios.min.js') }}" type="text/javascript"></script>

</html>