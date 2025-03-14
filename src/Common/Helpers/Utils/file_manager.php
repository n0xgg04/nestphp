<?php
/**
 * Get the base path of the project.
 *
 * @return string The base path.
 */
function base_path(): string
{
    return __DIR__ . "/../../../";
}

/**
 * Join string into a single URL string.
 *
 * @param string $parts,... The parts of the URL to join.
 * @return string The URL string.
 */
function join_paths(...$parts): string
{
    if (sizeof($parts) === 0) {
        return "";
    }
    $prefix = $parts[0] === DIRECTORY_SEPARATOR ? DIRECTORY_SEPARATOR : "";
    $processed = array_filter(
        array_map(function ($part) {
            return rtrim($part, DIRECTORY_SEPARATOR);
        }, $parts),
        function ($part) {
            return !empty($part);
        }
    );
    return $prefix . implode(DIRECTORY_SEPARATOR, $processed);
}
