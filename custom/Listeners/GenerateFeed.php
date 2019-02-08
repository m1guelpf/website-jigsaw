<?php

namespace App\Listeners;

use TightenCo\Jigsaw\Jigsaw;

class GenerateFeed
{
    public function handle(Jigsaw $jigsaw)
    {
        $feed = file_get_contents(env('GHOST_HOST').env('FEED_PATH'));

        $feed = str_replace('staging.miguelpiedrafita.com', 'miguelpiedrafita.com', $feed);

        file_put_contents($jigsaw->getDestinationPath() . '/feed.rss', $feed);
    }
}
