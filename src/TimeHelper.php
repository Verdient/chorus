<?php
namespace chorus;

/**
 * TimeHelper
 * 时间助手
 * ----------
 * @author Verdient。
 */
class TimeHelper
{
	/**
	 * timestamp(Boolean [$millisecond = false])
	 * 时间戳
	 * -----------------------------------------
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