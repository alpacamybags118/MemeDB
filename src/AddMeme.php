<?php

namespace Alpacamybags\Memedb;
use Alpacamybags\Memedb\Repository\MemeRepositoryInterface;
use Alpacamybags\Memedb\Repository\SQLMemeRepository;
use Slim\Http\Request;
use Slim\Http\Response;

class AddMeme
{
    private $meme;
    private $repository;

    public function __construct(MemeRepositoryInterface $interface)
   {
       $this->meme = new Meme();
       $this->interface = $interface;
   }

   public function Add(Request $request)
   {
       $response = new Response();

       #get the uploaded picture
        $image = $request->getUploadedFiles('image')['image'];

        if($image == null)
        {
            $response = $response->withStatus('400',"No uploaded image was found");
            return $response;
        }

        #prepare the image and upload
       $imageData = base64_encode($image->getStream());
       $uploadedImage = ImgurHelper::UploadImage($imageData);

       #make sure it actually uploaded
       if($uploadedImage == null || $uploadedImage->{'success'} != "true" || $uploadedImage->{'status'} != '200')
       {
           $response = $response->withStatus('500',"Imgur upload failed");
           $response = $response->getBody()->write($uploadedImage);
           return $response;
       }

       #prepare meme to be saved
       $this->meme->setName($request->getParsedBody()['name']);
       $this->meme->setImageUrl($uploadedImage->{'data'}->{'link'});
       $this->meme->setDateCreated(date('Y-m-d H:i:s'));

       #now save
       $this->repository = new SQLMemeRepository();
       $this->repository->save($this->meme);

       return $response;
   }
}