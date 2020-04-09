<?php
namespace chorus;

/**
 * BaseObject
 * 基础对象
 * ----------
 * @author Verdient。
 */
class BaseObject implements Configurable, EventInterface
{
	/**
	 * @var array 挂载的事件
	 * @author Verdient。
	 */
	protected $_events = [];

	/**
	 * 构造函数
	 * @param array $config 配置信息
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
	 * 初始化
	 * @author Verdient。
	 */
	public function init(){
		foreach($this->events() as $event => $handler){
			$this->on($event, is_string($handler) ? [$this, $handler] : $handler);
		}
	}

	/**
	 * 设置属性
	 * @param string $name 名称
	 * @param mixed $value 内容
	 * @throws InvalidCallException|UnknownPropertyException
	 * @author Verdient。
	 */
	public function __set($name, $value){
		$setter = 'set' . $name;
		if(method_exists($this, $setter)){
			$this->$setter($value);
		}else{
			if(method_exists($this, 'get' . $name)){
				$exception = new InvalidCallException('Setting read-only property: ' . get_class($this) . '::' . $name);
			}else{
				$exception = new UnknownPropertyException('Setting unknown property: ' . get_class($this) . '::' . $name);
			}
			$debug = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 1)[0];
			$exception->setFile($debug['file']);
			$exception->setLine($debug['line']);
			throw $exception;
		}
	}

	/**
	 * 获取属性
	 * @param string $name 名称
	 * @throws InvalidCallException|UnknownPropertyException
	 * @return mixed
	 * @author Verdient。
	 */
	public function __get($name){
		$getter = 'get' . $name;
		if(method_exists($this, $getter)){
			return $this->$getter();
		}else{
			if(method_exists($this, 'set' . $name)){
				$exception = new InvalidCallException('Getting write-only property: ' . get_class($this) . '::' . $name);
			}else{
				$exception = new UnknownPropertyException('Getting unknown property: ' . get_class($this) . '::' . $name);
			}
			$debug = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 1)[0];
			$exception->setFile($debug['file']);
			$exception->setLine($debug['line']);
			throw $exception;
		}
	}

	/**
	 * 是否存在
	 * @param string $name 名称
	 * @return bool
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
	 * 移除元素
	 * @param string $name 名称
	 * @throws InvalidCallException
	 * @author Verdient。
	 */
	public function __unset($name){
		$setter = 'set' . $name;
		if(method_exists($this, $setter)){
			$this->$setter(null);
		}elseif(method_exists($this, 'get' . $name)){
			$exception = new InvalidCallException('Unsetting read-only property: ' . get_class($this) . '::' . $name);
			$debug = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 1)[0];
			$exception->setFile($debug['file']);
			$exception->setLine($debug['line']);
			throw $exception;
		}
	}

	/**
	 * 调用成员方法
	 * @throws UnknownMethodException
	 * @author Verdient。
	 */
	public function __call($name, $params){
		$debug = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 1)[0];
		$exception = new UnknownMethodException('Call to unknown method: ' . get_class($this) . "::$name()");
		$exception->setFile($debug['file']);
		$exception->setLine($debug['line']);
		throw $exception;
	}

	/**
	 * 挂载事件
	 * @param string $name 事件名称
	 * @param callback $handler 处理器
	 * @param bool $append 是否添加到队列尾部
	 * @author Verdient。
	 */
	public function on($name, $handler, $append = true){
		if(!isset($this->_events[$name])){
			$this->_events[$name] = [];
		}
		if($append !== true){
			array_unshift($this->_events[$name], $handler);
		}else{
			$this->_events[$name][] = $handler;
		}
		return $this;
	}

	/**
	 * 卸载事件
	 * @param string $name 事件名称
	 * @param callback $handler 处理器
	 * @author Verdient。
	 */
	public function off($name, $handler){
		if(isset($this->_events[$name])){
			foreach($this->_events[$name] as $index => $value){
				if($value === $handler){
					unset($this->_events[$name][$index]);
				}
			}
			$this->_events[$name] = array_values($this->_events[$name]);
		}
		return $this;
	}

	/**
	 * 卸载事件
	 * @param string $name 事件名称
	 * @author Verdient。
	 */
	public function offAll($name){
		$this->_events = [];
		return $this;
	}

	/**
	 * trigger(String $name, Mixed ...$args)
	 * 触发事件
	 * -------------------------------------
	 * @param String $name 事件名称
	 * ---------------------------
	 * @author Verdient。
	 */
	public function trigger($name, ...$args){
		if(isset($this->_events[$name])){
			foreach($this->_events[$name] as $handler){
				call_user_func($handler, ...$args);
			}
		}
		return $this;
	}

	/**
	 * 事件配置
	 * @return array
	 * @author Verdient。
	 */
	public function events(){
		return [];
	}
}