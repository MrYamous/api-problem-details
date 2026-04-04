<?php

declare(strict_types=1);

namespace Yamous\ProblemDetailsApi;

final class ProblemDetails implements ProblemDetailsInterface
{
    public function __construct(
        private string $type = 'about:blank',
        private ?string $title = null,
        private ?int $status = null,
        private ?string $detail = null,
        private ?string $instance = null,
    ) {}

    public function getType(): string
    {
        return $this->type;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function getDetail(): ?string
    {
        return $this->detail;
    }

    public function getInstance(): ?string
    {
        return $this->instance;
    }
}