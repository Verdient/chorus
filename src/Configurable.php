<?php

declare(strict_types=1);

namespace chorus;

/**
 * 可配置
 * @author Verdient。
 */
trait Configurable
{
    /**
     * 配置
     * @param array $config 配置信息
     * @author Verdient。
     */
    public function configuration(array $config){
        foreach($config as $name => $value){
            $this->$name = $value;
        }
    }
}