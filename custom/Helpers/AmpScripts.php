<?php

namespace App\Helpers;

use DOMDocument;
use Illuminate\Support\Str;

class AmpScripts
{
    public function __construct(string $content)
    {
        $this->content = $content;
        $this->dom = @DOMDocument::loadHTML($content);
        $this->scripts = [];
    }

    public function generate() : array
    {
        $this->handleGifs();
        $this->handleIframes();
        $this->handleAudio();

        return $this->scripts;
    }
    
    protected function handleGifs() : void
    {
        if (! collect($this->dom->getElementsByTagName('img'))->map(function ($img) {
            return $img->getAttribute('src');
        })->filter(function ($url) {
            return Str::endsWith($url, '.gif');
        })->isEmpty()) {
            $this->scripts[] = '<script async custom-element="amp-anim" src="https://cdn.ampproject.org/v0/amp-anim-0.1.js"></script>';
        }
    }
    
    protected function handleIframes() : void
    {
        if (! collect($this->dom->getElementsByTagName('iframe'))->isEmpty()) {
            $this->scripts[] = '<script async custom-element="amp-iframe" src="https://cdn.ampproject.org/v0/amp-iframe-0.1.js"></script>';
        }
    }

    protected function handleAudio() : void
    {
        if (! collect($this->dom->getElementsByTagName('audio'))->isEmpty()) {
            $this->scripts[] = '<script async custom-element="amp-audio" src="https://cdn.ampproject.org/v0/amp-audio-0.1.js"></script>';
        }
    }
}
