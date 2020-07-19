<?php
use Illuminate\Support\Facades\Http;
$channel_id = str_replace('https://www.youtube.com/channel/', '', $_GET['q']);
$api_key= "AIzaSyBYMXeVeCSBpAl64brrPfaW4XRA2G67LWE";
//if(session($channel_id)==200 || session($channel_id)==null){
//}else{
    $res = Http::get('https://www.googleapis.com/youtube/v3/search?part=snippet&type=channel&fields=items/snippet/channelId&q='.$channel_id.'&key='.$api_key);
    $api_response = $res->body();
    $data = json_decode($api_response, true);
    if(count($data['items']) > 0){
        $channel_id= $data['items'][0]['snippet']['channelId'];
        $res = Http::get('https://www.googleapis.com/youtube/v3/channels?part=statistics&id='.$channel_id.'&key='.$api_key);
        session([$channel_id=>$res->status()]);
        $api_response = $res->body();
        $data = json_decode($api_response, true);
        echo number_format($data['items'][0]['statistics']['subscriberCount']);
    }else{
        echo "x";
    }
//}
?>
