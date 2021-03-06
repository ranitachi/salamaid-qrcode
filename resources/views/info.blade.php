<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="https://netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css" rel="stylesheet"> 
        <link href="https://netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.css" rel="stylesheet">
        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: top;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="position-ref full-height">
            <div class="row">
                @if ($konten)
                    <div class="col-md-6 col-sm-12">
                        @php
                            list($name,$ext)=explode('.',$konten->file);
                        @endphp
                        @if ($konten->file)
                            @if ($ext=='pdf')
                                {{-- <iframe src="{{ url('show-image/'.$konten->file) }}#toolbar=0&navpanes=0&scrollbar=0" type="application/pdf" width="100%" height="900px" style="width:100%"></iframe>         --}}
                                {{-- <iframe src ="{{ asset('/laraview/#../'. $konten->file.'') }}" width="1000px" height="600px"></iframe> --}}
                                <iframe src="https://docs.google.com/viewer?url={{ url('show-image/'.$konten->file) }}&embedded=true" width="100%" height="900px" style="width: 100%; height: 900px;" frameborder="0" scrolling="no"></iframe>
                            @else
                                <img src="{{ url('show-image/'.$konten->file) }}" style="width:100%">
                            @endif
                        @endif
                    </div>
                    <div class="col-md-6 col-sm-12">
                        @if ($konten->konten)
                            {!! $konten->konten !!}
                        @endif
                    </div>
                @else
                    <div class="text-center" style="text-align:center">
                        <img src="{{ URL::asset('jsan-salamaid.png') }}">
                        <div class="col-md-12">
                                <div class="alert alert-info">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                                    <h1>Info Tidak Di temukan</h1>
                                </div>
                            </div>
                        
                    </div>
                @endif
                
                
            </div>
        </div>
    </body>
</html>
