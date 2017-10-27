<?php
namespace Alpacamybags\Memedb;

class Meme
{
    protected $id;
    protected $name;
    protected  $dateCreated;
    protected  $imageUrl;

    public function __construct(){}

    public static function Fill($meme)
    {
        $instance = new self();
        $instance->setID($meme["id"]);
        $instance->setName($meme["name"]);
        $instance->setDateCreated($meme["datecreated"]);
        $instance->setImageUrl($meme["imageurl"]);


        return $instance;

    }

    public function getID()
    {
        return $this->id;
    }

    public function setID($id)
    {
        $this->id = $id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getDateCreated()
    {
        return $this->dateCreated;
    }

    public function setDateCreated($dateCreated)
    {
        $this->dateCreated = $dateCreated;
    }

    public function getImageUrl()
    {
        return $this->imageUrl;
    }

    public function setImageUrl($imageUrl)
    {
        $this->imageUrl = $imageUrl;
    }
}
?>