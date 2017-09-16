<?php
include('../vendor/autoload.php');
include('../classes/meme.php');
include('../classes/imgurhelper.php');

//create the meme object. can only set name for the time being
$image= file_get_contents($_FILES['image']['tmp_name']);
$data = base64_encode($image);
$meme = new Meme();
$meme->setName($_POST["name"]);

//upload image and get the resulting url
$response = ImgurHelper::UploadImage($data);
$imageurl = $response->{'link'};
$meme->setImageUrl($imageurl);
?>