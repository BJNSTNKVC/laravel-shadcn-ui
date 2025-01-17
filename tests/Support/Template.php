<?php

namespace Bjnstnkvc\ShadcnUi\Tests\Support;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Str;

class Template
{
    /**
     * Component to render.
     *
     * @var string
     */
    protected string $component;

    /**
     * Styles to include.
     *
     * @var string|null
     */
    protected string|null $styles;

    /**
     * Scripts to include.
     *
     * @var string
     */
    protected string $scripts;

    /**
     * Tailwind styles.
     *
     * @var string
     */
    private string $tailwind;

    /**
     * Create a new template instance.
     */
    public function __construct(string $component, string|null $styles = null, array $scripts = [])
    {
        $this->component = $component;
        $this->styles    = $this->styles($styles);
        $this->scripts   = $this->scripts($scripts);
        $this->tailwind  = $this->tailwind();
    }

    /**
     * Render the component template.
     *
     * @return string
     */
    public function render(): string
    {
        return Blade::render(
            <<<"BLADE"
                <html lang="en">
                    <head>
                        <title>Shadcn UI</title>
                        <meta charset="UTF-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                        <meta name="csrf-token" content="{{ csrf_token() }}" />
                        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
                        <script src="https://cdn.tailwindcss.com"></script>
                        <script>
                            {$this->tailwind}
                        </script>
                        <style>
                            {$this->styles}
                        </style>
                    </head>
                    <body class="h-dvh w-full grid place-items-center">
                        <main class="flex flex-col w-[30rem] justify-center p-10 items-center">
                            {$this->component}
                        </main>
                        <script>
                            {$this->scripts}
                        </script>
                    </body>
                </html>
            BLADE
        );
    }

    /**
     * Returns the tailwind config.
     *
     * @return string
     */
    private function tailwind(): string
    {
        return Str::replace(
            search : "/** @type {import('tailwindcss').Config} */\nexport default",
            replace: 'tailwind.config =',
            subject: file_get_contents(__DIR__ . '/../../tailwind.config.js')
        );
    }

    /**
     * Returns the styles.
     *
     * @param string|null $styles
     *
     * @return string
     */
    private function styles(string|null $styles = null): string
    {
        return <<<"CSS"
            :root {
                --background: 0 0% 100%;
                --foreground: 240 10% 3.9%;
                --card: 0 0% 100%;
                --card-foreground: 240 10% 3.9%;
                --popover: 0 0% 100%;
                --popover-foreground: 240 10% 3.9%;
                --primary: 240 5.9% 10%;
                --primary-foreground: 0 0% 98%;
                --secondary: 240 4.8% 95.9%;
                --secondary-foreground: 240 5.9% 10%;
                --muted: 240 4.8% 95.9%;
                --muted-foreground: 240 3.8% 46.1%;
                --accent: 240 4.8% 95.9%;
                --accent-foreground: 240 5.9% 10%;
                --destructive: 0 72.22% 50.59%;
                --destructive-foreground: 0 0% 98%;
                --border: 240 5.9% 90%;
                --input: 240 5.9% 90%;
                --ring: 240 5% 64.9%;
                --radius: 0.5rem;
                --chart-1: 12 76% 61%;
                --chart-2: 173 58% 39%;
                --chart-3: 197 37% 24%;
                --chart-4: 43 74% 66%;
                --chart-5: 27 87% 67%;
                --sidebar-background: 0 0% 98%;
                --sidebar-foreground: 240 5.3% 26.1%;
                --sidebar-primary: 240 5.9% 10%;
                --sidebar-primary-foreground: 0 0% 98%;
                --sidebar-accent: 240 4.8% 95.9%;
                --sidebar-accent-foreground: 240 5.9% 10%;
                --sidebar-border: 220 13% 91%;
                --sidebar-ring: 240 5% 64.9%;
            }

            $styles
        CSS;
    }

    /**
     * Returns the scripts.
     *
     * @param array $scripts
     *
     * @return string
     */
    private function scripts(array $scripts = []): string
    {
        if (empty($scripts)) {
            return '';
        }

        $js = "document.addEventListener('alpine:init', () => {\n";

        foreach ($scripts as $script) {
            $contents = file_get_contents(__DIR__ . '/../../resources/js/components/' . $script);

            $name = Str::of($script)
                ->before('.')
                ->replace('-', '');

            $script = Str::of($contents)
                ->replace(
                    search : [
                        'export default',
                        "\n});",
                    ],
                    replace: [
                        "Alpine.data('$name', ",
                        "\n}));",
                    ]
                );

            $js .= $script;
        }

        $js .= "\n});";

        return $js;
    }
}