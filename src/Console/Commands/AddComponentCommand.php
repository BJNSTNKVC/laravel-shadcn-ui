<?php

namespace Bjnstnkvc\ShadcnUi\Console\Commands;

use Bjnstnkvc\ShadcnUi\Console\Command;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Str;

class AddComponentCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'shadcn:add { components* : Components to add. } { --force : Overwrites existing components. }';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add Shadcn UI components to your project.';

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
            $this->publish($component);
        }

        return self::SUCCESS;
    }

    /**
     * Publish the Component.
     *
     * @param array{name: string, path: string, view: string} $component
     *
     * @return void
     *
     * @throws FileNotFoundException
     */
    protected function publish(array $component): void
    {
        $name = $component['name'];
        $view = $component['view'];

        $this->fs->ensureDirectoryExists(app_path("View/Components/$name"));
        $this->fs->ensureDirectoryExists(resource_path("views/components/$view"));

        if ($this->isPublished($component) && !$this->option('force') && !$this->confirm("{$name} component already exists. Do you want to overwrite it?")) {
            $this->info("$name component skipped.");

            return;
        }

        $path  = app_path("View/Components/{$component['name']}");
        $views = resource_path("views/components/{$component['view']}");

        foreach ($this->fs->files($component['path']) as $file) {
            $content = Str::replace(
                search : ['Bjnstnkvc\ShadcnUi\View\Components', 'shadcn-ui::'],
                replace: ['App\View\Components', ''],
                subject: $this->fs->get($file->getPathname())
            );

            $this->fs->put("$path/{$file->getBasename()}", $content);
        }

        $this->info("Component classes published at: app/View/Components/$name");

        $this->fs->copyDirectory(self::RESOURCE_PATH . "/views/components/{$component['view']}", $views);

        $this->info("Blade views published at: resources/views/components/{$component['view']}");

        if ($this->fs->exists($js = self::RESOURCE_PATH . "/js/components/{$component['view']}.js")) {
            $this->fs->ensureDirectoryExists($scripts = resource_path('js/components'));

            $this->fs->copy($js, "$scripts/{$component['view']}.js");

            $this->info("Script file published at: resources/js/components/{$component['view']}.js");
        }

        $this->fs->put("{$component['path']}/.published", '');
    }
}
