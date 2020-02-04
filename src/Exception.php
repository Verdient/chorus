<?php
namespace chorus;

/**
 * Exception
 * 异常
 * ---------
 * @author Verdient。
 */
class Exception extends \Exception
{
	/**
	 * setFile(String $file)
	 * 设置文件
	 * ---------------------
	 * @author Verdient。
	 */
	public function setFile($file){
		$this->file = $file;
	}

	/**
	 * setLine(Integer $line)
	 * 设置行号
	 * ----------------------
	 * @param Integer $line
	 * @author Verdient。
	 */
	public function setLine($line){
		$this->line = $line;
	}
}
