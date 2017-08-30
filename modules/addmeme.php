<?php
require '../vendor/autoload.php';
require '../classes/meme.php';
require "../classes/imgurhelper.php";

//create the meme object. can only set name for the time being
$meme = new Meme();
$meme->setName($_POST["name"]);
ImgurHelper::UploadImage($_POST["image"]);
?>