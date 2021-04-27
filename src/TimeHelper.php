<?php

declare(strict_types=1);

namespace chorus;

/**
 * 时间助手
 * @author Verdient。
 */
class TimeHelper
{
    /**
     * 时间戳
     * @return int
     * @author Verdient。
     */
    public static function timestamp($millisecond = false){
        if($millisecond === true){
            $time = explode(' ', microtime());
            $time[0] = substr(str_replace('0.', '', $time[0]), 0, 6);
            return $time[1] . $time[0];
        }
        return time();
    }
}