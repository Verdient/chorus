<?php
namespace chorus;

/**
 * ArrayHelper
 * 数组助手
 * -----------
 * @author Verdient。
 */
class ArrayHelper
{
	/**
	 * isIndexed(Array $array)
	 * 是否是索引数组
	 * -----------------------
	 * @param Array $array 数组
	 * -----------------------
	 * @return Boolean
	 * @author Verdient。
	 */
	public static function isIndexed(Array $array){
		if(empty($array)){
			return true;
		}
		return array_keys($array) === range(0, count($array) - 1);
	}

	/**
	 * isAssociative(Array $array)
	 * 是否是关联数组
	 * ---------------------------
	 * @param Array $array 数组
	 * -----------------------
	 * @return Boolean
	 * @author Verdient。
	 */
	public static function isAssociative(Array $array){
		return !static::isIndexed($array);
	}

	/**
	 * merge(...$args)
	 * 合并数组
	 * ---------------
	 * @return Array
	 * @author Verdient。
	 */
	public static function merge(...$args){
		$res = array_shift($args);
		while(!empty($args)){
			foreach(array_shift($args) as $k => $v){
			if(is_int($k)){
					if(array_key_exists($k, $res)){
						$res[] = $v;
					}else{
						$res[$k] = $v;
					}
				}elseif(is_array($v) && isset($res[$k]) && is_array($res[$k])) {
					$res[$k] = static::merge($res[$k], $v);
				}else{
					$res[$k] = $v;
				}
			}
		}
		return $res;
	}
}