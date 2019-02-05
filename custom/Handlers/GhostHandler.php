<?php

namespace App\Handlers;

use App\AMP\AudioConverter;
use App\AMP\IframeConverter;
use TightenCo\Jigsaw\PageData;
use Predmond\HtmlToAmp\Environment;
use Predmond\HtmlToAmp\AmpConverter;
use App\AMP\CloudinaryImageConverter;
use TightenCo\Jigsaw\File\OutputFile;
use TightenCo\Jigsaw\View\ViewRenderer;
use TightenCo\Jigsaw\File\TemporaryFilesystem;
use TightenCo\Jigsaw\Parsers\FrontMatterParser;
use Predmond\HtmlToAmp\Converter\Extensions\YoutubeConverter;

class GhostHandler
{
    private $temporaryFilesystem;
    private $parser;
    private $view;

    public function __construct(TemporaryFilesystem $temporaryFilesystem, FrontMatterParser $parser, ViewRenderer $viewRenderer)
    {
        $this->temporaryFilesystem = $temporaryFilesystem;
        $this->parser = $parser;
        $this->view = $viewRenderer;
    }

    public function shouldHandle($file)
    {
        return in_array($file->getRelativePath(), ['_posts/_tmp', '_pages/_tmp', '_daily/_tmp']);
    }

    public function handleCollectionItem($file, PageData $pageData)
    {
        return $this->buildOutput($file, $pageData);
    }

    public function handle($file, $pageData)
    {
        $pageData->page->addVariables($this->getPageVariables($file));

        return $this->buildOutput($file, $pageData);
    }

    private function getPageVariables($file)
    {
        return array_merge(['section' => 'content'], $this->parseFrontMatter($file));
    }

    private function buildOutput($file, PageData $pageData)
    {
        return collect($pageData->page->extends)
            ->map(function ($extends, $templateToExtend) use ($file, $pageData) {
                if ($templateToExtend) {
                    $pageData->setExtending($templateToExtend);
                }

                $extension = $this->view->getExtension($extends);

                return new OutputFile(
                    $file->getRelativePath(),
                    $file->getFileNameWithoutExtension(),
                    $extension == 'php' ? 'html' : $extension,
                    $this->render($file, $pageData, $extends),
                    $pageData
                );
            });
    }

    private function render($file, $pageData, $extends)
    {
        $uniqueFileName = $file->getPathname() . $extends;

        if ($cached = $this->getValidCachedFile($file, $uniqueFileName)) {
            return $this->view->render($cached->getPathname(), $pageData);
        }

        return $this->renderMarkdownFile($file, $uniqueFileName, $pageData, $extends);
    }

    private function renderMarkdownFile($file, $uniqueFileName, $pageData, $extends)
    {
        $html = $this->parser->extractContent(
            $file->getContents()
        );

        if ($extends == '_layouts.amp') {
            $html = $this->getAmpHtml($html);
        }

        $html = str_replace(['staging.miguelpiedrafita.com', '><'], ['miguelpiedrafita.com', ">\n<"], $html);

        $pageData->set('postContent', $html);

        $wrapper = $this->view->renderString(
            "@extends('{$extends}')\n" .
                "@section('{$pageData->page->section}'){!! \$postContent !!}@endsection"
        );

        return str_replace('<?', "<<?php echo '?'; ?>", $this->view->render(
            $this->temporaryFilesystem->put($wrapper, $uniqueFileName, '.php'),
            $pageData
        ));
    }

    private function getValidCachedFile($file, $uniqueFileName)
    {
        $extension = $file->isBladeFile() ? '.blade.md' : '.php';
        $cached = $this->temporaryFilesystem->get($uniqueFileName, $extension);

        if ($cached && $cached->getLastModifiedTime() >= $file->getLastModifiedTime()) {
            return $cached;
        }
    }

    private function getEscapedMarkdownContent($file)
    {
        $replacements = ['<?php' => "<{{'?php'}}"];

        if (in_array($file->getFullExtension(), ['markdown', 'md', 'mdown'])) {
            $replacements = array_merge([
                ' @' => " {{'@'}}",
                "\n@" => "\n{{'@'}}",
                '`@' => "`{{'@'}}",
                '{{' => '@{{',
                '{!!' => '@{!!',
            ], $replacements);
        }

        return strtr($file->getContents(), $replacements);
    }

    private function parseFrontMatter($file)
    {
        return $this->parser->getFrontMatter($file->getContents());
    }

    public function getAmpHtml(string $content): string
    {
        $env = (Environment::createDefaultEnvironment())
            ->addConverter(new YoutubeConverter())
            ->addConverter(new AudioConverter())
            ->addConverter(new IframeConverter())
            ->addConverter(new CloudinaryImageConverter());

        return (new AmpConverter($env))->convert($content);
    }
}
