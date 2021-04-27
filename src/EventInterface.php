<?php

declare(strict_types=1);

namespace chorus;

/**
 * 事件接口
 * @author Verdient。
 */
interface EventInterface
{
    /**
     * 挂载事件
     * @param string $name 事件名称
     * @param Callable $handler 处理器
     * @param bool $append 是否添加到队列尾部
     * @author Verdient。
     */
    public function on($name, $handler, $append = true);

    /**
     * 卸载事件
     * @param string $name 事件名称
     * @param Callable $handler 处理器
     * @author Verdient。
     */
    public function off($name, $handler);

    /**
     * 卸载所有事件
     * @param string $name 事件名称
     * @author Verdient。
     */
    public function offAll($name);

    /**
     * 触发事件
     * @param string $name 事件名称
     * @author Verdient。
     */
    public function trigger($name, ...$args);
}