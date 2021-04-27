<?php

declare(strict_types=1);

namespace chorus;

/**
 * 拥有访问器
 * @author Verdient。
 */
trait HasGetter
{
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
}