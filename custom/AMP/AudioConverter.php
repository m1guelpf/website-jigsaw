<?php

namespace App\AMP;

use League\Event\EventInterface;
use League\Event\EmitterInterface;
use Predmond\HtmlToAmp\ElementInterface;
use Predmond\HtmlToAmp\Converter\ConverterInterface;

class AudioConverter implements ConverterInterface
{
    /**
     * @param ElementInterface $element
     *
     * @return string
     */
    public function handleTagAudio(EventInterface $event, ElementInterface $element)
    {
        // Create the responsive <amp-audio /> tag
        $ampAudio = $element->createWritableElement('amp-audio');
        foreach ($element->getAttributes() as $key => $value) {
            $ampAudio->setAttribute($key, $value);
        }

        $element->replaceWith($ampAudio);

        $event->stopPropagation();
    }

    public function getSubscribedEvents()
    {
        return [
            'audio' => ['handleTagAudio', EmitterInterface::P_HIGH]
        ];
    }
}
