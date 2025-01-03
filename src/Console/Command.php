<?php

namespace Bjnstnkvc\ShadcnUi\Console;

use Bjnstnkvc\ShadcnUi\Console\Commands\AddComponentCommand;
use Illuminate\Console\Command as BaseCommand;
use Illuminate\Contracts\Console\PromptsForMissingInput;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputOption;

use function Laravel\Prompts\multiselect;

/**
 * @template T of array{name: string, path: string, view: string}
 */
class Command extends BaseCommand implements PromptsForMissingInput
{
    /**
     * The path to the components' directory.
     *
     * @var string
     */
    protected const CLASS_PATH = __DIR__ . '\..\View\Components';

    /**
     * The path to the resources' directory.
     *
     * @var string
     */
    protected const RESOURCE_PATH = __DIR__ . '\..\..\resources';

    /**
     * List of all possible Component folders.
     *
     * @var Collection<string, string>
     */
    protected Collection $directories;

    /**
     * Create a new console command instance.
     *
     * @return void
     */
    public function __construct(protected readonly Filesystem $fs)
    {
        parent::__construct();

        $this->directories = $this->directories();
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getOptions(): array
    {
        return [
            ['force', 'f', InputOption::VALUE_NONE, 'Create the class even if the Component already exists'],
        ];
    }

    /**
     * Prompt for missing input arguments using the returned questions.
     *
     * @return array
     */
    protected function promptForMissingArgumentsUsing(): array
    {
        $options = $this->directories
            ->mapWithKeys(fn(array $component, string $key) => [$key => $component['name']])
            ->prepend('All', '*');

        $question = $this instanceof AddComponentCommand
            ? 'Which components would you like to add?'
            : 'Which components would you like to remove?';

        return [
            'components' => fn() => multiselect(
                label   : $question,
                options : $options,
                required: true
            ),
        ];
    }

    /**
     * Get the console command arguments.
     *
     * @return array<int, T>
     */
    protected function components(): array
    {
        return $this->all()
            ? $this->directories->toArray()
            : $this->directories
                ->filter(fn(array $component, int $key) => in_array($key, $this->argument('components')) || in_array($component['name'], $this->argument('components')))
                ->toArray();
    }

    /**
     * Determine if the "All" option was selected.
     *
     * @return bool
     */
    private function all(): bool
    {
        return count(array_intersect($this->argument('components'), ['All', '*'])) > 0;
    }

    /**
     * Determine if the Component was already published.
     *
     * @param array{name: string, path: string, view: string} $component
     *
     * @return bool
     */
    protected function isPublished(array $component): bool
    {
        return $this->fs->exists("{$component['path']}/.published");
    }

    /**
     * Determine if the Component was not already published.
     *
     * @param array{name: string, path: string, view: string} $component
     *
     * @return bool
     */
    protected function isNotPublished(array $component): bool
    {
        return !$this->isPublished($component);
    }

    /**
     * Get all files in a directory.
     *
     * @return Collection<int, T>
     */
    private function directories(): Collection
    {
        return (new Collection($this->fs->directories(self::CLASS_PATH)))
            ->reject(fn(string $path) => Str::contains($path, 'Compiler'))
            ->map(function (string $path) {
                $name = basename($path);
                $view = Str::of($name)
                    ->ucsplit()
                    ->map(fn(string $word) => Str::lower($word))
                    ->join('-');

                return [
                    'name' => $name,
                    'path' => $path,
                    'view' => $view,
                ];
            });
    }
}
