<?php

use Illuminate\Support\HtmlString;

function inline($assetPath)
{
    preg_match('/^\/assets\/build\/(css|js)\/.*\.(css|js)/', $assetPath, $matches);
    if (!count($matches)) {
        throw new \InvalidArgumentException("Given asset path is not valid: {$assetPath}");
    }
    $pathParts = explode('?', $assetPath);
    return new HtmlString(file_get_contents("source{$pathParts[0]}"));
}