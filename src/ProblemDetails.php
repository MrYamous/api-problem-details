<?php

declare(strict_types=1);

namespace Yamous\ProblemDetailsApi;

final class ProblemDetails implements ProblemDetailsInterface
{
    private const RESERVED_KEYS = [
        'type',
        'title',
        'status',
        'detail',
        'instance',
    ];

    public function __construct(
        private string $type = 'about:blank',
        private ?string $title = null,
        private ?int $status = null,
        private ?string $detail = null,
        private ?string $instance = null,
        private array $extensions = []
    ) {
        $this->assertNoReservedKeysInExtensions($extensions);
    }

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

    public function getExtensions(): array
    {
        return $this->extensions;
    }

    private function assertNoReservedKeysInExtensions(array $extensions): void
    {
        foreach ($extensions as $key => $_) {
            if (\in_array($key, self::RESERVED_KEYS, true)) {
                throw new \InvalidArgumentException(\sprintf(
                    'The key "%s" is reserved and cannot be used as an extension.',
                    $key
                ));
            }
        }
    }
}