<?php

namespace App\AMP;

use League\Event\EventInterface;
use League\Event\EmitterInterface;
use Predmond\HtmlToAmp\ElementInterface;
use Predmond\HtmlToAmp\Converter\ConverterInterface;

class IframeConverter implements ConverterInterface
{
    /**
     * @param ElementInterface $element
     *
     * @return string
     */
    public function handleTagIframe(EventInterface $event, ElementInterface $element)
    {
        // Create the responsive <amp-iframe /> tag
        $ampIframe = $element->createWritableElement('amp-iframe');
        foreach ($element->getAttributes() as $key => $value) {
            $ampIframe->setAttribute($key, $value);
        }

        $element->replaceWith($ampIframe);

        $event->stopPropagation();
    }

    public function getSubscribedEvents()
    {
        return [
            'iframe' => ['handleTagIframe', EmitterInterface::P_HIGH]
        ];
    }
}
