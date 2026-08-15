<?php

/*
 * Minimal .env loader shared by both CodeIgniter front controllers.
 *
 * Always applies the current .env file's values, overwriting whatever is
 * already in the process environment. This file is the single source of
 * truth for these app-specific variables (none of them are ever supplied
 * by Apache/Hostinger itself), so values must never be allowed to stick
 * from an earlier request: PHP worker processes on shared hosting can be
 * reused across requests, and putenv() persists at the process level, so
 * a "skip if already set" guard would let a stale value from a prior
 * request silently shadow every later edit to this file.
 */
$envFile = dirname(__DIR__) . '/.env';

if (is_file($envFile)) {
    $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    foreach ($lines as $line) {
        $line = trim($line);

        if ($line === '' || $line[0] === '#' || strpos($line, '=') === false) {
            continue;
        }

        list($name, $value) = array_map('trim', explode('=', $line, 2));

        if ($name === '') {
            continue;
        }

        $value = trim($value, "\"'");
        putenv("$name=$value");
        $_ENV[$name] = $value;
        $_SERVER[$name] = $value;
    }
}
