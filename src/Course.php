<?php

declare(strict_types=1);

namespace App;

use Assert\Assertion;

class Course
{
    private const ACCEPTED_STATE = 'accepted';
    private const IN_PROGRESS_STATE = 'inProgress';
    private const FINISHED_STATE = 'finished';
    private const CANCELLED_STATE = 'cancelled';

    private string $state;

    public function __construct(
        private int $id,
        private array $lessons,
    ) {
        Assertion::allIsInstanceOf($lessons, Lesson::class);

        $this->state = self::ACCEPTED_STATE;
    }

    public function id(): int
    {
        return $this->id;
    }

    public function lessons(): array
    {
        return $this->lessons;
    }

    public function state(): string
    {
        return $this->state;
    }

    public function totalTimeInSeconds(): int
    {
        $total = 0;
        foreach ($this->lessons as $lesson) {
            $total += $lesson->timeInSeconds();
        }

        return $total;
    }

    public function start(): void
    {
        if ($this->state !== self::ACCEPTED_STATE) {
            throw new \Exception("The order can't be started. State = {$this->state}");
        }

        $this->state = self::IN_PROGRESS_STATE;
    }

    public function cancel(): void
    {
        if ($this->state !== self::ACCEPTED_STATE) {
            throw new \Exception("The order can't be cancelled. State = {$this->state}");
        }

        $this->state = self::CANCELLED_STATE;
    }

    public function finish(): void
    {
        if ($this->state !== self::IN_PROGRESS_STATE) {
            throw new \Exception("The order can't be finished. State = {$this->state}");
        }

        $this->state = self::FINISHED_STATE;
    }
}
