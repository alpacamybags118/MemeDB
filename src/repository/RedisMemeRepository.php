<?php
namespace Alpacamybags\Memedb\Repository;
use Alpacamybags\Memedb\Meme;
use Predis;

class RedisMemeRepository implements MemeRepositoryInterface
{
    protected $redisClient;

    public function __construct(Predis\Client $client = null)
    {
        try
        {
            if($client != null)
            {
                $this->redisClient = $client;
            }
            else
            {
                $this->redisClient = new Predis\Client();
            }

        }
        catch(Exception $e)
        {
            return $e;
        }
    }

    public function getAll()
    {
        $keys = $this->redisClient->keys("*");
        $memes = array();
        foreach($keys as $key)
        {
            array_push($memes,$this->find($key));
        }

        return $memes;
    }

    public function find($id)
    {

        $meme = array();
        $meme["id"] = $id;
        $meme["imageurl"] = $this->redisClient->get($id);

        return $meme;
    }

    public function save(Meme $meme)
    {
        $this->redisClient->set($meme->getID(),$meme->getImageUrl());
        $this->redisClient->expire($meme->getID(),120);
    }

    public function saveAll($memes)
    {
        foreach($memes as $meme)
        {
            $newMeme = Meme::Fill($meme);
            $this->save($newMeme);
        }
    }
}