<?php

namespace App\Models;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class NicoComic
 * @package App\Models
 *
 *
 * @property integer id
 * @property string title
 * @property string author
 * @property string description
 * @property json|array tags_json
 * @property integer nico_no
 * @property integer story_number
 * @property Carbon comic_start_date
 * @property Carbon comic_update_date
 * @property Carbon created_at
 * @property Carbon updated_at
 * @property string url
 * @property array tag_labels
 *
 */
class NicoComic extends Model
{
    //

    protected $casts = [
        'tags_json' => 'json',
    ];

    protected $appends = [
        'url', 'has_tags'
    ];

    protected $guarded = [''];


    /**
     * @return string
     */
    public function getUrlAttribute()
    {
        return comic_url($this->nico_no);
    }

    /**
     * @return array
     */
    public function getHasTagsAttribute()
    {
        return $this->hasTags();
    }


    /**
     * @return mixed
     */
    public function hasTags()
    {
        return Tag::whereIn("id", $this->tags_json)->get();
    }

}


