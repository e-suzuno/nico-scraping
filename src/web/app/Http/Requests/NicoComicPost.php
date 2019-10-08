<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NicoComicPost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "word" => "nullable|string",
            "nico_no" => "nullable|integer",
            "nico_no_from" => "nullable|integer",
            "nico_no_to" => "nullable|integer",
            "story_number_from" => "nullable|integer",
            "comic_update_date_from" => "nullable|date",
            "comic_update_date_to" => "nullable|date",
            "order" => "nullable|string",
            "tags.*", "nullable|integer",
            "exclusionList.*", "nullable|integer",
        ];
    }
}
