<?php
namespace chorus;

/**
 * StringHelper
 * 字符串助手
 * ------------
 * @author Verdient。
 */
class StringHelper
{
	/**
	 * dirname(String $path)
	 * 文件夹名称
	 * ---------------------
	 * @param String $path 路径
	 * -----------------------
	 * @return String
	 * @author Verdient。
	 */
	public static function dirname($path){
		$pos = mb_strrpos(str_replace('\\', '/', $path), '/');
		if($pos !== false){
			return mb_substr($path, 0, $pos);
		}
		return '';
	}

	/**
	 * basename(String $path[, String $suffix = ''])
	 * 文件名
	 * ---------------------------------------------
	 * @param String $path 路径
	 * @param String $suffix 后缀名
	 * ---------------------------
	 * @author Verdient。
	 */
	public static function basename($path, $suffix = ''){
		if(($len = mb_strlen($suffix)) > 0 && mb_substr($path, -$len) === $suffix) {
			$path = mb_substr($path, 0, -$len);
		}
		$path = rtrim(str_replace('\\', '/', $path), '/\\');
		if(($pos = mb_strrpos($path, '/')) !== false){
			return mb_substr($path, $pos + 1);
		}
		return $path;
	}
}