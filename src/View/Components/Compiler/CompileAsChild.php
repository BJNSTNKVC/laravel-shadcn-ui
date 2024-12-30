<?php

namespace Bjnstnkvc\ShadcnUi\View\Components\Compiler;

use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;
use Illuminate\Support\Stringable;
use Illuminate\View\Component;
use Illuminate\View\ComponentAttributeBag;
use Illuminate\View\ComponentSlot;

class CompileAsChild extends Component
{
    /**
     * The component slot.
     *
     * @var ComponentSlot
     */
    public ComponentSlot $slot;

    /**
     * The root element to which to pass the attributes.
     *
     * @var ?string
     */
    public null|string $root;

    /**
     * Create a new component instance.
     */
    public function __construct(ComponentSlot $slot, ComponentAttributeBag $attributes, ?string $root = null)
    {
        $this->slot       = $slot;
        $this->attributes = $attributes;
        $this->root       = $root;
    }

    /**
     * Compile the component.
     *
     * @return HtmlString
     */
    protected function compile(): HtmlString
    {
        return Str::of($this->slot->toHtml())
            ->pipe(fn($html) => $this->normalize($html))
            ->pipe(fn($html) => $this->root($html))
            ->pipe(fn($html) => $this->merge($html))
            ->pipe(fn($html) => $this->trim($html))
            ->pipe(fn($html) => $this->inject($html))
            ->toHtmlString();
    }

    /**
     * Normalize tags by trimming and reducing whitespace.
     *
     * @param Stringable $html
     *
     * @return Stringable
     */
    protected function normalize(Stringable $html): Stringable
    {
        return $html->replaceMatches(
            pattern: '/<([^\/][^>]*)>/',
            replace: fn(array $matches) => "<" . preg_replace('/\s+/', ' ', trim($matches[1])) . ">"
        );
    }

    /**
     * Apply root attributes to the first tag.
     *
     * @param Stringable $html
     *
     * @return Stringable
     */
    protected function root(Stringable $html): Stringable
    {
        return $html->replaceMatches(
            pattern: $this->root ? "/<$this->root/" : '/^<([\w-]+)/',
            replace: $this->root ? "<$this->root $this->attributes" : "<\$1 $this->attributes"
        );
    }

    /**
     * Merge and deduplicate class attributes.
     *
     * @param Stringable $html
     *
     * @return Stringable
     */
    protected function merge(Stringable $html): Stringable
    {
        return $html->replaceMatches(
            pattern: '/<(\w+)([^>]*)>/',
            replace: function (array $matches) {
                [$tag, $attributes] = [$matches[1], $matches[2]];

                $classes = $this->classes($attributes);

                $attributes = Str::replaceMatches('/ class="[^"]*"/', '', $attributes);

                return "<$tag" . ($classes ? " class=\"$classes\"" : '') . "$attributes>";
            }
        );
    }

    /**
     * Remove excessive spaces between attributes.
     *
     * @param Stringable $html
     *
     * @return Stringable
     */
    protected function trim(Stringable $html): Stringable
    {
        return $html->replaceMatches(
            pattern: '/<([^>]*?)\s{2,}([^>]*)>/',
            replace: '<\1 \2>'
        );
    }

    /**
     * Inject slot placeholder in the middle of the content.
     *
     * @param Stringable $html
     *
     * @return string
     */
    protected function inject(Stringable $html): string
    {
        $content = $html->stripTags();

        if ($content->isNotEmpty()) {
            return $html->replace(
                search : $content,
                replace: $content->append('{{ $slot }}')
            );
        }

        $tags = $html->matchAll('/(<[^>]+>|[^<]+)/');

        if ($tags->isEmpty()) {
            return $html;
        }

        $tags->splice(
            offset     : $tags->count() / 2,
            length     : 0,
            replacement: ['{{ $slot }}']
        );

        return $tags->join('');
    }

    /**
     * Extract and deduplicate class attributes.
     *
     * @param string $attributes
     *
     * @return string
     */
    protected function classes(string $attributes): string
    {
        return Str::of($attributes)
            ->matchAll('/class="([^"]*)"/')
            ->flatMap(fn(string $match) => explode(' ', $match))
            ->unique()
            ->filter()
            ->implode(' ');
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return string
     */
    public function render(): string
    {
        return $this->compile()->toHtml();
    }
}
