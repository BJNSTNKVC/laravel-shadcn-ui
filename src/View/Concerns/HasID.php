<?php

namespace Bjnstnkvc\ShadcnUi\View\Concerns;

trait HasID
{
    /**
     * The index of the item.
     *
     * @var int
     */
    public static int $index = 1;

    /**
     * An ID of the item.
     *
     * @var string
     */
    public string $id;

    /**
     * Set the ID of the component.
     *
     * @param string $identifier
     *
     * @return string
     */
    public function id(string $identifier): string
    {
        $id = $identifier . '-' . self::$index;

        self::$index++;

        return $id;
    }

    /**
     * Reset the index of the component.
     *
     * @return void
     */
    public static function reset(): void
    {
        self::$index = 1;
    }
}
