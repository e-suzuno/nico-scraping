<?php

namespace App\Repositories\NicoComic;

use App\Models\NicoComic;

class NicoComicRepository implements NicoComicRepositoryInterface
{

    /**
     * @var NicoComic
     */
    protected $nicoComic;


    public function __construct(NicoComic $nicoComic)
    {
        $this->nicoComic = $nicoComic;
    }

    public function getAll()
    {
        return $this->nicoComic->all();
    }


    public function getMaxNicoNo()
    {
        return $this->nicoComic->max('nico_no');
    }


    /**
     * @param $array
     * @return mixed
     */
    public function find($array = [])
    {
        $query = $this->nicoComic->select("*");
        if (isset($array['title']) && $array['title'] !== "") {
            $query->where('title', 'LIKE', '%' . $array['title'] . '%');
        }

        if (isset($array['description']) && $array['description'] !== "") {


            $array_description =explode(" ", $array['description']);
            foreach ($array_description as $_description)
                $query->where('description', 'LIKE', '%' . $_description . '%');


        }

        if (isset($array['tags']) && count($array['tags']) > 0) {
            $query->whereJsonContains('tags_json', array_map('intval', $array['tags']));
        }


        if (isset($array['story_number_from']) && $array['story_number_from'] > 0) {
            $query->where('story_number', '>=', $array['story_number_from']);
        }

        if (isset($array['nico_no_from']) && $array['nico_no_from'] > 0) {
            $query->where('nico_no', '>=', $array['nico_no_from']);
        }
        if (isset($array['nico_no_to']) && $array['nico_no_to'] > 0) {
            $query->where('nico_no', '<=', $array['nico_no_to']);
        }



        return $query;
    }

    public function findById(int $id)
    {
        return $this->nicoComic->where('id', $id)->first();
    }


    public function findByNicoNo(int $nico_no)
    {
        return $this->nicoComic->where('nico_no', $nico_no)->first();
    }


    /**
     * @param $attribute
     * @return NicoComic
     */
    public function create($attribute)
    {
        $model = new nicoComic();
        $model->fill($attribute)->save();
        return $model;
    }


    /**
     * @param int $id
     * @param $attribute
     * @return mixed
     */
    public function update(int $id, $attribute)
    {
        $model = $this->findById($id);
        $model->fill($attribute)->save();
        return $model;
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function destroy(int $id)
    {
        return $this->nicoComic->where("id", $id)->delete();
    }

}
