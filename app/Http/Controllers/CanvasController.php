<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SocialMedia;


class CanvasController extends Controller   // My epic <iframe>, <object>, <embed> workaround.
{                                           // God bless our gracius CURL.

    public function renderCanvas(Request $request) {
        if (isset($request->url)) {
            if (!(strpos($request->url, 'discord') || strpos($request->url, 'linkedin'))) {
                $CURL = curl_init($request->url);

                curl_setopt_array($CURL, array(
                    CURLOPT_SSL_VERIFYPEER => false,
                    CURLOPT_VERBOSE        => true,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_USERAGENT      => 'Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:60.0) Gecko/20100101 Firefox/60.0',
                    CURLOPT_ENCODING       => 'gzip, deflate',
                    CURLOPT_HTTPHEADER     => array(
                            'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
                            'Accept-Language: en-US,en;q=0.5',
                            'Connection: keep-alive',
                            'Upgrade-Insecure-Requests: 1',
                    ),
                ));
    
                $DOMData = curl_exec($CURL);
                curl_close($CURL);
    
                return view('canvas')->with(['DOMData' => strlen($DOMData) ? $DOMData : file_get_contents($request->url)]);
            } else {
                return view('canvas')->with(['mock' => SocialMedia::where('url', $request->url)->first()->name]);
            }
        }

        return redirect()->route('home');
    }

    public function redirectUrl(string $media_name, string $url) {
        $media = SocialMedia::where('name', $media_name)->first();

        return isset($media) ? CanvasController::renderCanvas(
            new Request(['url' => $media->url . "$url"])) : die;
    }

}
