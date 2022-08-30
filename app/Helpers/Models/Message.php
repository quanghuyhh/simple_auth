<?php

namespace App\Helpers\Models;

class Message implements \ArrayAccess
{
    /**
     * The title of the message.
     *
     * @var string
     */
    public string $title;

    /**
     * The body of the message.
     *
     * @var string
     */
    public string $message;

    /**
     * The message level.
     *
     * @var string
     */
    public string $level = 'info';

    /**
     * Whether the message should auto-hide.
     *
     * @var bool
     */
    public bool $important = false;

    /**
     * Whether the message is an overlay.
     *
     * @var bool
     */
    public bool $overlay = false;

    /**
     * Create a new message instance.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        $this->update($attributes);
    }

    /**
     * Update the attributes.
     *
     * @param  array $attributes
     * @return $this
     */
    public function update(array $attributes = []): static
    {
        $attributes = array_filter($attributes);

        foreach ($attributes as $key => $attribute) {
            $this->$key = $attribute;
        }

        return $this;
    }


    /**
     * Whether the given offset exists.
     *
     * @param  mixed $offset
     * @return bool
     */
    public function offsetExists(mixed $offset): bool
    {
        return isset($this->$offset);
    }

    /**
     * Fetch the offset.
     *
     * @param  mixed $offset
     * @return mixed
     */
    public function offsetGet(mixed $offset): mixed
    {
        return $this->$offset;
    }

    /**
     * Assign the offset.
     *
     * @param  mixed $offset
     * @return void
     */
    public function offsetSet(mixed $offset, mixed $value): void
    {
        $this->$offset = $value;
    }

    /**
     * Unset the offset.
     *
     * @param  mixed $offset
     * @return void
     */
    public function offsetUnset(mixed $offset): void
    {
        //
    }

    public function getClassName(): string
    {
        switch ($this->level) {
            case 'success':
                return ' text-green-700 bg-green-100 ';
            case 'danger':
                return ' bg-red-100 text-red-700 ';
            case 'warning':
                return ' bg-yellow-100 text-yellow-700 ';
            default:
                return ' text-blue-700 bg-blue-100 ';
        }
    }
}