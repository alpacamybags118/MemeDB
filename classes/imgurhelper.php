<?php
require '../vendor/autoload.php';
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
$keys = require('../configs/api_keys.php');

class ImgurHelper
{
    const IMGURAPIURI = 'https://api.imgur.com/3';

    public function __construct(){}

    public static function UploadImage($image)
    {
        if($image == null)
        {
            return null;
        }
        //create the client
        $client = new Client([
            'base_uri' => 'https://api.imgur.com'
        ]);


        try
        {
            $request = $client->request('POST','3/image',[
                'headers' => [
                    "authorization" => "Client-ID " . '$(imgurapi)',
                ],
                "form_params" => [
                    'image' => $image
                ]
            ]);

            $response = $request->getBody()->getContents();
        }
        catch (HttpException $ex)
        {
            //should log this as well, but this is a meme site
            return null;
        }

        return json_decode($response);
    }

}