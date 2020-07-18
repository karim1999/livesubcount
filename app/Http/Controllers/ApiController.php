<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
class ApiController extends Controller
{


    public function update_dark_mode_session(Request $request){

        if($request->mode=='night')
        {
            session([ 'mode' => 'night' ]);
            return 'done';
        }
        else
        {
            session([ 'mode' => 'day' ]);
            return 'done';
        }
        return 'failed';
    }


    public static function get_content(){

        if(null === (session('language'))){
            session(['language'=>'ar']);
        }  
        if(null === (session('popup_status'))){
            session(['popup_status'=>'true']);
        }
 
        if(null === (session('header_status'))){
            session(['intro_status'=>'true']);
        }
        if(null === (session('mode'))){
            session(['mode'=>'day']);
        }


         $temp = (array)json_decode(file_get_contents('https://dash.devlab.ae/api/v1/site/'.env('APP_URL')));
         return $temp;
    }
    public function set_init_sessions(){
        if(null === (session('language'))){
            session(['language'=>env('DEFAULT_LANGUAGE')]);
        }  
        if(null === (session('popup_status'))){
            session(['popup_status'=>'true']);
        }
 
        if(null === (session('header_status'))){
            session(['intro_status'=>'true']);
        }

    }
    public function turn_off_popup(){
         session(['popup_status'=>'false']);
    }
    public function turn_off_header(){
         session(['header_status'=>'false']);
    }
    public function switch_language(){ 
        if(null === (session('language'))){
            session(['language'=>'ar']);
        }  
        if(session('language') =="ar")
            session(['language'=>'en']);
        else
            session(['language'=>'ar']);

        app()->setLocale(session('language'));

        return redirect()->route('index');
    }
}
    