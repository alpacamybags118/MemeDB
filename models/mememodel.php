<?php
require '../vendor/autoload.php';
include('../classes/meme.php');

class MemeModel
{
    protected $db;

    public function __construct(PDO $db)
    {
        $this->InitializeDB();
    }

    private function InitializeDB()
    {

    }

    public function getAllMemes()
    {
        return $this->db->query('SELECT * FROM meme');
    }

    public function getMeme($id)
    {
        return $this->db->query("SELECT * FROM meme WHERE id = '$id' ");
    }

    public function setMeme($meme)
    {
        $this->db->query("INSERT INTO meme (name,datecreated,imageurl) VALUES ('$meme->getName()','$meme->getDateCreated()','$meme->getImageUrl()')");
    }
}
?>