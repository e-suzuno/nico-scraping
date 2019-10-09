<?php

namespace App\Models;


use App\Constants\TagConstant;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

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
 * @property double update_speed
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
        'update_speed' => 'double',
    ];

    protected $appends = [
        'url', 'has_tags', 'eta'
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
     * 休止の予感(エタっているかどうか)
     * @return bool
     */
    public function getEtaAttribute()
    {
        if (in_array(TagConstant::COMPLETE, $this->tags_json))
            return false;
        if ($this->update_speed === 0) {
            return false;
        }
        if ($this->update_speed <= 10) {
            $padding_dya = 10;
            $padding_reta = 1;
        } else {
            $padding_dya = 1;
            $padding_reta = 1.5;
        }

        $day = Carbon::create($this->comic_update_date);
        $day->addDay(floor($this->update_speed * $padding_reta) + $padding_dya);
        $now = Carbon::now();
        return $now->gt($day);
    }



    /**
     * @return mixed
     */
    public function hasTags()
    {
        return Tag::whereIn("id", $this->tags_json)->get();
    }

}


