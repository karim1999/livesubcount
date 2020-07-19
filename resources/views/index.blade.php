<html class="{{session('mode')=='night' ? 'dark': ''}}">
<head>

    <link href="https://fonts.googleapis.com/css2?family=Almarai&display=swap" rel="stylesheet">


    @php
        $api= \App\Http\Controllers\ApiController::get_content();
    @endphp
    <?php $version= '?v='.time(); ?>
    <link rel="icon" type="image/png" href="@if(session('language')=="ar") {{$api['site_profile']->icon_ar}} @else {{$api['site_profile']->icon_en}} @endif " />
    <meta name=" description" content="
@if(session('language')=="ar") {{$api['site_profile']->site_description_ar}} @else {{$api['site_profile']->site_description_en}} @endif ">

    <title>
        @if(session('language')=="ar") {{$api['site_profile']->site_name_ar}} | {{$api['site_profile']->site_sub_name_ar}} @else {{$api['site_profile']->site_name_en}} | {{$api['site_profile']->site_sub_name_en}} @endif </title>

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="
@if(session('language')=="ar") {{$api['site_profile']->ar_keywords}} @else {{$api['site_profile']->en_keywords}} @endif
        ">
    {!!$api['site_profile']->google_analytics!!}


    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">



    <style>
        html.dark, body.dark, .container.dark{
            background-color: #171734;
        }
        :root {
            background: #f5f6fa;
            color: #9c9c9c;
            font: 1rem "PT Sans", sans-serif;
        }
        *{
            font-family: 'Almarai', sans-serif;
        }
        html,
        body,
        .container {
            height: 100%;
            background: #f5f6fa
        }

        a {
            color: inherit;
        }
        a:hover {
            color: #7f8ff4;
        }

        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .uppercase {
            text-transform: uppercase;
        }

        .btn {
            display: inline-block;
            background: transparent;
            color: inherit;
            font: inherit;
            border: 0;
            outline: 0;
            padding: 0;
            transition: all 200ms ease-in;
            cursor: pointer;
        }
        .btn--primary {
            background: red;
            color: #fff;
            box-shadow: 0 0 10px 2px rgba(0, 0, 0, 0.1);
            border-radius: 2px;
            padding: 12px 36px;
        }
        .btn--primary:hover {
            background: #6c7ff2;
        }
        .btn--primary:active {
            background: #7f8ff4;
            box-shadow: inset 0 0 10px 2px rgba(0, 0, 0, 0.2);
        }
        .btn--inside {
            margin-left: -96px;
        }

        .form__field {
            width: 360px;
            background: #fff;
            color: #a3a3a3;
            font: inherit;
            box-shadow: 0 6px 10px 0 rgba(0, 0, 0, 0.1);
            border: 0;
            outline: 0;
            padding: 22px 18px;
        }
        .switch {
            position: relative;
            display: inline-block;
            width: 48px;
            height: 20px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 15px;
            width: 15px;
            left: 4px;
            bottom: 3px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input:checked + .slider {
            background-color: #2196F3;
        }

        input:focus + .slider {
            box-shadow: 0 0 1px #2196F3;
        }

        input:checked + .slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }

    </style>
</head>
<body class="{{session('mode')=='night' ? 'dark': ''}}">


<!-- after body -->
<div class="col-12 px-0">
    <div class="col-12 px-0">
        @if(session('language')=="ar" && session('popup_status')!="false" && $api['advs']->popup_status==1)
            {!!$api['advs']->popup_ar!!}
        @else
            {!!$api['advs']->popup_en!!}
        @endif
    </div>
    <div class="col-12 px-0">
        @if(session('language')=="ar" && session('header_status')!="false" && $api['advs']->header_status==1)
            {!!$api['advs']->header_ar!!}
        @else
            {!!$api['advs']->header_en!!}
        @endif
    </div>
</div>

<div class="col-12 px-0" style="">
    <div class="container {{session('mode')=='night' ? 'dark': ''}}" style="padding: 10px 5px 5px; height: auto">
        <div class="col-12 row px-0">
            <div class="col-6 text-left">
                @if ( Config::get('app.locale') == 'en')

                    <a style="color: #8e8e8f; text-decoration: none" class="" href="/switch_language/ar">العربية</a>

                @elseif ( Config::get('app.locale') == 'ar' )

                    <a style="color: #8e8e8f; text-decoration: none" class="" href="/switch_language/en">English</a>

                @endif

            </div>
            <div class="col-6 text-right" style="display: flex; flex-direction: row; justify-content: flex-end; align-items: center">
                <p style="margin-right: 10px; margin-left: 10px">
                    @lang('index.dark_mode')
                </p>
                <label class="switch">
                    <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1" style="opacity: 0" @if(session('mode')=='night' ) checked=""  @endif>
                    <span class="slider round"></span>
                </label>

            </div>
        </div>
    </div>
</div>


<div class="container {{session('mode')=='night' ? 'dark': ''}}" style="height: 95vh">

    <!-- Logo API -->
    <a href="{{env('APP_URL')}}">
        @if(session('language')=='ar')
            <img style="height:60px;" src="{{$api['site_profile']->logo_ar_path}}" class="d-inline-block text-center mb-5" id="site-logo">
        @elseif(session('language')=='en')
            <img style="height:60px;" src="{{$api['site_profile']->logo_en_path}}" class="d-inline-block text-center mb-5" id="site-logo">
        @endif
    </a>


    <a href="#">

    </a>
    <div class="container__item" style="max-width: 100%;">
        <form class="form" action="{{route('get-count')}}" method="get">
            <div class="col-12 px-0 row m-0">
                <input type="text" class="form__field" name="q" placeholder="@lang('index.search_placeholder')" />


                <button type="submit" class="btn btn--primary btn--inside uppercase" style="box-shadow: unset!important;z-index: 4545454;position: relative;    position: absolute;right: 0px;padding: 22px 30px">
                    @lang('index.send')
                </button>


            </div>



        </form>
    </div>
</div>

<!--footer 1-->
<link rel="stylesheet" type="text/css" href="https://footer.devlab.ae/public/styles.css">
@if(session('language')!='en')
    <!--#171734 = night background color & f5f7fb = day background color -->
    <iframe src="https://footer.devlab.ae/ar?mode={{session('mode')}}&night_bg=171734&day_bg=f5f7fb" class="col-12 footer-iframe px-0" style="width: 100%" id="devlab-footer"></iframe>
@else
    <iframe src="https://footer.devlab.ae/en?mode={{session('mode')}}&night_bg=171734&day_bg=f5f7fb" class="col-12 footer-iframe px-0" style="width: 100%"  id="devlab-footer" ></iframe>
@endif


<!--footer 2-->
@if(session('language')=="ar" && $api['footer']->footer_ar_enabled==1)
    {!!$api['footer']->footer_ar!!}
@elseif($api['footer']->footer_en_enabled==1)
    {!!$api['footer']->footer_en!!}
@endif

<!--footer 3-->
<script type="text/javascript">
    function update_mood(){
        //must check current mode in frontend - or backend -
        $.ajax({
            method: "get",
            url: "/update_mode",
            data: { mode: 'night' }
        }).done(function(msg) {});
        $.ajax({
            method: "get",
            url: "/update_mode",
            data: { mode: 'day' }
        }).done(function(msg) {});
    }
    $('#inlineCheckbox1').change(function() {

        if ($(this).is(':checked')) {


            $('#devlab-footer').attr('src','https://footer.devlab.ae/{{session('language')}}?mode=night&night_bg=171734&day_bg=f5f7fb');

            $('#site-logo').attr('src', '{{$api['site_profile']->logo_en_path_dark}}');
            $('body').addClass("dark");
            $('html').addClass("dark");
            $('.container').addClass("dark");

            $.ajax({
                method: "get",
                url: "/update_mode",
                data: { mode: 'night' }
            }).done(function(msg) {});
        } else {

            $('#devlab-footer').attr('src','https://footer.devlab.ae/{{session('language')}}?mode=day&night_bg=171734&day_bg=f5f7fb');

            $('body').removeClass("dark");
            $('html').removeClass("dark");
            $('.container').removeClass("dark");


            $('#site-logo').attr('src', '{{$api['site_profile']->logo_en_path}}');

            $.ajax({
                method: "get",
                url: "/update_mode",
                data: { mode: 'day' }
            }).done(function(msg) {});
        }
    });

</script>


</body>
</html>
