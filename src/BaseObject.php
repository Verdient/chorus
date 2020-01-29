<?php
namespace chorus;

/**
 * BaseObject
 * 基础对象
 * ----------
 * @author Verdient。
 */
class BaseObject implements Configurable
{
	/**
	 * __construct([Array $config = []])
	 * 构造函数
	 * ---------------------------------
	 * @param Array $config 配置信息
	 * ----------------------------
	 * @author Verdient。
	 */
	public function __construct($config = []){
		if(!empty($config)){
			foreach($config as $name => $value){
				$this->$name = $value;
			}
		}
		$this->init();
	}

	/**
	 * init()
	 * 初始化
	 * ------
	 * @author Verdient。
	 */
	public function init(){

	}

	/**
	 * __set(String $name, Mixed $value)
	 * 设置魔术方法
	 * ---------------------------------
	 * @param String $name 名称
	 * @param Mixed $value 内容
	 * ------------------------
	 * @author Verdient。
	 */
	public function __set($name, $value){
		throw new \Exception('Setting unknown property: ' . get_class($this) . '::' . $name);
	}
}