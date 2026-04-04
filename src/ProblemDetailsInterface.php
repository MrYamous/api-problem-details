<?php

declare(strict_types=1);

namespace Yamous\ProblemDetailsApi;

interface ProblemDetailsInterface
{
    public function getType(): string;
    public function getTitle(): ?string;
    public function getStatus(): ?int;
    public function getDetail(): ?string;
    public function getInstance(): ?string;
}