<?php
require '../vendor/autoload.php';

class MemeModel
{
    protected $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
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

    }
}
?>