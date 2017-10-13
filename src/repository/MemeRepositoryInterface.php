<?php
namespace Alpacamybags\Memedb\Repository;
use Alpacamybags\Memedb\Meme;

interface MemeRepositoryInterface
{
    public function getAll();
    public function find($id);
    public function save(Meme $meme);
}