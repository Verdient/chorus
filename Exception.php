<?php

declare(strict_types=1);

namespace chorus;

/**
 * 异常
 * @author Verdient。
 */
class Exception extends \Exception
{
    /**
     * 设置文件
     * @param string $file 文件
     * @author Verdient。
     */
    public function setFile(string $file)
    {
        $this->file = $file;
    }

    /**
     * 设置行号
     * @param int $line 行号
     * @author Verdient。
     */
    public function setLine(int $line)
    {
        $this->line = $line;
    }
}
