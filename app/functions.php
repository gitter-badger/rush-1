<?php

namespace Rush;

/**
 *
 */
function env($name, $defaults = null)
{
    $val = getenv($name);
    return $val === false ? $defaults : $val;
}

/**
 * Parse database uri for config/database.php format.
 *
 * ```
 * file:///PATH/TO/SQLITE
 * mysql://USER:PASS@HOST/DATABASE_NAME?reconnect=true
 * ```
 */
function parseDatabaseUri($uri)
{
    $maps = [
        'user' => 'username',
        'pass' => 'password',
        'path' => 'database',
    ];
    $parsed = parse_url($uri);

    if (isset($parsed['path']) && $parsed['scheme'] !== 'file') {
        $parsed['path'] = substr($parsed['path'], 1);
    }

    foreach ($maps as $origin => $renamed) {
        if (isset($parsed[$origin])) {
            $parsed[$renamed] = $parsed[$origin];
            unset($parsed[$origin]);
        }
    }

    return $parsed;
}
