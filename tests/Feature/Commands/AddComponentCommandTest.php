<?php

namespace Bjnstnkvc\ShadcnUi\Tests\Feature\Commands;

use Bjnstnkvc\ShadcnUi\Tests\TestCase;
use Illuminate\Filesystem\Filesystem;
use PHPUnit\Framework\Attributes\Test;

class AddComponentCommandTest extends TestCase
{
    /**
     * Question for the console command.
     *
     * @var string
     */
    protected const QUESTION = 'Which components would you like to add?';

    /**
     * Filesystem instance.
     *
     * @var Filesystem
     */
    private static Filesystem $fs;

    /**
     * Clean up the testing environment before the next test.
     *
     * @return void
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        self::cleanUp();
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
            ->assertSuccessful();

        $this->assertDirectoryExists(
            directory: app_path('View/Components/Accordion'),
            message  : 'Component was not created'
        );

        $this->assertDirectoryExists(
            directory: resource_path('views/components/accordion'),
            message  : 'Component was not created'
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

    /**
     * Remove the generated Component classes.
     *
     * @return void
     */
    private static function cleanUp(): void
    {
        self::$fs ??= new Filesystem();

        self::$fs->deleteDirectory(app_path('View'));
        self::$fs->deleteDirectory(resource_path('views/components'));
        self::$fs->deleteDirectory(resource_path('js/components'));

        foreach (self::$fs->glob(app_path("../../src/View/Components/*/.published")) as $file) {
            self::$fs->delete($file);
        }
    }
}