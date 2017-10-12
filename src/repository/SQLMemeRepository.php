<?php
namespace "Alpacamybags/Memedb/repository";

class SQLMemeRepository implements MemeRepositoryInterface
{
    protected $db;

    public function __construct(PDO $db = null)
    {
        $this->db = $db;

        if ($this->db == null)
        {
            $this->db = new PDO(
                'mysql:host=localhost;dbname=memedb;port=3306',
                'root',
                '123456'
            );

            $this->db->setAttribute(
                PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION
            );
        }
    }

    public function getAll()
    {
        $statement = $this->db->prepare('SELECT * FROM MEME');
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_CLASS,'Meme');

        return $statement->fetchAll();
    }

    public function find($id)
    {
        $statement = $this->db->prepare();
    }

    public function save(Meme $meme)
    {
        $statement = $this->db->prepare('INSERT INTO meme (name,datecreated,imageurl) VALUES (:name,:datecreated,:imageurl)');
        $statement->bindParam(':name',$meme->getName(),PDO::PARAM_STR);
        $statement->bindParam(':datecreated',$meme->getDateCreated(),PDO::PARAM_STR);
        $statement->bindParam(':imageurl',$meme->getImageUrl(),PDO::PARAM_STR);

        $statement->execute();

    }
}