<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use GuzzleHttp;


class AuthorizationController extends Controller
{
    public function authorize_access(Request $request){
        if($request->has('code') && $request->has('state') && $request->state == env('SPOTIFY_ACCESS_STATE', getenv('SPOTIFY_ACCESS_STATE'))){
            $code = $request->code;
            
            return redirect()->action('AuthorizationController@get_access', compact('code'));
        }

        return redirect()->action('AuthorizationController@get_access');
    }

    public static function get_access(Request $request){
        $access_token = Cookie::get('spotify_access_token');
        $refresh_token = Cookie::get('spotify_refresh_token');
        $spotify_access_code = Cookie::get('spotify_access_code');

        if($request->has('code') && $spotify_access_code === null){
            $code = $request->code;

            $spotify_access_code = Cookie::forever('spotify_access_code', $code);

            $response = self::get_access_token($code, 'authorization_code');

            if($response->getStatusCode() == 200){
                $data = json_decode($response->getContent());

                $access_token = Cookie::forever('spotify_access_token', $data->access_token);
                $refresh_token = Cookie::forever('spotify_refresh_token', $data->refresh_token);
            }

        }

        return redirect()->action('PagesController@better_release_radar')
            ->withCookie($spotify_access_code)
            ->withCookie($access_token)
            ->withCookie($refresh_token);
    }

    public static function refresh_access(){
        $response = self::get_access_token(null, 'refresh_token');
        
        if($response->getStatusCode() == 200){
            $data = json_decode($response->getContent());
            return $data->access_token;
        }
        
        return false;
    }

    private static function get_access_token($spotify_access_code, $grant_type){
        
        $client_id = env('SPOTIFY_APP_CLIENT_ID', getenv('SPOTIFY_APP_CLIENT_ID'));
        $client_secret = env('SPOTIFY_APP_CLIENT_SECRET', getenv('SPOTIFY_APP_CLIENT_SECRET'));

        $form_params = [
            'grant_type' => $grant_type
        ];

        if($spotify_access_code !== null){
            $form_params['code'] = $spotify_access_code;
            $form_params['redirect_uri'] = env('APP_URL', getenv('APP_URL')) . ':8000/authorize_access';
        }

        if($grant_type == 'refresh_token'){
            $form_params['refresh_token'] = Cookie::get('spotify_refresh_token');
        }

        $client = new GuzzleHttp\Client();
        $request = $client->post('https://accounts.spotify.com/api/token', [
            'form_params' => $form_params,
            'headers' => [
                'Content-type' => 'application/x-www-form-urlencoded',
                'Authorization' => 'Basic ' . base64_encode( $client_id . ":" . $client_secret )
            ]
        ]);

        $responseStatus = $request->getStatusCode();
        $response = json_decode($request->getBody());
        
        return response()->json($response, $responseStatus);
    }
}
