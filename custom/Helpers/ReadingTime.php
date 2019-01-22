<?php

namespace App\Helpers;

use DOMDocument;
use Illuminate\Support\Str;

class ReadingTime
{
    public function __construct(string $content, bool $hasFeaturedImage)
    {
        $this->content = $content;
        $this->dom = @DOMDocument::loadHTML($content);
        $this->wordsPerMin =  275;
        $this->wordsPerSec = $this->wordsPerMin / 60;
        $this->images = $hasFeaturedImage ? 1 : 0;
        $this->countImages();
        $this->countWords();
    }

    public static function rawCompute(int $words) : string
    {
        $seconds = $words / (275 / 60);

        $minutes = round($seconds / 60);

        return $minutes <= 1 ? '1 min read' : "$minutes min read";
    }

    public function compute() : string
    {
        $seconds = $this->words / $this->wordsPerSec;

        for ($i = 12; $i > (12 - $this->images); $i--) {
            $seconds += $i < 3 ? 3 : $i;
        }

        $minutes = round($seconds / 60);

        return $minutes <= 1 ? '1 min read' : "$minutes min read";
    }
    
    protected function countImages() : void
    {
        $this->images += collect($this->dom->getElementsByTagName('img'))->count();
    }

    protected function countWords() : void
    {
        $this->words = collect(explode(' ', strip_tags(str_replace('>', '> ', $this->content))))->reject(function ($word) {
            return in_array($word, ['', '.', "\n"]);
        })->count();
    }
}
