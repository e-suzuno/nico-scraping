<?php

namespace App\Constants;

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


    const NAMES = [
        self::COMPLETE => "完結済み",
        self::UNKNOWN => "",
        self::HIBERNATE => "休止状態",
        self::NONE => "",
    ];


}
