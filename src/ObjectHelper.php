<?php

declare(strict_types=1);

namespace chorus;

/**
 * 对象助手
 * @author Verdient。
 */
class ObjectHelper
{
    /**
     * 创建对象
     * @param string|array $class 类
     * @return mixed
     * @author Verdient。
     */
    public static function create($class, ...$args){
        if(is_string($class)){
            return new $class(...$args);
        }
        if(is_array($class) && isset($class['class'])){
            $className = $class['class'];
            $object = new $className(...$args);
            unset($class['class']);
            foreach($class as $name => $value){
                $object->$name = $value;
            }
            return $object;
        }
        throw new InvalidParamException('Object configuration must be an array containing a "class" element.');
    }
}