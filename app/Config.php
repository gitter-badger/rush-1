<?php

namespace Rush;

use Webmozart\PathUtil\Path;

class Config extends \Noodlehaus\Config
{
    public static function load($path)
    {
        return new static(Path::join(__DIR__, '..', 'config', $path));
    }
}
