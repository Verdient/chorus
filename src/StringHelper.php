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

	/**
	 * trimNumber(String $value)
	 * 清理数字的空格
	 * -------------------------
	 * @param String $value 内容
	 * -------------------------
	 * @return String
	 * @author Verdient。
	 */
	public static function trimNumber($value){
		if(mb_substr($value, 0, 1) === '0'){
			$value = mb_substr($value, 1);
			return static::trimNumber($value);
		}
		return $value;
	}

	/**
	 * binToHex64(String $value)
	 * 二进制转64进制
	 * -------------------------
	 * @param String $value 待转换的值
	 * -----------------------------
	 * @return String
	 * @author Verdient。
	 */
	public static function binToHex64($value){
		$length = mb_strlen($value);
		for($i = 0; $i < $length; $i++){
			$v = mb_substr($value, 1, 1);
			if($v !== '0' && $v !== '1'){
				return false;
			}
		}
		$fixed = $length % 6;
		if($fixed > 0){
			$diff = 6 - $fixed;
			$value = str_repeat('0', $diff) . $value;
			$length += $diff;
		}
		$position = $length;
		$result = '';
		$map = [
			'000000' => '0',
			'000001' => '1',
			'000010' => '2',
			'000011' => '3',
			'000100' => '4',
			'000101' => '5',
			'000110' => '6',
			'000111' => '7',
			'001000' => '8',
			'001001' => '9',
			'001010' => 'a',
			'001011' => 'b',
			'001100' => 'c',
			'001101' => 'd',
			'001110' => 'e',
			'001111' => 'f',
			'010000' => 'g',
			'010001' => 'h',
			'010010' => 'i',
			'010011' => 'j',
			'010100' => 'k',
			'010101' => 'l',
			'010110' => 'm',
			'010111' => 'n',
			'011000' => 'o',
			'011001' => 'p',
			'011010' => 'q',
			'011011' => 'r',
			'011100' => 's',
			'011101' => 't',
			'011110' => 'u',
			'011111' => 'v',
			'100000' => 'w',
			'100001' => 'x',
			'100010' => 'y',
			'100011' => 'z',
			'100100' => 'A',
			'100101' => 'B',
			'100110' => 'C',
			'100111' => 'D',
			'101000' => 'E',
			'101001' => 'F',
			'101010' => 'G',
			'101011' => 'H',
			'101100' => 'I',
			'101101' => 'J',
			'101110' => 'K',
			'101111' => 'L',
			'110000' => 'M',
			'110001' => 'N',
			'110010' => 'O',
			'110011' => 'P',
			'110100' => 'Q',
			'110101' => 'R',
			'110110' => 'S',
			'110111' => 'T',
			'111000' => 'U',
			'111001' => 'V',
			'111010' => 'W',
			'111011' => 'X',
			'111100' => 'Y',
			'111101' => 'Z',
			'111110' => '_',
			'111111' => '@'
		];
		while($position > 0){
			$position -= 6;
			$bin = mb_substr($value, $position, 6);
			$result = $map[$bin] . $result;
		}
		return static::trimNumber($result);
	}

	/**
	 * hex64ToBin(String $value)
	 * 64进制转二进制
	 * -------------------------
	 * @param String $value 待转换的值
	 * ------------------------------
	 * @return String
	 * @author Verdient。
	 */
	public static function hex64ToBin($value){
		$map = [
			'0' => '000000',
			'1' => '000001',
			'2' => '000010',
			'3' => '000011',
			'4' => '000100',
			'5' => '000101',
			'6' => '000110',
			'7' => '000111',
			'8' => '001000',
			'9' => '001001',
			'a' => '001010',
			'b' => '001011',
			'c' => '001100',
			'd' => '001101',
			'e' => '001110',
			'f' => '001111',
			'g' => '010000',
			'h' => '010001',
			'i' => '010010',
			'j' => '010011',
			'k' => '010100',
			'l' => '010101',
			'm' => '010110',
			'n' => '010111',
			'o' => '011000',
			'p' => '011001',
			'q' => '011010',
			'r' => '011011',
			's' => '011100',
			't' => '011101',
			'u' => '011110',
			'v' => '011111',
			'w' => '100000',
			'x' => '100001',
			'y' => '100010',
			'z' => '100011',
			'A' => '100100',
			'B' => '100101',
			'C' => '100110',
			'D' => '100111',
			'E' => '101000',
			'F' => '101001',
			'G' => '101010',
			'H' => '101011',
			'I' => '101100',
			'J' => '101101',
			'K' => '101110',
			'L' => '101111',
			'M' => '110000',
			'N' => '110001',
			'O' => '110010',
			'P' => '110011',
			'Q' => '110100',
			'R' => '110101',
			'S' => '110110',
			'T' => '110111',
			'U' => '111000',
			'V' => '111001',
			'W' => '111010',
			'X' => '111011',
			'Y' => '111100',
			'Z' => '111101',
			'_' => '111110',
			'@' => '111111'
		];
		$length = mb_strlen($value);
		$result = '';
		$position = $length;
		while($position > 0){
			$position -= 1;
			$v = mb_substr($value, $position, 1);
			if(!isset($map[$v])){
				return false;
			}
			$bin = $map[$v];
			$result = $bin . $result;
		}
		return static::trimNumber($result);
	}
}