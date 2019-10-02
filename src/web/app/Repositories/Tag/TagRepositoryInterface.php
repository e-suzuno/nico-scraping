<?php

namespace App\Repositories\Tag;

interface TagRepositoryInterface
{
    public function getAll();

    public function find();

    public function findById(int $id);

    public function findByLabel(string $label);

    public function create($attribute);

    public function destroy(int $id);
}
