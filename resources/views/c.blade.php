<?php
use Illuminate\Support\Facades\Http;
$channel_id = str_replace('https://www.youtube.com/channel/', '', $_GET['q']);
$channel_id = str_replace('https://youtube.com/channel/', '', $_GET['q']);
$channel_id = str_replace('www.youtube.com/channel/', '', $_GET['q']);
$channel_id = str_replace('youtube.com/channel/', '', $_GET['q']);

if(session($channel_id)==200 || session($channel_id)==null){
    $res = Http::get('https://www.googleapis.com/youtube/v3/channels?part=statistics&id='.$channel_id.'&key='."AIzaSyCJ783Sga9-QAOZwmq5TdO0iXtCpuF64_I");
    session([$channel_id=>$res->status()]);
    $data = $res->json();
}
?>
    <!DOCTYPE html>
<html lang="en" class="{{session('mode')=='night' ? 'dark': ''}}">
<head>

    <meta charset="utf-8">
    <link href="https://fonts.googleapis.com/css2?family=Almarai&display=swap" rel="stylesheet">
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
        h1.dark, p.dark, a.dark{
            color: #ffffff !important;
        }

    </style>


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



</head>
<body  class="{{session('mode')=='night' ? 'dark': ''}}" style="bg-light">

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



<style type="text/css">
    *{
        font-family: 'Almarai', sans-serif;
    }
</style>
<div class="container" {{session('mode')=='night' ? 'dark': ''}}>
    <br>
    <div class="text-dark">
        <div class="card-body text-center" style="min-height: 100vh">
            <a href="{{env('APP_URL')}}">
                @if(session('language')=='ar')
                    <img style="height:60px;" src="{{$api['site_profile']->logo_ar_path}}" class="d-inline-block text-center mb-5" id="site-logo">
                @elseif(session('language')=='en')
                    <img style="height:60px;" src="{{$api['site_profile']->logo_en_path}}" class="d-inline-block text-center mb-5" id="site-logo">
                @endif
            </a>
            <div class="col-12 row m-0 justify-content-center" style="min-height: 70vh">
                <div class="m-auto">
                    <h1 id="subs" style="color:#282828;font-size:7vw;" class="text-center {{session('mode')=='night' ? 'dark': ''}}"><i class="fa fa-refresh fa-spin" style="font-size:7vw"></i></h1>
                    <h1 style="color:#ff0000;font-size:5vw" >@lang('index.live') <img style="height:50px;" src="public/live.gif"> @lang('index.subscribers')</h1>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<br>
</body>
<script>
    $(document).ready(function(){
        setInterval(function(){
            $.ajax( "count?q=<?php echo str_replace('https://www.youtube.com/channel/', '', $channel_id) ;?>" )
                .done(function(msg) {
                    $('#subs').empty().append(msg);
                })
                .fail(function() {
                    window.location="{{env('APP_URL')}}";
                });

        },3000);
    });
    $.ajax( "count?q=<?php echo str_replace('https://www.youtube.com/channel/', '', $channel_id) ;?>" )
        .done(function(msg) {
            $('#subs').empty().append(msg);
        })
        .fail(function() {
            window.location="{{env('APP_URL')}}";
        });

    /*

        $("#subs").load('count?q=<?php echo str_replace('https://www.youtube.com/channel/', '', $channel_id) ;?>');
    if($("#subs").text()=="x" ){
           window.location="{{env('APP_URL')}}";
      }*/
</script>



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
</script>




</html>
