<?php

use App\Helpers\AmpScripts;
use App\Helpers\ReadingTime;
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

function get_amp_scripts(string $content) : array
{
    return (new AmpScripts($content))->generate();
}

function reading_time(string $content, bool $hasFeatureImage) : string
{
    return (new ReadingTime($content, $hasFeatureImage))->compute();
}