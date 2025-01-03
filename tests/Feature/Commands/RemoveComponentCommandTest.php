<?php

namespace Bjnstnkvc\ShadcnUi\Tests\Feature\Commands;

use Bjnstnkvc\ShadcnUi\Tests\Support\CleansUpComponents;
use Bjnstnkvc\ShadcnUi\Tests\TestCase;
use Illuminate\Filesystem\Filesystem;
use PHPUnit\Framework\Attributes\Test;

class RemoveComponentCommandTest extends TestCase
{
    use CleansUpComponents;

    /**
     * Question for the console command.
     *
     * @var string
     */
    protected const QUESTION = 'Which components would you like to remove?';

    #[Test]
    public function the_command_components_argument_is_required()
    {
        $this->artisan('shadcn:remove')
            ->expectsQuestion(
                question: self::QUESTION,
                answer  : []
            )
            ->assertFailed();
    }

    #[Test]
    public function the_command_removes_a_component()
    {
        $this->artisan('shadcn:add', ['components' => ['Accordion']])
            ->assertSuccessful();

        $this->artisan('shadcn:remove')
            ->expectsQuestion(
                question: self::QUESTION,
                answer  : ['Accordion']
            )
            ->expectsOutput('Accordion component removed.')
            ->assertSuccessful();

        $this->assertDirectoryDoesNotExist(
            directory: app_path('View/Components/Accordion'),
            message  : 'Component was not removed'
        );

        $this->assertDirectoryDoesNotExist(
            directory: resource_path('views/components/accordion'),
            message  : 'Component was not removed'
        );
    }

    #[Test]
    public function the_command_removes_all_component()
    {
        $this->artisan('shadcn:add', ['components' => ['All']])
            ->assertSuccessful();

        $this->artisan('shadcn:remove')
            ->expectsQuestion(
                question: self::QUESTION,
                answer  : ['*']
            )
            ->assertSuccessful();

        $components = array_diff(scandir(app_path('View/Components')), ['.', '..']);

        foreach ($components as $component) {
            $this->assertDirectoryDoesNotExist(
                directory: app_path("View/Components/$component"),
                message  : "$component component was not removed."
            );

            $this->assertDirectoryDoesNotExist(
                directory: resource_path("views/components/$component"),
                message  : "$component component resource was not removed."
            );

            $this->assertDirectoryDoesNotExist(
                directory: resource_path("views/components/$component"),
                message  : "$component component resource was not removed."
            );
        }
    }

    #[Test]
    public function the_command_will_not_remove_user_component_that_share_the_same_name()
    {
        $this->artisan('shadcn:add', ['components' => ['Accordion']])
            ->assertSuccessful();

        unlink(__DIR__ . '/../../../src/View/Components/Accordion/.published');

        $this->artisan('shadcn:remove')
            ->expectsQuestion(
                question: self::QUESTION,
                answer  : ['Accordion']
            )
            ->assertSuccessful();

        $this->assertDirectoryExists(
            directory: app_path("View/Components/Accordion"),
            message  : "Accordion component was removed."
        );

        $this->assertDirectoryExists(
            directory: resource_path("views/components/Accordion"),
            message  : "Accordion component resource was removed."
        );

        $this->assertDirectoryExists(
            directory: resource_path("views/components/Accordion"),
            message  : "Accordion component resource was removed."
        );

        $this->cleanUp();
    }
}