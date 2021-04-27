<?php

declare(strict_types=1);

namespace chorus;

/**
 * 拥有修改器
 * @author Verdient。
 */
trait HasSetter
{
    /**
     * @inheritdoc
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
     * @inheritdoc
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
}