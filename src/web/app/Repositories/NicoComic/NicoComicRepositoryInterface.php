<?php

namespace App\Repositories\NicoComic;

interface NicoComicRepositoryInterface
{
    public function getAll();


    public function getMaxNicoNo();


    public function find($array = []);

    public function findById(int $id);

    public function findByNicoNo(int $nico_no);

    public function create($attribute);

    public function update(int $id, $attribute);

    public function destroy(int $id);
}
