<?php

namespace Bjnstnkvc\ShadcnUi\Console\Commands;

use Bjnstnkvc\ShadcnUi\Console\Command;
use Illuminate\Contracts\Filesystem\FileNotFoundException;

class RemoveComponentCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'shadcn:remove { components* : Components to remove. }';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove Shadcn UI components from your project.';

    /**
     * Execute the console command.
     *
     * @return int
     *
     * @throws FileNotFoundException
     */
    public function handle(): int
    {
        foreach ($this->components() as $component) {
            $this->remove($component);
        }

        return self::SUCCESS;
    }

    /**
     * Remove the Component.
     *
     * @param array{name: string, path: string, view: string} $component
     *
     * @return void
     */
    protected function remove(array $component): void
    {
        if ($this->isNotPublished($component)) {
            return;
        }

        $this->fs->deleteDirectory(app_path("View/Components/{$component['name']}"));
        $this->fs->deleteDirectory(resource_path("views/components/{$component['view']}"));
        $this->fs->delete(resource_path("js/components/{$component['view']}.js"));
        $this->fs->delete("{$component['path']}/.published");

        $this->info("{$component['name']} component removed.");
    }
}
