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
	 * 设置属性
	 * ---------------------------------
	 * @param String $name 名称
	 * @param Mixed $value 内容
	 * ------------------------
	 * @throws InvalidCallException|UnknownPropertyException
	 * @author Verdient。
	 */
	public function __set($name, $value){
		$setter = 'set' . $name;
		if(method_exists($this, $setter)){
			$this->$setter($value);
		}else if(method_exists($this, 'get' . $name)){
			throw new InvalidCallException('Setting read-only property: ' . get_class($this) . '::' . $name);
		}else{
			throw new UnknownPropertyException('Setting unknown property: ' . get_class($this) . '::' . $name);
		}
	}

	/**
	 * __get(String $name)
	 * 获取属性
	 * -------------------
	 * @param String $name 名称
	 * ------------------------
	 * @throws InvalidCallException|UnknownPropertyException
	 * @return Mixed
	 * @author Verdient。
	 */
	public function __get($name){
		$getter = 'get' . $name;
		if(method_exists($this, $getter)){
			return $this->$getter();
		}elseif (method_exists($this, 'set' . $name)){
			throw new InvalidCallException('Getting write-only property: ' . get_class($this) . '::' . $name);
		}
		throw new UnknownPropertyException('Getting unknown property: ' . get_class($this) . '::' . $name);
	}

	/**
	 * __isset(String $name)
	 * 是否存在
	 * ---------------------
	 * @param String $name 名称
	 * ------------------------
	 * @return Boolean
	 * @author Verdient。
	 */
	public function __isset($name){
		$getter = 'get' . $name;
		if(method_exists($this, $getter)){
			return $this->$getter() !== null;
		}
		return false;
	}

	/**
	 * __unset($name)
	 * 移除元素
	 * --------------
	 * @throws InvalidCallException
	 * @author Verdient。
	 */
	public function __unset($name){
		$setter = 'set' . $name;
		if(method_exists($this, $setter)){
			$this->$setter(null);
		}elseif(method_exists($this, 'get' . $name)){
			throw new InvalidCallException('Unsetting read-only property: ' . get_class($this) . '::' . $name);
		}
	}

	/**
	 * __call()
	 * 调用成员方法
	 * ----------
	 * @throws UnknownMethodException
	 * @author Verdient。
	 */
	public function __call($name, $params){
		throw new UnknownMethodException('Calling unknown method: ' . get_class($this) . "::$name()");
	}
}