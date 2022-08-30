<?php

namespace App\Helpers;

use App\Helpers\Models\Message;
use Illuminate\Support\Collection;

class FlashMessage
{
    /**
     * The session store.
     *
     */
    protected $session;

    /**
     * The messages collection.
     *
     */
    public Collection $messages;

    /**
     * Create a new FlashNotifier instance.
     *
     */
    function __construct()
    {
        $this->messages = collect();
    }

    /**
     * Flash an information message.
     *
     * @param string|null $message
     * @return $this
     */
    public function info(string $message = null): static
    {
        return $this->message($message, 'info');
    }

    /**
     * Flash a success message.
     *
     * @param string|null $message
     * @return $this
     */
    public function success(string $message = null): static
    {
        return $this->message($message, 'success');
    }

    /**
     * Flash an error message.
     *
     * @param string|null $message
     * @return $this
     */
    public function error(string $message = null): static
    {
        return $this->message($message, 'danger');
    }

    /**
     * Flash a warning message.
     *
     * @param string|null $message
     * @return $this
     */
    public function warning(string $message = null): static
    {
        return $this->message($message, 'warning');
    }

    /**
     * Flash a general message.
     *
     * @param string|null $message
     * @param string|null $level
     * @return $this
     */
    public function message(string $message = null, string $level = null): static
    {
        // If no message was provided, we should update
        // the most recently added message.
        if (! $message) {
            return $this->updateLastMessage(compact('level'));
        }

        if (! $message instanceof Message) {
            $message = new Message(compact('message', 'level'));
        }

        $this->messages->push($message);

        return $this->flash();
    }

    /**
     * Modify the most recently added message.
     *
     * @param array $overrides
     * @return $this
     */
    protected function updateLastMessage(array $overrides = []): static
    {
        $this->messages->last()->update($overrides);

        return $this;
    }

    /**
     * Add an "important" flash to the session.
     *
     * @return $this
     */
    public function important(): static
    {
        return $this->updateLastMessage(['important' => true]);
    }

    /**
     * Clear all registered messages.
     *
     * @return $this
     */
    public function clear(): static
    {
        $this->messages = collect();

        return $this;
    }

    /**
     * Flash all messages to the session.
     */
    protected function flash(): static
    {
        session(['flash_notification' => $this->messages ?? collect()]);
        return $this;
    }
}