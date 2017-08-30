<?php
require '../vendor/autoload.php';

class ImgurHelper
{
    const IMGURAPIURI = 'https://api.imgur.com/3';

    public function __construct(){}

    public static function UploadImage($image)
    {
        if($image = null)
        {
            return null;
        }

        //make the http request
        $request = curl_init(self::IMGURAPIURI."/image");
        curl_setopt($request,CURLOPT_POST,true);
        curl_setopt(
            $request,
            CURLOPT_POSTFIELDS,
            array(
                'image' => '@' . realpath($image)
            )
        );

        try
        {
            curl_setopt($request,CURLOPT_RETURNTRANSFER,true);
            $response = curl_exec($request);
        }
        catch (HttpException $ex)
        {
            //should log this as well, but this is a meme site
            return null;
        }

        return $response;
    }
}