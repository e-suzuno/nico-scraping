<?php

namespace App\Services;


use App\Constants\TagTypeConstant;
use App\Repositories\Tag\TagRepositoryInterface;

class Tag
{

    /**
     * @var array
     */
    public $tagList;

    /**
     * @var TagRepositoryInterface
     */
    public $tagRepository;


    /**
     * @var array
     */
    public $auto_search_tags = [
        "異世界",
        "ファンタジー",
        "ロボット",
    ];


    /**
     *
     * Tag constructor.
     * @param TagRepositoryInterface $tagRepository
     */
    public function __construct(TagRepositoryInterface $tagRepository)
    {
        $this->tagRepository = $tagRepository;

        $tags = $this->tagRepository->getAll();
        $tagList = [];
        foreach ($tags as $tag) {
            $tagList[$tag->label] = $tag->id;
        }
        $this->setTagList($tagList);
    }




    /**
     * @return array
     */
    public function getTagList()
    {
        return $this->tagList;
    }

    /**
     * @param array $tagList
     */
    public function setTagList(array $tagList)
    {
        $this->tagList = $tagList;
    }


    /**
     * @param $label
     * @param $tag_type_id
     * @return mixed
     */
    public function getTagId($label, $tag_type_id)
    {
        $tagList = $this->getTagList();

        if (isset($tagList[$label])) {
            return $tagList[$label];
        } else {
            $tag = $this->tagRepository->create([
                'label' => $label,
                'tag_type_id' => $tag_type_id
            ]);

            $tagList[$tag->label] = $tag->id;
            $this->setTagList($tagList);

            return $tag->id;
        }
    }


    /**
     * 自動で付けるタグのリストを返す。
     *
     * @param $target_string
     * @return array
     */
    public function autoTagCheck($target_string)
    {
        $tags = [];
        foreach ($this->auto_search_tags as $label) {
            if (mb_strpos($target_string, $label, 0, "UTF-8") !== false) {
                $tags[] = getTagId($label, TagTypeConstant::AUTO_TAG);
            };
        }
        return $tags;
    }


}
