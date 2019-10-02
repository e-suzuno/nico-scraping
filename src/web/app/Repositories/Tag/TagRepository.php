<?php

namespace App\Repositories\Tag;

use App\Models\Tag;


class TagRepository implements TagRepositoryInterface
{


    /**
     * @var Tag
     */
    protected $tag;


    public function __construct(Tag $tag)
    {
        $this->tag = $tag;
    }

    public function getAll()
    {
        return $this->tag->all();
    }


    public function find($per_page = null)
    {
        return $this->tag;
    }

    public function findById(int $id)
    {
        return $this->tag->where('id', $id)->first();
    }


    public function findByLabel(string $label)
    {
        return $this->tag->where('label', $label)->first();
    }


    /**
     * @param $attribute
     * @return Tag
     */
    public function create($attribute)
    {
        $tag = new Tag();
        $tag->fill($attribute)->save();
        return $tag;
    }

    public function destroy(int $id)
    {
        return $this->tag->where("id", $id)->delete();
    }

}
