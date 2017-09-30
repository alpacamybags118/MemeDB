<?php
interface MemeRepositoryInterface
{
    public function getAll();
    public function find($id);
    public function save(Meme $meme);
}