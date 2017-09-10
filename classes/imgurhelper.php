<?php
require '../vendor/autoload.php';

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

        $image = ImgurHelper::GetImageEncoding($image);

        //make the http request
        $request = curl_init(self::IMGURAPIURI."/image");
        curl_setopt(
            $request,
            CURLOPT_HTTPHEADER,
            array(
                "authorization: Client-ID id here",
                'content-type: multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW'
            )
        );
        curl_setopt($request,CURLOPT_POST,true);
        curl_setopt(
            $request,
            CURLOPT_POSTFIELDS,
            array(
                'image' => $image
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

    private static function GetImageEncoding($image)
    {
        $imagedata = file_get_contents(realpath($image));
        $base64 = base64_encode($imagedata);

        return $base64;
    }
}