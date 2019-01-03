<?php

use Symfony\Component\Dotenv\Dotenv;

require_once 'vendor/autoload.php';

(new Dotenv)->load(__DIR__ . '/.env');

// @var $container \Illuminate\Container\Container
// @var $events \TightenCo\Jigsaw\Events\EventBus

/*
 * You can run custom code at different stages of the build process by
 * listening to the 'beforeBuild', 'afterCollections', and 'afterBuild' events.
 *
 * For example:
 *
 * $events->beforeBuild(function (Jigsaw $jigsaw) {
 *     // Your code here
 * });
 */
$container->bind(\TightenCo\Jigsaw\Handlers\CollectionItemHandler::class, function ($c) {
    return new \TightenCo\Jigsaw\Handlers\CollectionItemHandler($c['config'], [
        $c[\App\Handlers\GhostHandler::class],
        $c[\TightenCo\Jigsaw\Handlers\MarkdownHandler::class],
        $c[\TightenCo\Jigsaw\Handlers\BladeHandler::class],
    ]);
});
$container->bind(\App\Listeners\DownloadImages::class, function ($c) {
    return new \App\Listeners\DownloadImages($c[\TightenCo\Jigsaw\Parsers\FrontMatterParser::class]);
});

$events->afterCollections(\App\Listeners\DownloadImages::class);
$events->afterBuild(\App\Listeners\GenerateSitemap::class);
$events->afterBuild(\App\Listeners\GenerateIndex::class);
