<?php
include('../vendor/autoload.php');
include('../classes/meme.php');
include('../classes/imgurhelper.php');
include('../repository/SQLMemeRepository.php');

//create the meme object. can only set name for the time being
$image= file_get_contents($_FILES['image']['tmp_name']);
$data = base64_encode($image);
$meme = new Meme();
$meme->setName(filter_input(INPUT_POST,"name",FILTER_SANITIZE_STRING));

//upload image and get the resulting url
$response = ImgurHelper::UploadImage($data);
$imageurl = $response->{'data'}->{'link'};
$meme->setImageUrl($imageurl);

$meme->setDateCreated(date('Y-m-d H:i:s'));

$repo = new SQLMemeRepository();
$repo->save($meme);

header('Location:index.html');

?>