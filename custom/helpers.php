<?php

use App\Helpers\AmpScripts;
use App\Helpers\ReadingTime;
use Illuminate\Support\HtmlString;

function inline($assetPath)
{
    preg_match('/^\/assets\/build\/(css|js)\/.*\.(css|js)/', $assetPath, $matches);
    if (! count($matches)) {
        throw new \InvalidArgumentException("Given asset path is not valid: {$assetPath}");
    }
    $pathParts = explode('?', $assetPath);

    return new HtmlString(file_get_contents("source{$pathParts[0]}"));
}

function get_amp_scripts(string $content): array
{
    return (new AmpScripts($content))->generate();
}

function reading_time(string $content, bool $hasFeatureImage): string
{
    return (new ReadingTime($content, $hasFeatureImage))->compute();
}

function reading_time_200wad(int $wordCount): string
{
    return ReadingTime::rawCompute($wordCount);
}

function get_image_path($url)
{
    if (! is_string($url)) {
        return;
    }

    $parsedUrl = parse_url($url);

    return $parsedUrl['host'] == parse_url(env('IMAGE_URL'), PHP_URL_HOST) ? $parsedUrl['path'] : $url;
}
