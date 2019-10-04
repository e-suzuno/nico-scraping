<?php

namespace App\Repositories\NicoComic;

use App\Constants\TagTypeConstant;
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
            $array_description = explode(" ", $array['description']);
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


    /**
     * @param int $id
     * @return NicoComic|NULL
     */
    public function findById(int $id)
    {
        return $this->nicoComic->where('id', $id)->first();
    }


    /**
     * @param int $nico_no
     * @return NicoComic|NULL
     */
    public function findByNicoNo(int $nico_no)
    {
        return $this->nicoComic->where('nico_no', $nico_no)->first();
    }


    /**
     * @param $no
     * @param $tag_id
     * @return bool     false コミックが見つからない、タグがすでに追加済みだと失敗
     */
    public function addTag($no, $tag_id)
    {
        $nicoComic = $this->findByNicoNo($no);
        if (!$nicoComic) {
            return false;
        }

        $tags_json = $nicoComic->tags_json;
        if (in_array($tag_id, $tags_json)) {
            return false;
        }
        $tags_json[] = $tag_id;

        $data = ['tags_json' => $tags_json];
        $this->update($nicoComic->id, $data);
        return true;
    }


    /**
     * スレイピングデータを受け取って保存
     * @param $data
     */
    public function save($data)
    {

        $tags = [];
        $tags[] = getTagId($data['category'], TagTypeConstant::CATEGORY);
        $tags[] = getTagId($data['official_title'], TagTypeConstant::OFFICIAL_COMIC);
        //文章からのオートタグ
        $auto_tags = autoTagCheck($data['title'], $data['description']);
        foreach ($auto_tags as $auto_tag) {
            $tags[] = $auto_tag;
        }
        $data['tags_json'] = $tags;


        $attribute = collect($data)->only([
            "title",
            "author",
            "description",
            "nico_no",
            "comic_start_date",
            "comic_update_date",
            "story_number",
            "tags_json"
        ])->toArray();
        $nicoComic = $this->findByNicoNo($attribute["nico_no"]);
        if ($nicoComic) {
            //更新
            $this->update($nicoComic->id, $attribute);
        } else {
            //新規作成
            $this->create($attribute);
        }
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
