<?php

declare(strict_types=1);

namespace chorus;

/**
 * 拥有事件
 * @author Verdient。
 */
trait HasEvent
{
    /**
     * @var array 挂载的事件
     * @author Verdient。
     */
    protected $events = [];

    /**
     * 挂载事件
     * @param string $name 事件名称
     * @param callback $handler 处理器
     * @param bool $append 是否添加到队列尾部
     * @author Verdient。
     */
    public function on($name, $handler, $append = true){
        if(!isset($this->events[$name])){
            $this->events[$name] = [];
        }
        if($append !== true){
            array_unshift($this->events[$name], $handler);
        }else{
            $this->events[$name][] = $handler;
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
        if(isset($this->events[$name])){
            foreach($this->events[$name] as $index => $value){
                if($value === $handler){
                    unset($this->events[$name][$index]);
                }
            }
            $this->events[$name] = array_values($this->events[$name]);
        }
        return $this;
    }

    /**
     * 卸载所有事件
     * @param string $name 事件名称
     * @author Verdient。
     */
    public function offAll($name){
        if($name){
            unset($this->events[$name]);
        }else{
            $this->events = [];
        }
        return $this;
    }

    /**
     * 触发事件
     * @param string $name 事件名称
     * @author Verdient。
     */
    public function trigger($name, ...$args){
        if(isset($this->events[$name])){
            foreach($this->events[$name] as $handler){
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