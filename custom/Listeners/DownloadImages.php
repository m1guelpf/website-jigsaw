<?php

namespace App\Listeners;

use DOMDocument;
use TightenCo\Jigsaw\Jigsaw;
use TightenCo\Jigsaw\Parsers\FrontMatterParser;

class DownloadImages
{
    protected $parser;

    public function handle(Jigsaw $jigsaw)
    {
        if (! env('DOWNLOAD_IMAGES', true)) {
            return;
        }

        $images = $this->getImages($this->getPosts($jigsaw), $jigsaw);

        $this->downloadImages($images, $jigsaw);
    }

    protected function getPosts(Jigsaw $jigsaw): array
    {
        $parser = $jigsaw->app[FrontMatterParser::class];

        return $this->getPostsContent($jigsaw)->map(function ($post) use ($parser) {
            return $parser->extractContent($post);
        })->values()->toArray();
    }

    protected function getPostsContent(Jigsaw $jigsaw)
    {
        return $jigsaw->getCollection('posts')->map(function ($post) {
            $meta = $post->_meta;

            return file_get_contents("{$meta['source']}/{$meta['filename']}.{$meta['extension']}");
        });
    }

    protected function getImages(array $posts, Jigsaw $jigsaw): array
    {
        $destination = $jigsaw->getDestinationPath();

        return $this->getAllImages($posts, $jigsaw)->reject(function ($post) {
            return $post->isEmpty() || is_null($post->first());
        })->flatten()->unique()->filter(function ($url) {
            return ! is_null($url) && in_array(parse_url($url, PHP_URL_HOST), [null, parse_url(env('IMAGE_URL'), PHP_URL_HOST)]);
        })->map(function ($url) {
            return parse_url($url, PHP_URL_PATH);
        })->mapWithKeys(function ($path) use ($destination) {
            return [$destination . $path => 'https://staging.miguelpiedrafita.com' . $path];
        })->toArray();
    }

    protected function getAllImages(array $posts, Jigsaw $jigsaw)
    {
        return $this->getPostImages($posts)->merge($this->getMetaImages($jigsaw));
    }

    protected function getPostImages(array $posts)
    {
        return collect($posts)->map(function ($content) {
            $dom = @DOMDocument::loadHTML($content);

            return collect($dom->getElementsByTagName('img'))->map(function ($img) {
                return $img->getAttribute('src');
            });
        });
    }

    protected function getMetaImages(Jigsaw $jigsaw)
    {
        $parser = $jigsaw->app[FrontMatterParser::class];

        return $this->getPostsContent($jigsaw)->map(function ($post) use ($parser) {
            $frontMatter = $parser->getFrontMatter($post);

            return collect([
                $frontMatter['cover_image'], $frontMatter['og']['image'], $frontMatter['twitter']['image'],
            ]);
        })->values();
    }

    protected function downloadImages(array $images, Jigsaw $jigsaw)
    {
        $filesystem = $jigsaw->getFilesystem();

        collect($images)->map(function ($url) {
            return @file_get_contents($url);
        })->reject(function ($content) {
            return is_null($content);
        })->each(function ($contents, $path) use ($jigsaw, $filesystem) {
            $directory_path = collect(explode('/', $path));
            $directory_path->pop();
            $directory_path = $directory_path->implode('/');

            if (! $filesystem->isDirectory($directory_path) || ! $filesystem->exists($directory_path)) {
                $filesystem->makeDirectory($directory_path, 0755, true);
            }

            $filesystem->put($path, $contents);
        });
    }
}
