<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Storage;

class TinifyService
{

    private $client;

    private string $apiKey;


    public function __construct()
    {
        $this->apiKey = base64_encode(env('tinypng_key'));
        $this->client = new Client(['base_uri' => 'https://api.tinify.com/', 'headers' => ['Authorization' => "Basic $this->apiKey"]]);
    }


    public function compressAndSaveImage($image): false|string
    {
        $file = file_get_contents($image->getPathname());

        $comporess = $this->client->post('/shrink', ['body' => $file]);

        if ($comporess->getStatusCode() != 201) {
            return false;
        }

        $file = $this->client->post($comporess->getHeaderLine('Location'), ['headers' => ['Content-Type' => 'application/json'], 'json' => ['resize' => ['method' => 'fit', 'width' => 70, 'height' => 70]]]);

        if ($file->getStatusCode() == 200) {
            $filename = uniqid() . '.' . $image->extension();

            $storage = Storage::put('public/images/users/' . $filename, $file->getBody()->getContents());

            return $storage ? $filename : false;
        }

        return false;
    }
}
