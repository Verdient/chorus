<?php
namespace chorus;

/**
 * EventInterface
 * 事件接口
 * --------------
 * @author Verdient。
 */
interface EventInterface
{
	/**
	 * on(String $name, Callable $handler[, Boolean $append = true])
	 * 挂载事件
	 * -------------------------------------------------------------
	 * @param String $name 事件名称
	 * @param Callable $handler 处理器
	 * @param Boolean $append 是否添加到队列尾部
	 * --------------------------------------
	 * @author Verdient。
	 */
	public function on($name, $handler, $append = true);

	/**
	 * off(String $name, Callable $handler)
	 * 卸载事件
	 * ------------------------------------
	 * @param String $name 事件名称
	 * @param Callable $handler 处理器
	 * ------------------------------
	 * @author Verdient。
	 */
	public function off($name, $handler);

	/**
	 * offAll(String $name)
	 * 卸载事件
	 * --------------------
	 * @param String $name 事件名称
	 * ---------------------------
	 * @author Verdient。
	 */
	public function offAll($name);

	/**
	 * trigger(String $name, Mixed ...$args)
	 * 触发事件
	 * -------------------------------------
	 * @param String $name 事件名称
	 * ---------------------------
	 * @author Verdient。
	 */
	public function trigger($name, ...$args);
}