<?php

namespace App\Constants;

/**
 * Class EtaLabelConstant
 * @package App\Constants
 */
class EtaLabelConstant
{

    /**
     * 完結済み
     */
    const COMPLETE = 1;


    /**
     * 不明
     */
    const UNKNOWN = 2;


    /**
     * 休止状態
     */
    const HIBERNATE = 3;


    /**
     * 無し
     */
    const NONE = 4;


    const LABELS = [
        self::COMPLETE => "完結済み",
        self::UNKNOWN => "",
        self::HIBERNATE => "休止状態",
        self::NONE => "",
    ];


    /**
     * @return array
     */
    public static function getLabels()
    {
        return self::LABELS;
    }

    /**
     * @param $key
     * @return mixed
     * @throws \Exception
     */
    public static function getLabel($key)
    {
        if (!isset(self::getLabels()[$key])) {
            throw new \Exception(get_called_class() . ' 設定されていない key:' . $key . 'にアクセスされました。');
        }
        return self::getLabels()[$key];
    }


}
