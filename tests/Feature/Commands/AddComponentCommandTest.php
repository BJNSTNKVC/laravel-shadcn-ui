<?php

namespace Bjnstnkvc\ShadcnUi\Tests\Feature\Commands;

use Bjnstnkvc\ShadcnUi\Tests\Support\CleansUpComponents;
use Bjnstnkvc\ShadcnUi\Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class AddComponentCommandTest extends TestCase
{
    use CleansUpComponents;

    /**
     * Question for the console command.
     *
     * @var string
     */
    protected const QUESTION = 'Which components would you like to add?';

    /**
     * Clean up the testing environment before the next test.
     *
     * @return void
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        $this->cleanUp();
    }

    #[Test]
    public function the_command_components_argument_is_required()
    {
        $this->artisan('shadcn:add')
            ->expectsQuestion(
                question: self::QUESTION,
                answer  : []
            )
            ->assertFailed();
    }

    #[Test]
    public function the_command_creates_a_component()
    {
        $this->artisan('shadcn:add')
            ->expectsQuestion(
                question: self::QUESTION,
                answer  : ['Accordion']
            )
            ->expectsOutput('Component classes published at: app/View/Components/Accordion')
            ->expectsOutput('Blade views published at: resources/views/components/accordion')
            ->expectsOutput('Script file published at: resources/js/components/accordion.js')
            ->assertSuccessful();

        $this->assertDirectoryExists(
            directory: app_path('View/Components/Accordion'),
            message  : 'Component was not created.'
        );

        $this->assertDirectoryExists(
            directory: resource_path('views/components/accordion'),
            message  : 'Component view was not created.'
        );

        $this->assertFileExists(
            filename: resource_path('js/components/accordion.js'),
            message : 'Component script was not created.'
        );
    }

    #[Test]
    public function the_command_creates_all_components()
    {
        $this->artisan('shadcn:add')
            ->expectsQuestion(
                question: self::QUESTION,
                answer  : ['All']
            )
            ->assertSuccessful();

        $components = self::$fs->directories(app_path('View/Components'));

        foreach ($components as $component) {
            $component = basename($component);

            $this->assertDirectoryExists(
                directory: app_path("View/Components/$component"),
                message  : "Component $component was not created."
            );
        }
    }

    #[Test]
    public function the_command_will_not_overwrite_an_existing_component()
    {
        $this->artisan('shadcn:add')
            ->expectsQuestion(
                question: self::QUESTION,
                answer  : ['Accordion']
            )
            ->assertSuccessful();

        $this->artisan('shadcn:add')
            ->expectsQuestion(
                question: self::QUESTION,
                answer  : ['Accordion']
            )
            ->expectsQuestion(
                question: 'Accordion component already exists. Do you want to overwrite it?',
                answer  : false
            )
            ->expectsOutput('Accordion component skipped.')
            ->assertSuccessful();
    }

    #[Test]
    public function the_command_will_overwrite_an_existing_builder_when_force_option_is_passed()
    {
        $this->artisan('shadcn:add')
            ->expectsQuestion(
                question: self::QUESTION,
                answer  : ['Accordion']
            )
            ->assertSuccessful();

        $this->artisan('shadcn:add')
            ->expectsQuestion(
                question: self::QUESTION,
                answer  : ['Accordion']
            )
            ->expectsQuestion(
                question: 'Accordion component already exists. Do you want to overwrite it?',
                answer  : true
            )
            ->assertSuccessful();
    }
}