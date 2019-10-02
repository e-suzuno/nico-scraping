<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * Class NicoComic
 * @package App\Models
 */
class NicoComic extends Model
{
    //

    protected $casts = [
        'tags_json' => 'json',
    ];

    protected $guarded = [''];


    /**
     * @return mixed
     */
    public function hasTags()
    {
        return Tag::whereIn("id", $this->tags_json)->get();
    }

}


