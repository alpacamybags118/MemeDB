<?php
include('../vendor/autoload.php');
include('../classes/meme.php');
include('../classes/imgurhelper.php');

//create the meme object. can only set name for the time being
$image = $_POST["image"];
$meme = new Meme();
$meme->setName($_POST["name"]);

ImgurHelper::UploadImage($image);
?>