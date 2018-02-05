<?php
namespace App\Services;
use GuzzleHttp\Client;

class Address
{
    public function extract($address)
    {
        $client = new Client(); //GuzzleHttp\Client
        $url = "https://us-extract.api.smartystreets.com/?auth-id=".env('SS_AUTH_ID').'&auth-token='.env('SS_AUTH_TOKEN');
        $body = \GuzzleHttp\Psr7\stream_for($address);
        $res = $client->post($url,['body' => $body]);
        $content = json_decode($res->getBody()->getContents());
        if($content->meta->verified_count == 1){
            return $content->addresses[0]->api_output[0];
        }
        return false;
    }
}